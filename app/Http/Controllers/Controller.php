<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use Exception;
use File;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  #region PROTECTED FUNCTIONS
  protected function alert($redirect){
    /** ESTA FUNÇÃO RECEBE COMO PRIMEIRO PARAMETRO O REDIRECIONAMENTO,
     *  E OS DEMAIS PARAMETROS SERÃO APLICADOS NO WITH, UTILIZANDO 
     *  AS CHAVES DA VARIÁVEL ABAIXO(KEYS)
     *  **/ 
    
    $keys = ['notify','notify-type'];

    $args = func_get_args();
    $length = count($args);

    if($length <= 1) throw new Exception('É obrigatória a passagem de parametros para esta função');
    if($length > count($keys) + 1) throw new Exception('A quantidade de parametros excedeu o total suportado');

    foreach($args as $index => $arg){
      if($index == 0) continue;
      $redirect->with($keys[$index - 1], $arg);
    }

    return $redirect;
  }
  protected function toast($redirect){
    /** ESTA FUNÇÃO RECEBE COMO PRIMEIRO PARAMETRO O REDIRECIONAMENTO,
     *  E OS DEMAIS PARAMETROS SERÃO APLICADOS NO WITH, UTILIZANDO 
     *  AS CHAVES DA VARIÁVEL ABAIXO(KEYS)
     *  **/ 
    
    $keys = ['toast','toast-type','toast-title','toast-time','toast-icon','toast-onclick'];

    $args = func_get_args();
    $length = count($args);

    if($length <= 1) throw new Exception('É obrigatória a passagem de parametros para esta função');
    if($length > count($keys) + 1) throw new Exception('A quantidade de parametros excedeu o total suportado');

    foreach($args as $index => $arg){
      if($index == 0) continue;
      $redirect->with($keys[$index - 1], $arg);
    }

    return $redirect;
  }
  protected function sweet($redirect){
    /** ESTA FUNÇÃO RECEBE COMO PRIMEIRO PARAMETRO O REDIRECIONAMENTO,
     *  E OS DEMAIS PARAMETROS SERÃO APLICADOS NO WITH, UTILIZANDO 
     *  AS CHAVES DA VARIÁVEL ABAIXO(KEYS)
     *  **/ 
    $availableIcons = ['success', 'question', 'error', 'info', 'warning'];
    $keys = ['sweet','sweet-icon','sweet-title','sweet-outher','sweet-callback'];

    $args = func_get_args();
    $length = count($args);

    if($length <= 1) throw new Exception('É obrigatória a passagem de parametros para esta função');
    if($length > count($keys) + 1) throw new Exception('A quantidade de parametros excedeu o total suportado');

    foreach($args as $index => $arg){
      if($index == 0) continue;
      
      $value = $arg;
      $key = $keys[$index - 1];
      if($key == 'sweet-outher') $value = json_encode($arg);
      if($key == 'sweet-icon' && !!$value){
        if($value == 'danger') $value = 'error';
        if(!in_array($value, $availableIcons)) throw new Exception(
          'Sweet-icon inválido. Icones válidos: ' . implode(', ',$availableIcons)
        );
      }

      $redirect->with($key,$value);
    }

    return $redirect;
  }
  protected function putTempSession($data){
    // $key => $value
    foreach($data as $key => $value){
      session()->put($key,$value);
    }
    session()->put('unset-session', array_keys($data));
  }
  protected function resJsonOrArray($json, $data){
    return $json ? response()->json($data) : $data;
  }
  #endregion PROTECTED FUNCTIONS
  public static function generateSlug($str){
    $str = mb_strtolower($str);
    $str = preg_replace('/(â|á|ã)/', 'a', $str);
    $str = preg_replace('/(ê|é)/', 'e', $str);
    $str = preg_replace('/(í|Í)/', 'i', $str);
    $str = preg_replace('/(ú)/', 'u', $str);
    $str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
    $str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
    $str = preg_replace('/( )/', '-',$str);
    $str = preg_replace('/ç/','c',$str);
    $str = preg_replace('/(-[-]{1,})/','-',$str);
    $str = preg_replace('/(,)/','-',$str);
    $str = str_replace('%','', $str);
    $str=strtolower($str);
    return $str;
  }
  #region STATIC FUNCTIONS >> HANDLE IMAGE
  public static function handleUploadImage(
    $image_name,
    $path,
    $image_default = null,
    $isModeBase64 = true,
    $user_id = null,
    $name_default = null
  ){
    $data = self::handleImageRules($image_name);
    if(!$data->result) return $data;

    if(auth()->user()){
      $user_id = auth()->user()->id;
      try{
        $data = GalleryController::getUsedSpaceFromGallery();
        if($data->result && $data->response['limit_porcentage'] >= 100) return (object)[
          'result' => false,
          'response' => 'Você atingiu o limite de armazenamento, apague algumas imagens da sua galeria para ter mais espaço.'
        ];
      }catch(Exception $e){ }
    }
    if($user_id){
      $path = $path . $user_id ."/";
      self::MakeDirIfNotExists($path);
    }

    if($isModeBase64){
      if(strpos($image_name,'data:') !== 0 || 
        $image_name == $image_default
      ) return (object)[
        'result' => true,
        'response' => $image_name
      ];
  
      $data_image = $image_name;
  
      $image_array_1 = explode(";", $data_image);
      $image_array_2 = explode(",", $image_array_1[1]);
      $data_image = base64_decode($image_array_2[1]);
  
      if($name_default) $image_name = $name_default;
      else $image_name = time() . '.png';
      
      $public_path = public_path($path);      
      file_put_contents($public_path . $image_name, $data_image);  
  
      return (object)[
        'result' => true,
        'response' => $path . $image_name
      ];
    }
    else{
      if(is_string($image_name)) return (object)[
        'result' => true,
        'response' => $image_name
      ];

      $image = $image_name;
      $image_name = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
      if ($image->move(public_path($path), $image_name)) {
        $image_path = $path . $image_name;
        return (object)[
          'result' => true,
          'response' => $image_path
        ];
      }
      return (object)[
        'result' => false,
        'response' => 'Não foi possível salvar a imagem'
      ];
    }
  }
  public static function handleDeleteImage($path, $filename, $user_id = null){
    if(auth()->user()){
      if(!$user_id) $user_id = auth()->user()->id;
      elseif(auth()->user()->id != $user_id) return (object)[
        'result' => false,
        'response' => 'Você não tem permissão para executar essa ação'
      ];
    }
    $path = $path . $user_id . "/" . $filename;
    try{
      $public_path = public_path($path);
      unlink($public_path);

      return (object)[
        'result' => true,
        'response' => 'Imagem excluída com sucesso'
      ];
    }catch(Exception $e){
      return (object)[
        'result' => false,
        'response' => 'Houve um erro ao excluir a imagem'
      ];
    }
  }
  public static function handleImageRules($image){
    /* TYPES RETURNED
      01	IMAGETYPE_GIF
      02	IMAGETYPE_JPEG
      03	IMAGETYPE_PNG
      04	IMAGETYPE_SWF
      05	IMAGETYPE_PSD
      06	IMAGETYPE_BMP
      07	IMAGETYPE_TIFF_II (intel byte order)
      08	IMAGETYPE_TIFF_MM (motorola byte order)
      09	IMAGETYPE_JPC
      10	IMAGETYPE_JP2
      11	IMAGETYPE_JPX
      12	IMAGETYPE_JB2
      13	IMAGETYPE_SWC
      14	IMAGETYPE_IFF
      15	IMAGETYPE_WBMP
      16	IMAGETYPE_XBM
    */
    $type = exif_imagetype($image);
    
    if($type === false) return (object)[
      'result' => false,
      'response' => 'O arquivo não é uma imagem'
    ];
    if($type < 1 || $type > 16) return (object)[
      'result' => false,
      'response' => 'Extensão de imagem inesperada'
    ];

    return (object)[
      'result' => true,
      'response' => 'Imagem dentro das regras'
    ];
  }
  #endregion STATIC FUNCTIONS >> HANDLE IMAGE
  public static function MakeDirIfNotExists($path){
    $path = public_path($path);
    return File::isDirectory($path) or File::makeDirectory(
      $path, 0777, true, true
    );
  }
  public static function isYoutubeVideo($url){
    $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
    $match;

    if(preg_match($regex_pattern, $url, $match)) return $url;
    return null;
  }
  #endregion STATIC FUNCTIONS
}
