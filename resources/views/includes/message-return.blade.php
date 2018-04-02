<!--Mensagens de retorno-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".alert-messageReturn").fadeTo(4000, 100).slideUp(800, function(){
            $(".alert-messageReturn").alert('close');
        });
    });
</script>
@if ($messages = Session::get('messageReturn'))
    @if ($messages['status'] === true)
    <div class="alert alert-success alert-messageReturn">
    @else
        <div class="alert alert-danger alert-messageReturn">
    @endif
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach ($messages['messages'] as $mensagem)
        <strong>{{ $mensagem }}</strong><br/>
    @endforeach
    </div>
    @php( Session::forget('messageReturn') )
@endif
<!--conteudo da pagina-->