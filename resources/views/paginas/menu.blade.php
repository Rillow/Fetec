<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{!! url() !!}">Sistema Post</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if(Auth::check())
        <li><a href="{{ url('criar-post')}}">Criar Post <span class="sr-only">(current)</span></a></li>
        <li><a href="{{url('lista-post')}}">Lista Post</a></li>
        @endif
      </ul>
      <form class="navbar-form navbar-left" role="search" action="{!! url('pesquisar') !!}" method="post">
        <div class="form-group">
          {!! csrf_field() !!}
          <input type="text" name="texto" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{!! Auth::user()->name !!} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{!! url('auth/logout') !!}">Sair</a></li>
            </ul>
          </li>
        @else
          <li><a href="{!! url('auth/login') !!}">Login</a></li>
          <li><a href="{!! url('auth/register') !!}">Cadastro</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
