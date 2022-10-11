<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

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
    'profile',
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
    return $this->hasMany(Work::class, 'provider_id');
  }
  public function areas(){
    return $this->hasMany(Area::class, 'user_id');
  }
  public function request_categories(){
    return $this->hasMany(RequestCategory::class, 'user_id');
  }
  #endregion RELATIONSHIP
  public function getProfile(){
    return $this->profile ? asset($this->profile) : self::getProfileDefault();
  }
  public function getSocialNetwork($in_array_format = false){
    /* EXPECTED ['facebook' => '#', 'twitter' => '#', 'instagram' => '#' ] */ 
    if(!$this->social_network) return [];
    return json_encode($this->social_network, $in_array_format);
  }
  public function getPreferences($in_array_format = false){
    return json_encode($this->preferences, $in_array_format);    
  }
  public function getWorks($take = 10){
    return Work::whereUserId($this->id)
      ->whereProviderId($this->id)
      ->orderByDesc('updated_at')
      ->take($take)
      ->get();
  }
  #region STATIC FUNCTIONS
  public static function generateUsername($name){
    $username = Controller::generateSlug($name);
    $append = '';
    $count = 0;
    while(User::whereUsername($username.$append)->first()){
      $append = "-".Str::random(
        $count <= 2 ? 2 : ( $count <= 4 ? 4 : 6 )
      );
      $count++;
    }
    return $username.$append;
  }
  public static function getProfileDefault(){
    return asset('images/user-default.jpg');
  }
  #endregion STATIC FUNCTIONS
}