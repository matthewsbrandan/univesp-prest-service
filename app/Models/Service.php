<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class Service extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'slug',
    'description',
    'image',
    'contacts',
    'instructions',
    'rating',

    'user_id',
    'service_category_id'
  ];

  #region RELATIONSHIP
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }
  public function service_category(){
    return $this->belongsTo(ServiceCategory::class, 'service_category_id');
  }
  public function post_services(){
    return $this->hasMany(PostService::class, 'service_id');
  }
  public function works(){
    return $this->hasMany(Work::class, 'service_id');
  }
  public function area(){
    return $this->belongsToMany(Area::class, 'service_areas','area_id');
  }
  public function areaPivot(){
    return $this->hasMany(ServiceArea::class, 'service_id');
  }
  #endregion RELATIONSHIP
  public function getImageAttribute($value){
    return asset($value);
  }
  public function getImageWithoutAsset($default = null){
    return $this->image ? str_replace(asset(''), $this->image, '') : $default;
  }
  public function getContactsAttribute($value){
    return json_decode($value);
  }
  public function getInstructionsAttribute($value){
    $instructions = json_decode($value);
    if($instructions->addresses) $instructions->addresses = json_decode(
      $instructions->addresses
    );
    return $instructions;
  }
  public function getAddress($address){
    $addr = $address->street .', '. $address->number .' - '. $address->district .'.<br/>'.
      $address->city .', '. $address->state .'.<br/>';
    if($address->complement) $addr.= '<br/>Complemento: '. $address->complement;
    return $addr;
  }
  public function getWhatsappUnformatted($phone){
    $phone = str_replace(' ','',
      str_replace('-','',
        str_replace('(','',
          str_replace(')','',
            str_replace('+','',$phone)
          )
        )
      )
    );

    if(strlen($phone) <= 11) $phone = "55" . $phone;
    return $phone;
  }
  public function getResumeWorks(){
    return (object)[
      'processing' => 0,
      'canceled' => 0,
      'finished' => 0
    ];
  }
  public function loadData(){
    $service = $this;
    return $service;
  }
  #region STATIC FUNCTIONS
  public static function generateSlug($name){
    $slug = Controller::generateSlug($name);
    $append = '';
    $count = 0;
    while(Service::whereSlug($slug.$append)->first()){
      $append = "-".Str::random(
        $count <= 2 ? 2 : ( $count <= 4 ? 4 : 6 )
      );
      $count++;
    }
    return $slug.$append;
  }
  #endregion STATIC FUNCTIONS
}