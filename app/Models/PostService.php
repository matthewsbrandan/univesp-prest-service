<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostService extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'slug',
    'content',
    'image',
    'video',
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
    return asset($this->image);
  }
  public function getUsersLike($in_array_format = false){
    return json_decode($this->users_like, $in_array_format);
  }
  public function getComments($in_array_format = false){
    return json_decode($this->comments, $in_array_format);
  }
}