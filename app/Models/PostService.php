<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Exception;

class PostService extends Model
{
  use HasFactory;

  protected $fillable = [
    'slug',
    'content',
    'image',
    'video',
    'link_preview',
    'likes',
    'users_like',
    'comments',

    'user_id',
    'service_id'
  ];

  #region RELATIONSHIP
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }
  public function service(){
    return $this->belongsTo(Service::class, 'service_id');
  }
  #endregion RELATIONSHIP
  public function getImage(){
    return $this->image ? asset($this->image) : null;
  }
  public function getUsersLike($in_array_format = false){
    return json_decode($this->users_like, $in_array_format);
  }
  public function getComments($in_array_format = false){
    return json_decode($this->comments, $in_array_format);
  }
  public function getContentWithLinks(){
    $string = $this->content;
    $url = self::getLinksInContent($string);
  
    // Loop through all matches
    foreach($url as $newLinks){
      if(strstr( $newLinks, ":" ) === false){
        $link = 'http://'.$newLinks;
      }else{
        $link = $newLinks;
      }
  
      // Create Search and Replace strings
      $search  = $newLinks;
      $replace = '<a href="'.$link.'" title="'.$newLinks.'" target="_blank">'.$link.'</a>';
      $string = str_replace($search, $replace, $string);
    }
  
    return $string;
  }
  public function getDateFormatted($mode = 'updated_at', $format = 'd/m/Y H:i'){
    // $mode = 'created_at' | 'updated_at' | 'completed'
    if(!in_array($mode,['created_at', 'updated_at', 'completed'])) throw new Exception('Invalid formatted date mode');
    $date = $mode == 'updated_at' ? $this->updated_at : $this->created_at;
    $date_formatted = $date->timezone('America/Sao_Paulo')->format($format);
    if($mode !== 'completed') return $date_formatted;
  
    $edited = $this->created_at != $this->updated_at ? $this->updated_at
      ->timezone('America/Sao_Paulo')
      ->format($format) : null;
  
    $data = (object)[
      'smart' => Controller::getSmartDiffDate($this->created_at),
      'complete' => $date_formatted,
      'edited' => $edited
    ];
    return $data;
  }
  public function loadData(){
    $post = $this;
    $post->image_formatted = $post->getImage();
    return $post;
  }
  #region STATIC FUNCTIONS
  public static function getLinksInContent($string){
    $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
  
    // Check if there is a url in the text
    if(preg_match_all($reg_exUrl, $string, $url)) return $url[0];
    return [];
  }
  public static function generateSlug($id = null){
    $slug = null;
    $limit = 0;
    do{
      $slug = strtolower(Str::random(8));
      $limit++;
      if($limit >= 10) return (object)[
        'result' => false,
        'response' => 'Não foi possível gerar um slug único'
      ];
    }while(PostService::whereSlug($slug)
      ->where('id', '!=', $id)
      ->first()
    );
  
    return (object)[
      'result' => !!$slug,
      'response' => $slug ? $slug : 'Houve um erro ao tentar gerar um slug único'
    ];
  }
  #endregion STATIC FUNCTIONS
}