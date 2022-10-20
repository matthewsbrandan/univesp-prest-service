<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class Area extends Model
{
  use HasFactory;

  protected $fillable = [
    'slug',
    'name',
    'image',
    'description',
    'address',
    'code',

    'num_services',
    'num_followers',
    'categories_included',

    'user_id'
  ];

  #region RELATIONSHIP
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }
  public function service(){
    return $this->belongsToMany(Service::class, 'service_areas', 'service_id');
  }
  public function servicePivot(){
    return $this->hasMany(ServiceArea::class, 'area_id');
  }
  public function followers(){
    return $this->belongsToMany(User::class, 'user_areas', 'user_id');
  }
  public function followersPivot(){
    return $this->hasMany(UserArea::class, 'user_id');
  }
  #endregion RELATIONSHIP
  public function getAddress($in_array_format = false){
    return json_decode($this->address, $in_array_format);
  }
  public function getSlugCategoriesIncluded(){
    if(!$this->categories_included) return [];
    return explode(',',$this->categories_included);
  }
  public function getImage(){
    return asset($this->image);
  }
  #region FORMATTED
  public function getAddressFormatted(){
    $address = $this->getAddress(true);
    $formatted = [];
    foreach($address as $n => $item){
      $formatted = "$n: $item";
    }
    return implode('<br/>',$formatted);
  }
  public function getCategoriesIncluded(){
    $slugs = $this->getSlugCategoriesIncluded();
    return ServiceCategory::whereIn('slug',$slugs)->get();
  }
  public function loadData($with = []){
    $area = $this;
    $area->image_formatted = $area->getImage();
    $area->i_am_vinculed = $area->iAmVinculed();

    if(in_array('services', $with)){
      $area->services = $area->services ? $area->services->map(function($service){
        return $service->loadData();
      }) : collect([]);
    }

    return $area;
  }
  #endregion FORMATTED
  public function iAmVinculed(){
    if(!auth()->user()) return false;
    return !!UserArea::whereUserId(auth()->user()->id)->whereAreaId($this->id)->first();
  }
  public static function generateSlug($name){
    $slug = Controller::generateSlug($name);
    $append = '';
    $count = 0;
    while(Area::whereSlug($slug.$append)->first()){
      $append = "-".Str::random(
        $count <= 2 ? 2 : ( $count <= 4 ? 4 : 6 )
      );
      $count++;
    }
    return $slug.$append;
  }
}