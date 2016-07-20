<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Cache;
use App\Posts;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Validator;
use File;
use App\comentarios;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $posts = Posts::all();
      return view('post.index-post')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      return view('post.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      $mensagens = [
          'titulo.required' => 'Você não colocou o título no texto.',
          'conteudo.required' => 'Você não colocou o conteúdo no texto.',
          'imagem.required' => 'Você não colocou a imagem no texto.',
          'imagem.mimes' => 'Somente imagem no formato de jpeg e png.',
      ];

      $validator = Validator::make(Input::all(),[
        'titulo'=>'required',
        'conteudo'=>'required',
        'imagem'=>'required|mimes:jpeg,png',
      ]);

      if($validator->fails()){
        return back()->withErrors($validator);
      }

      if(Input::file('imagem'))
      {
        $imagem = Input::file('imagem');
        $extensao = $imagem->getClientOriginalExtension();
        if($extensao != 'jpg' && $extensao != 'png')
        {
          return back()->with('erro','Erro: Este arquivo não é imagem');
        }
      }
      $post = new Posts;
      $post->titulo = Input::get('titulo');
      $post->conteudo = Input::get('conteudo');
      $post->imagem = "";
      $post->save();
      if(Input::file('imagem'))
      {
        File::move($imagem,public_path().'/imagem-post/post-id_'.$post->id.'.'.$extensao);
        $post->imagem = '/imagem-post/post-id_'.$post->id.'.'.$extensao;
        $post->save();
      }
      return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = Posts::find($id);
        $comentarios = comentarios::where('post_id','=',$post->id)->orderBy('created_at')->get();
        if(Cache::has($id)==false)
        {
          Cache::add($id,'contador',0.30);
          $post->total_visualizacao+=1;
          $post->save();
        }
        return view('post.show-post')->with('post',$post)->with('comentarios', $comentarios);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Posts::find($id);
        return view('post.edit-post')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $post = Posts::find($id);
      if(Input::file('imagem'))
      {
        $imagem = Input::file('imagem');
        $extensao = $imagem->getClientOriginalExtension();
        if($extensao != 'jpg' && $extensao != 'png')
        {
          return back()->with('erro','Erro: Este arquivo não é imagem');
        }
      }

      if($post->titulo!=Input::get('titulo'))
      {
        $post->titulo = Input::get('titulo');
      }

      if($post->conteudo!=Input::get('conteudo'))
      {
        $post->conteudo = Input::get('conteudo');
      }

      $post->save();

      if(Input::file('imagem'))
      {
        File::delete(public_path().$post->imagem);
        File::move($imagem,public_path().'/imagem-post/post-id_'.$post->id.'.'.$extensao);
        $post->imagem = '/imagem-post/post-id_'.$post->id.'.'.$extensao;
        $post->save();
      }
      return redirect('visualizar-post/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
      $post = Posts::find($id);
      File::delete(public_path().$post->imagem);
      comentarios::where('post_id','=',$id)->delete();
      $post->delete();
      return redirect('lista-post');
    }

    public function AdicionarGostei()
    {
      $id = Input::get('post_id');
      $post = Posts::find($id);
      if(Cache::has('Voto '.$id)==false)
      {
        Cache::add('Voto '.$id,'contador',0.30);
        $post->total_gostei+=1;
        $post->save();
        return \Response::json(array('status'=>'sim','qtde'=>$post->total_gostei));
      }
      else
      {
        return \Response::json(array('status'=>'nao'));
      }
    }

    public function AdicionarNaoGostei()
    {
      $id = Input::get('post_id');
      $post = Posts::find($id);
      if(Cache::has('Voto '.$id)==false)
      {
        Cache::add('Voto '.$id,'contador',0.30);
        $post->total_naogostei+=1;
        $post->save();
        return \Response::json(array('status'=>'sim','qtde'=>$post->total_naogostei));
      }
      else
      {
        return \Response::json(array('status'=>'nao'));
      }
    }

    public function Pesquisar()
    {
      if(Input::has('texto')==false)
      {
        return redirect('/');
      }
      $posts = Posts::where('titulo','like','%'.Input::get('texto').'%')->orWhere('conteudo','like','%'.Input::get('texto').'%')->get();
      return view('pesquisa')->with('posts', $posts);
    }

    public function AdicionarComentario()
    {
      $comentario = new comentarios;
      $comentario->post_id = Input::get('post_id');
      $comentario->nome = Input::get('nome');
      $comentario->conteudo = Input::get('conteudo');
      $comentario->save();
      return \Response::json(array('status'=>'sim'));
    }

}
