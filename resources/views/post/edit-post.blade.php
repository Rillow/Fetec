@extends('main')

@section('content')
@if (session('erro'))
    <div class="alert alert-danger">
        {{ session('erro') }}
    </div>
  @endif
<form action="{{ url('editar-post/'.$post->id)}}" method="post"  enctype="multipart/form-data">
  {!! csrf_field() !!}
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <center>
        <img src="{!! url($post->imagem) !!}" alt="" />
      </center>
    </div>
    <div class="row">
      <div class="form-group">
        <label for="titulo">Titulo</label>
        <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Titulo" value="{!! $post->titulo !!}">
      </div>
      <br>
      <div class="form-group">
        <label for="conteudo">Conteudo</label>
        <textarea class="form-control"  name="conteudo" rows="8" cols="40">{!! $post->conteudo !!}</textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="imagem">Imagem</label>
      <input type="file" id="imagem" name="imagem">
    </div>
  </div>
</div>
<button type="submit" class="btn btn-default">Salvar Alteração</button>
</form>
@endsection
