<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notice;
use App\Http\Requests\cadastroFormRequest;
use App\Http\Controllers\Vendor;

class SiteController extends Controller
{
    private $notice;
    
    public function __construct(notice $noticeGet) {
        $this->notice = $noticeGet;
    }

    public function index()
    {
        $notices = $this->notice::all();
        return view('index', compact('notices'));
    }
    
    public function store(cadastroFormRequest $request)
    {
        //Recuperar os dados do formulário
        $dataForm = $request->all();
        
        //salvar imagem se houver
        if(isset($dataForm['image'])){
            $imagemSalva = Vendor::salvarImagemUpload($request, config('constantes.DESTINO_IMAGE'));
            if(!$imagemSalva['status']){
                return redirect()->route('notices.index')->with('messageReturn', ['status' => false, 'messages' => [$imagemSalva['return'],]]);
            }else{
                $dataForm['image'] = $imagemSalva['return'];
            }
        }
        
        //Cadastrar dados no BD
        $create = $this->notice->create($dataForm);
        
        if ($create) {
            return redirect()->route('notices.index')->with('messageReturn', ['status' => true, 'messages' => ['Cadastrado com sucesso.',]]);
        } else {
            return redirect()->route('notices.index')->with('messageReturn', ['status' => false, 'messages' => ['Falha ao cadastrar.',]]);
        }
    }
    
    public function destroy($id)
    {
        //Recuperar dados do anuncio
        if ( !$noticia = $this->notice->find($id) ){
            return redirect()->back();
        }
        
        //Apagar imagem perfil antiga se precisar (update only)
        if($noticia->image != null){
            Vendor::apagarArquivo(config('constantes.DESTINO_IMAGE'), $noticia->image);
        }
        
        $delete = $noticia->delete();
        
        if($delete){
            return redirect()->route('notices.index')->with('messageReturn', ['status' => true, 'messages' => ['Deletado com sucesso.',]]);
        }else{
            return redirect()->route('notices.index')->with('messageReturn', ['status' => false, 'messages' => ['Falha ao deletar.',]]);
        }
    }
}
