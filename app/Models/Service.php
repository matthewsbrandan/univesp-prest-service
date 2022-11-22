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
  public function loadData(){
    $service = $this;
    $service->image_formatted = $service->getImage();

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