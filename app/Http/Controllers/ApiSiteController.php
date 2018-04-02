<?php

namespace App\Http\Controllers;

use App\Models\notice;

class ApiSiteController extends Controller
{
    private $notice;
    
    public function __construct(notice $noticeGet) {
        $this->notice = $noticeGet;
    }
    
    public function getAllNotices() {
        $data = $this->notice::all();
        foreach ($data as $noticia) {
            $noticia = $this->adicionarImagemLink($noticia);
        }
        return response()->json(['data' => $data]);
    }
    
    public function getNotice($id) {
        $noticia = $this->notice::find($id);
        $retorno = $this->adicionarImagemLink($noticia);
        return response()->json(['data' => $retorno]);
    }
    
    private function adicionarImagemLink(notice $noticia):notice {
        if ($noticia->image != null){
            $noticia->image = env('APP_URL').'/'.config('constantes.DESTINO_IMAGE').'/'.$noticia->image;
        }
        return $noticia;
    }
}
