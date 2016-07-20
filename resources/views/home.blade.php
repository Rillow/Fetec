@section('title','Sistema Post')
@extends('main')

@section('content')
<div class="row">
  <?php foreach ($mais_vistos as $key => $value): ?>
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="{!! url($value->imagem) !!}" alt="" />
        <div class="caption">
          <h3>{!! $value->titulo !!}</h3>
          <span class="pull-right"> {!! $value->created_at->diffForHumans() !!}</span>
          <p>
            <a href="{!! url('visualizar-post/'.$value->id) !!}" class="btn btn-success" role="button">Visualizar</a>
            <span>Visualização ({!! $value->total_visualizacao !!})</span>
          </p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div class="row">
  <?php foreach ($ultimos as $key => $value): ?>
    <div class="col-md-12 thumbnail">
      <div class="row">
        <div class="col-md-4">
          <img src="{!! url($value->imagem) !!}" class="img-responsive"/>
        </div>
        <div class="col-md-8">
          <div class="caption">
            <h3>{!! $value->titulo !!}</h3>
            <span class="pull-right"> {!! $value->created_at->diffForHumans() !!}</span>
            <p>
              <a href="{!! url('visualizar-post/'.$value->id) !!}" class="btn btn-success" role="button">Visualizar</a>
              <span>Visualização({!! $value->total_visualizacao !!})</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div class="row">
  {!! $ultimos->render() !!}
</div>
@endsection
