<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Web Service - Android [FACOL]</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('assets/css/folha-css.css') }}" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Web Service - Android [FACOL]</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav pull-right">
                        <li>
                            <a href="https://fb.com/luisrogerio1993" target="_blank">Desenvolvedor: Luís Araújo</a>
                        </li>
                        <li class="active">
                            <a href="https://github.com/luisrogerio1993/web-service-android/commits/master" target="_blank">Repositório GitHub</a>
                        </li>
                        <li class="active">
                            <a href="https://fb.com/luisrogerio1993" target="_blank">Contato</a>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
        @include('includes.message-return')
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6 col-cadastrar-noticia">
                    <h3 class="titulo-divs">Cadastrar Notícia</h3>
                    {!! Form::open(["route" => "notices.store", "class" => "form-horizontal", "files" => true]) !!}
                    <div class="form-group"> 
                        {!! Form::label("image", "Imagem", ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10 form-group has-feedback {{ $errors->has('image') ? 'has-error' : '' }}">
                            <div>
                                {!! Form::file("image", ["class" => "form-control", "id" => "image", "onchange" => "PreviewImage(this.id);"]) !!}
                                @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                                <p class="help-block">Formatos aceitos: .JPG; .PNG; .GIF; .JPEG</p>
                                <p class="help-block">Arquivo deve ser menor que 2MB.</p>
                            </div>
                        </div>                                                          
                    </div>
                    <div class="form-group"> 
                        {!! Form::label("titulo", "Título", ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10 form-group has-feedback {{ $errors->has('title') ? 'has-error' : '' }}">
                            <div>
                                {!! Form::text("title", null, ["class" => "form-control", "placeholder" => "Título na notícia", "required"]) !!}
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>                             
                    </div>                         

                    <div class="form-group"> 
                        {!! Form::label("noticia", "Notícia", ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10 form-group has-feedback {{ $errors->has('notice') ? 'has-error' : '' }}">
                            <div>
                                {!! Form::textarea("notice", null, ["class" => "form-control", "placeholder" => "Notícia", "rows" => "2", "required" ]) !!}
                                @if ($errors->has('notice'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('notice') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>                             
                    </div>                                                                           

                    <div class="form-group">
                        <div class="  col-sm-offset-2 col-sm-10">
                            <div>
                                {!! Form::submit("Cadastrar", ["class" => "btn btn-success", "name" => "enviar"]) !!}
                            </div>
                        </div>
                    </div>                         
                    {!! Form::close() !!}
                </div>
                <div class="col-xs-6 col-cadastrar-noticia">
                    <div class="row row-noticias-cadastradas">
                        <h3 class="titulo-divs">Notícias Cadastradas</h3>
                        <table class="table table-listagem"> 
                            <thead> 
                                <tr> 
                                    <th>ID</th> 
                                    <th></th> 
                                    <th>Título</th> 
                                    <th>Notícia</th> 
                                    <th>Ações</th> 
                                </tr>                                 
                            </thead>                             
                            <tbody>
                                @forelse($notices as $notice)
                                <tr> 
                                    <th>{{ $notice->id }}</th> 
                                    <td>
                                        <img class="img-rounded" src="{{ $notice->image != null ? url(config('constantes.DESTINO_IMAGE').'\\'.$notice->image) : url(config('constantes.DEFAULT_IMAGE')) }}" width="65" alt="Imagem"/>
                                    </td> 
                                    <td>{{ $notice->title }}</td> 
                                    <td>{{ $notice->notice }}</td> 
                                    <td>
                                        {!! Form::open(["route" => ["notices.destroy", $notice->id], "method" => "DELETE" ]) !!}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja deletar esta notícia?');"><span class='glyphicon glyphicon-trash'></span></button>
                                        {!! Form::close() !!}
                                    </td>                                     
                                </tr>  
                                @empty
                                <tr> 
                                    <td colspan="4">Nenhuma notícia cadastrada</td>                                    
                                </tr>  
                                @endforelse                                                                                        
                            </tbody>
                        </table>
                    </div>
                    <div class="row row-noticias-cadastradas">
                        <h3 class="titulo-divs">[API] Web Service</h3>
                        <blockquote> 
                            <small>Recuperar todas as notícias</small>
                            <p>
                                URL: {{ route('api.notices') }} <br />
                                Metodo: GET<br />
                                Parâmetros: <br />
                                Retorno: Json - Todas as notícias<br /></p>
                        </blockquote>
                        <blockquote> 
                            <small>Recuperar noticia pelo ID</small>
                            <p>
                                URL: {{ route('api.notice', 5) }} <br />
                                Metodo: GET<br />
                                Parâmetros: ID da notícia (substituir no link onde tem "5")<br />
                                Retorno: Json - Notícia referente ao ID<br /></p>
                        </blockquote>
                    </div>                                          
                </div>
            </div>
        </div>
        <!-- /.container -->
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="{{ asset('assets/js/ie10-viewport-bug-workaround.js') }}"></script>
    </body>
</html>
