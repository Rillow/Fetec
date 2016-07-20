@section('title',$post->titulo)
@extends('main')

@section('content')
<div class="row">
  <div class="col-md-12">

    @if(session('status'))
    <div class="alert alert-success">
      {{session('status')}}
    </div>
    @endif

    <div class="row">
      <center>
        <img src="{!! url($post->imagem) !!}" alt="" />
      </center>
    </div>
    <div class="row">
      <span>Total Visualização({!! $post->total_visualizacao !!})</span>
      <h3>{!! $post->titulo !!}</h3>
      <br>
      {!! $post->conteudo !!}
    </div>
    <div class="row">
      <center>
        <a class="btn btn-success _btnGostei">Gostei ({!! $post->total_gostei !!})</a>
        <a class="btn btn-danger _btnNaoGostei">Não Gostei ({!! $post->total_naogostei !!})</a>
      </center>
    </div>

    <div class="row _comentarios">
      <?php foreach ($comentarios as $key => $value): ?>
        <div class="row well">
          <div class="col-sm-12">
            Nome:{!! $value->nome !!}
          </div>
          <div class="col-sm-12">
            {!! $value->conteudo !!}
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="row">
      <h5>Adicionar Comentário:</h5>
      <div class="form-group">
        <label for="">Nome:</label>
        <input type="text" class="form-control _nome" >
      </div>
      <div class="form-group">
        <label for="">Texto:</label>
        <textarea class="form-control _texto" rows="4" cols="40"></textarea>
      </div>
      <a type="button" class="btn btn-success _btnComentar">Comentar</a>
    </div>

    {!! csrf_field() !!}
    <input type="hidden" name="post_id" value="{!! $post->id !!}">
    <script type="text/javascript">
      $("._btnGostei").click(function () {
        $.post("/adicionar-gostei",{post_id:$('input[name="post_id"]').attr("value"),_token:$('input[name="_token"]').attr("value")},function (response) {
          if(response.status=="sim")
          {
            $("._btnGostei").html("Gostei ("+response.qtde+")");
          }
        });
      });

      $("._btnNaoGostei").click(function () {
        $.post("/adicionar-naogostei",{post_id:$('input[name="post_id"]').attr("value"),_token:$('input[name="_token"]').attr("value")},function (response) {
          if(response.status=="sim")
          {
            $("._btnNaoGostei").html("Não Gostei ("+response.qtde+")");
          }
        });
      });

      $("._btnComentar").click(function () {
        $.post("/comentar",{
          post_id:$('input[name="post_id"]').attr("value"),
          nome:$('._nome').val(),
          conteudo:$('._texto').val(),
          _token:$('input[name="_token"]').attr("value")
        },function (response) {
            if(response.status=="sim")
            {
              var _temp = '<div class="row well">';
                  _temp+= '<div class="col-sm-12">';
                  _temp+= 'Nome: '+$('._nome').val();
                  _temp+= '</div><div class="col-sm-12">';
                  _temp+= $('._texto').val();
                  _temp+= '</div></div>';
              $('._comentarios').append(_temp);
            }
        });
      });
    </script>
  </div>
</div>
@endsection
