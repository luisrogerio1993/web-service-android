<?php

namespace App\Http\Controllers;

use Image;
use DateTime;

class Vendor extends Controller
{
    public static function apagarArquivo($destino, $nomeImagem){
        if (!file_exists($destino)) return TRUE;
        if (!is_dir($destino)) return unlink($destino);
        
        foreach (scandir($destino) as $item) {
            if (($item == '.') or ($item == '..')) continue;
            if (strstr($destino . DIRECTORY_SEPARATOR . $item, $nomeImagem)) {
                unlink($destino . DIRECTORY_SEPARATOR . $item);
                return true;
            }
        }
        return false;
    }

    public static function salvarImagemUpload($requestGet, $destinoGet){
        //config
        $image = is_uploaded_file($requestGet) ? $requestGet : $requestGet->file('image');
        $destino = public_path($destinoGet);
        $imageNome = DateTime::createFromFormat('U.u', microtime(true))->format("H_i_s_u__d_m_Y");
            $imageNome .= '.'.$image->getClientOriginalExtension();
        $larguraAlturaMaxima = 1200; //px
        $larguraAlturaMinima = 150; //px
        
        if (Image::make($image->getRealPath())->height()
                < $larguraAlturaMinima || 
            Image::make($image->getRealPath())->width()
                < $larguraAlturaMinima){
            return ['status' => false, 'return' => 'Imagem muito pequena. Tamanho minimo: '.$larguraAlturaMinima.'px'];
        }

        if (Image::make($image->getRealPath())->height()
                > $larguraAlturaMaxima || 
            Image::make($image->getRealPath())->width()
                > $larguraAlturaMaxima){
            
            //redimensionar se necessário
            $imageAlterada = Image::make($image->getRealPath())->resize($larguraAlturaMaxima, $larguraAlturaMaxima, function ($constraint) {
                $constraint->aspectRatio();
            });
            
            //salvar
            return $imageAlterada->save($destino.'/'.$imageNome, 100) ? ['status' => true, 'return' => $imageNome] : ['status' => false, 'return' => 'Erro ao salvar imagem.'];
        }else{
            //salvar
            return $image->move($destino, $imageNome) ? ['status' => true, 'return' => $imageNome] : ['status' => false, 'return' => 'Erro ao salvar imagem.'];
        }
    }
}
