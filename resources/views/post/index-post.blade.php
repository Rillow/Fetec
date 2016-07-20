@extends('main')
@section('content')
<p>
  Lista Posts
</p>
<div class="row">
  <?php foreach ($posts as $key => $value): ?>
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="{!! url($value->imagem) !!}" alt="" />
        <div class="caption">
          <h3>{!! $value->titulo !!}</h3>
          <span class="pull-right"> {!! $value->created_at->diffForHumans() !!}</span>
          <p>
            <a href="{!! url('visualizar-post/'.$value->id) !!}" class="btn btn-success" role="button">Visualizar</a>
            <a href="{!! url('editar-post/'.$value->id) !!}" class="btn btn-primary" role="button">Editar</a>
            <a href="{!! url('deletar-post/'.$value->id) !!}" class="btn btn-danger" role="button">Deletar</a>
          </p>          
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
@endsection
