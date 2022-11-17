<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Exception;

class GalleryController extends Controller
{
  protected $take;
  protected $max_length_gallery;
  protected $show_limit_after;

  public function __construct(){
    $this->take = 3;
    $this->max_length_gallery = 524288000; // 500MB
    $this->show_limit_after = 80; // 80%
  }

  public function index(){
    $take = $this->take; // SHOW IMAGES PREVIEW

    $data = $this->get(null, (object)[
      'get_filesize' => true,
      'get_all_galleries' => true,
      'take' => $take
    ], false);

    if(!$data->result) return $this->sweet(
      redirect()->back(),
      $data->response,
      'error',
      'Galeria'
    );

    return view('gallery.index',$data->response);
    // $data->response:
    // > 'galleries'
    // > 'total_galleries_size'
    // > 'total_galleries_size_formatted'
  }
  public function show($gallery_name){
    $data = $this->get($gallery_name, (object)[
      'get_filesize' => true,
    ], false);

    if(!$data->result) return $this->sweet(
      redirect()->back(),
      $data->response,
      'error',
      'Galeria'
    );

    return view('gallery.show',[
      'gallery' => $data->response
    ]);
  }
  public function get($gallery_name, $options = null, $json = true, $user = null){
    if(!$user) $user = auth()->user();
    $opt = (object)[
      'get_filesize' => $options->get_filesize ?? false,
      'get_all_galleries' => $options->get_all_galleries ?? false,
      'take' => $options->take ?? null,
    ];

    $availableGalleries = self::availableGalleries();
    $galleries = $availableGalleries->filter(function($availableGallery) use ($gallery_name, $opt) {
      if($opt->get_all_galleries) return true;
      else return $gallery_name == $availableGallery->path;
    });

    if($galleries->count() == 0){
      $data = [
        'result' => false,
        'response' => 'Galeria não encontrada'
      ];
      return $json ? response()->json($data) : (object) $data;
    }


    $total_galleries_size = 0;
    foreach($galleries as &$gallery){
      $path = "uploads/" . $gallery->path . "/" . $user->id;
      self::MakeDirIfNotExists($path);

      $total_size = 0;
      $gallery->storage = array_map(function($file) use ($path, &$total_size, $opt){
        $data = pathinfo($file);        
        $data['short_src'] = $path . "/". $data['basename'];;
        $data['src'] = asset($data['short_src']);

        if($opt->get_filesize){
          try{
            $data['size'] = filesize($data['short_src']);
            $data['size_formatted'] = self::FileSizeConvert($data['size']);
          }catch(Exception $e){
            $data['size'] = 0;
            $data['size_formatted'] = '-';
          }
          $total_size+= $data['size'];
        }

        return (object) $data;
      }, self::ReadDir($path, $opt->take));

      $gallery->count = count($gallery->storage);
      if($opt->get_filesize){
        $gallery->total_size = $total_size;
        $gallery->total_size_formatted = self::FileSizeConvert($total_size);
        $gallery->limit_porcentage = ($total_size * 100) / $this->max_length_gallery;
      }
      $total_galleries_size+= $total_size;


      if($gallery->count == 0) $gallery->wallpaper =  null;
      else $gallery->wallpaper = $gallery->storage[
        rand(0, $gallery->count - 1)
      ]->src;
    }
    if($opt->get_filesize){
      $total_galleries_size_formatted = self::FileSizeConvert($total_galleries_size);
    }

    if(!$opt->get_all_galleries) $data = [
      'result' => true,
      'response' => $galleries->first()
    ];
    else{
      $data = [
        'result' => true,
        'response' => [
          'galleries' => $galleries,
        ]
      ];

      if($opt->get_filesize){
        $limit_porcentage = ($total_galleries_size * 100) / $this->max_length_gallery;
        $data['response']+= [
          'total_galleries_size' => $total_galleries_size,
          'total_galleries_size_formatted' => $total_galleries_size_formatted,
          'limit_porcentage' => $limit_porcentage,
          'show_limits' => $limit_porcentage >= $this->show_limit_after
        ];
      } 
    }

    return $json ? response()->json($data) : (object) $data;
  }
  public function upload(Request $request){
    if(
      !$request->gallery_name ||
      !$request->image_name
    ) return $this->sweet(
      redirect()->back(),
      'É obrigatório a imagem para upload e o nome da galeria',
      'error',
      'Subir imagem na Galeira'
    );

    $availableGalleries = self::availableGalleries();
    $galleries = $availableGalleries->filter(function($availableGallery) use ($request) {
      return $availableGallery->path == $request->gallery_name;
    });
    if($galleries->count() == 0) return $this->sweet(
      redirect()->back(),
      'Nome de galeria inválido',
      'error',
      'Subir imagem na Galeira'
    );

    $path = 'uploads/'. $request->gallery_name . '/';
    $data = Controller::handleUploadImage(
      $request->image_name,
      $path
    );

    if(!$data->result) return $this->sweet(
      redirect()->back(),
      $data->response,
      'error',
      'Subir imagem na Galeira'
    );

    return $this->toast(
      redirect()->route('gallery.show',['gallery_name' => $request->gallery_name]),
      'Imagem adicionada com sucesso',
      'success',
      'Subir imagem na Galeira'
    );
  }
  public function delete(Request $request, $json = true, $user = null){
    if(!$user) $user = auth()->user();
    if(
      !$request->gallery_name ||
      !$request->image_name
    ) return $this->resJsonOrArray($json, [
      'result' => false,
      'response' => 'É obrigatório o nome da galeira e o nome da imagem'
    ]);

    $path = 'uploads/'. $request->gallery_name . '/';
    $data = Controller::handleDeleteImage($path, $request->image_name, $user->id);
    return $this->resJsonOrArray($json, $data);
  }
  public function getAttributes(){
    return (object)[
      'max_length_gallery' => $this->max_length_gallery,
      'take' => $this->take
    ];
  }
  #region STATIC FUNCTIONS
  public static function getMaxLengthGallery(){
    $controller = new self();
    $attr = $controller->getAttributes();
    return $attr->max_length_gallery;
  }
  public static function getUsedSpaceFromGallery($gallery_name = null){
    $availableGalleries = self::availableGalleries();
    $max_length_gallery = self::getMaxLengthGallery();

    $galleries = $availableGalleries->filter(function($availableGallery) use ($gallery_name) {
      if($gallery_name) return $gallery_name == $availableGallery->path;
      return true;
    });

    if($galleries->count() == 0) return (object)[
      'result' => false,
      'response' => 'Galeria não encontrada'
    ];


    $total_galleries_size = 0;
    foreach($galleries as &$gallery){
      $path = "uploads/" . $gallery->path . "/" . auth()->user()->id;
      self::MakeDirIfNotExists($path);

      $total_size = 0;
      $gallery->storage = array_map(function($file) use ($path, &$total_size){
        $data = pathinfo($file);        
        $data['short_src'] = $path . "/". $data['basename'];;

        try{
          $data['size'] = filesize($data['short_src']);
          $data['size_formatted'] = self::FileSizeConvert($data['size']);
        }catch(Exception $e){
          $data['size'] = 0;
          $data['size_formatted'] = '-';
        }
        $total_size+= $data['size'];

        return (object) $data;
      }, self::ReadDir($path));

      $gallery->count = count($gallery->storage);
      $gallery->total_size = $total_size;
      $gallery->total_size_formatted = self::FileSizeConvert($total_size);
      $gallery->limit_porcentage = ($total_size * 100) / $max_length_gallery;

      $total_galleries_size+= $total_size;
    }

    if($gallery_name) return (object)[
      'result' => true,
      'response' => $galleries->first()
    ];

    $total_galleries_size_formatted = self::FileSizeConvert($total_galleries_size);
    $limit_porcentage = ($total_galleries_size * 100) / $max_length_gallery;

    return (object)[
      'result' => true,
      'response' => [
        'galleries' => $galleries,      
        'total_galleries_size' => $total_galleries_size,
        'total_galleries_size_formatted' => $total_galleries_size_formatted,
        'limit_porcentage' => $limit_porcentage,
        'limit' => $max_length_gallery
      ]
    ];
  }
  public static function availableGalleries(){
    // (object)[
    //   'title' => 'Documentos',
    //   'path' => 'documents'
    // ]
    $galleries = collect([
      (object)[
        'title' => 'Condomínios',
        'path' => 'areas'
      ],(object)[
        'title' => 'Serviços',
        'path' => 'services'
      ],(object)[
        'title' => 'Publicação',
        'path' => 'publications'
      ],(object)[
        'title' => 'Perfil',
        'path' => 'user_profile'
      ],(object)[
        'title' => 'Mensagens',
        'path' => 'message_images'
      ]
    ]);
    
    if(auth()->user() && auth()->user()->hasPermissionTo('admin')) $galleries->push((object)[
      'title' => 'Categorias',
      'path' => 'service_categories'
    ]);

    return $galleries;
  }
  public static function FileSizeConvert($bytes){
    $bytes = floatval($bytes);
      $arBytes = array(
        0 => array(
          "UNIT" => "TB",
          "VALUE" => pow(1024, 4)
        ),
        1 => array(
          "UNIT" => "GB",
          "VALUE" => pow(1024, 3)
        ),
        2 => array(
          "UNIT" => "MB",
          "VALUE" => pow(1024, 2)
        ),
        3 => array(
          "UNIT" => "KB",
          "VALUE" => 1024
        ),
        4 => array(
          "UNIT" => "B",
          "VALUE" => 1
        ),
      );

    $result = '-';
    foreach($arBytes as $arItem){
      if($bytes >= $arItem["VALUE"]){
        $result = $bytes / $arItem["VALUE"];
        $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
        break;
      }
    }
    return $result;
  }
  public static function ReadDir($path, $limit = null, $reverse = true){
    // Storage::files(public_path($path)) or File::files(public_path($path))
    if(is_dir($path)) if($dh = opendir($path)){
      $files = [];
      while(($file = readdir($dh)) !== false){
        if(!in_array($file, ['.','..'])) $files[] = $file;
      }
      closedir($dh);

      sort($files, SORT_NUMERIC);

      if($reverse) $files =  array_reverse($files);
      if($limit) return array_slice($files, 0, $limit);
      return $files;
    }
    return [];
  }
  public static function deleteAll($user = null){
    if(!$user) $user = auth()->user();
    try{
      $ctrl = new GalleryController();
      $data = $ctrl->get(null, (object)[
        'get_all_galleries' => true
      ], false, $user);
  
      if(!$data->result) return (object)[
        'result' => false,
        'response' => 'Houve um erro ao carregar a galeria',
        'has_error' => true,
        'errors' => []
      ];
      $galleries = $data->response['galleries'];
      $errors = [];
      foreach($galleries as $gallery){
        foreach($gallery->storage as $image){
          $request = [
            'gallery_name' => $gallery->path,
            'image_name' => $image->basename
          ];
          $data = (object) $ctrl->delete(new Request($request), false, $user);
          if(!$data->result) $errors[]= (object)[
            'id' => $gallery->path . "/" . $user->id . "/" . $image->basename,
            'response' => $data->response
          ];
        }
      }
      $has_error = count($errors) > 0;
  
      return (object)[
        'result' => true,
        'response' => $has_error ? 'Alguns imagens não puderem ser excluídas':'Galeria esvaziada com sucesso',
        'has_error' => $has_error,
        'errors' => $errors
      ];
    }catch(Exception $e){
      return (object)[
        'result' => false,
        'response' => 'Houve um erro inesperado ao esvaziar sua galeria',
        'has_error' => true,
        'errors' => isset($errors) ? $errors : []
      ];
    }
  }
  #endregion STATIC FUNCTIONS
}