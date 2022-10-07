<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'username',
    'email_verified_at',
    'phone',
    'whatsapp',
    'social_network',
    'preferences',
    'provider_rating',
    'applicant_rating',
  ];
  protected $hidden = [
    'password', 'remember_token',
  ];
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  #region RELATIONSHIP
  public function services(){
    return $this->hasMany(Service::class, 'user_id');
  }
  public function applicant_works(){
    return $this->hasMany(Work::class, 'user_id');
  }
  public function provider_works(){
    return $this->hasMany(Work::class, 'user_id');
  }
  public function areas(){
    return $this->hasMany(Area::class, 'user_id');
  }
  public function request_categories(){
    return $this->hasMany(RequestCategory::class, 'user_id');
  }
  #endregion RELATIONSHIP
  public function getsocial_network($in_array_format = false){
    return json_encode($this->social_network, $in_array_format);
  }
  public function getpreferences($in_array_format = false){
    return json_encode($this->preferences, $in_array_format);
  }
}