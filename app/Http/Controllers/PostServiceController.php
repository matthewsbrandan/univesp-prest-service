<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\PostService;

use App\Services\UrlPreviewerService;

use Exception;

class PostServiceController extends Controller
{
  public function store(Request $request){
    if(!strip_tags($request->content) &&
      !$request->image_name &&
      !$request->video_url
    ) return $this->sweet(
      redirect()->back(),
      'Publicação vazia',
      'error',
      'Publicação'
    );
    $id = null;
    if(isset($request->image_name) && isset($request->video_url)) return $this->sweet(
      redirect()->back(),
      'Não é possível publicar imagem e vídeo ao mesmo tempo',
      'error',
      'Publicação'
    );

    $service = null;
    if($request->service_id) $service = Service::whereId($request->service_id)->whereUserId(
      auth()->user()->id
    )->first();

    if(!$service) return $this->sweet(
      redirect()->back(),
      'Serviço não encontrado ou você não tem permissão para essa ação',
      'error',
      'Publicação'
    );

    if($request->id){
      $id = $request->id;
      if(!PostService::whereId($id)->whereUserId(auth()->user()->id)->first()) return $this->sweet(
        redirect()->back(),
        'Publicação não encontrada',
        'error',
        'Publicação'
      );
    }
    $data = ['service_id' => $service->id];
    if($request->content && !!strip_tags($request->content)){
      $data+= ['content' => $request->content];
      if($linkPreviewExists = $this->handleLinkForPreviewInContentIfExists(
        $request->content
      )) $data+= [
        'link_preview' => $linkPreviewExists
      ];
      else $data+= ['link_preview' => null];
    }else $data+= ['content' => null, 'link_preview' => null];
    if(isset($request->image_name)) {
      $path = 'uploads/publications/';
      $resImage = Controller::handleUploadImage(
        $request->image_name,
        $path,
        null
      );

      if(!$resImage->result) return $this->sweet(
        redirect()->back(),
        $resImage->response,
        'error',
        'Publicação'
      );
      $data+= ['image' => $resImage->response];
    }else if($id != null) $data+= ['image' => null];
    if($request->video_url){
      if(!$video = Controller::isYoutubeVideo($request->video_url)) return $this->sweet(
        redirect()->back(),
        'URL do Youtube inválido',
        'error',
        'Salvar Publicação'
      );
      
      $data+= ['video' => $video];
    }
    else $data+= ['video' => null];

    if(count($data) == 0) return $this->sweet(
      redirect()->back(),
      'Publicação vazia',
      'error',
      'Salvar Publicação'
    );
    $data+=['user_id' => auth()->user()->id];
    if(!$id){
      $dataSlug = PostService::generateSlug();
      if(!$dataSlug->result) return $this->sweet(
        redirect()->back(),
        $dataSlug->response,
        'error',
        'Salvar Publicação'
      );

      $data+=['slug' => $dataSlug->response];
    }
    $publication = PostService::updateOrCreate([
      'id' => $id
    ],$data);

    return $this->toast(
      redirect(route('service.show', ['slug' => $service->slug]) . '#post-' . $publication->slug),
      $id ? 'Publicação editada com sucesso' : 'Publicação adicionada com sucesso',
      'success',
      'Salvar Publicação'
    );
  }
  public function show($user_id, $skip = 0, $json = true){
    if($user = User::whereId($user_id)->first()){
      $posts = $user->publications()
        ->with('user')
        ->orderBy('created_at','desc')
        ->skip($skip)
        ->take(20)
        ->get();
              
      $data = $posts->map(function($post){
        $post->service->image_formatted = $post->service->getProfile();
        $post->date_formatted = $post->getDateFormatted('created_at');
        $post->date_completed = $post->getDateFormatted('completed');
        $post->image_formatted = $post->getImage();
        return $post;
      });

      $response = [
        'result' => true,
        'response' => $data
      ];
    }
    else $response = [
      'result' => false,
      'response' => 'Usuário não encontrado'
    ];
    
    return $json ? response()->json($response) : (object) $response;
  }
  public function delete($id){
    if(!$post = PostService::whereId($id)->first()) return $this->sweet(
      redirect()->back(),
      'Post não encontrado',
      'error',
      'Excluir Publicação'
    );
    $service = $post->service;
    if($service->user_id != auth()->user()->id) return $this->sweet(
      redirect()->back(),
      'Você não ter permissão para excluir essa publicação',
      'error',
      'Excluir Publicação'
    );

    $post->delete();
    
    return $this->toast(
      redirect()->route('service.show', ['slug' => $service->slug]),
      'Post excluído com sucesso',
      'success',
      'Excluir Publicação'
    );
  }
  protected function handleLinkForPreviewInContentIfExists($content){
    $urls = PostService::getLinksInContent($content);
    if(count($urls) == 0) return null;
    $url = $urls[0];
    try{
        $service = new UrlPreviewerService($url);
        $data = (object) $service->getWebsiteData();
        $html_preview = $this->renderHtmlPreview($data);
        return $html_preview;
    }catch(Exception $e){
        return null;
    }
  }
  protected function renderHtmlPreview($data){
    /** url | title | description | keywords | image **/
    $html = " <a href='{$data->url}' class='container-preview' target='_blank'> ";
    if(isset($data->image)) $html.= " <img src='{$data->image}'/> ";
    if(isset($data->url)) $html.= " <em>{$data->url}</em> ";
    if(isset($data->title)) $html.= " <strong>{$data->title}</strong> ";
    if(isset($data->description)) $html.= " <p>{$data->description}</p> ";
    $html.=" </a> ";

    return $html;
  }
}