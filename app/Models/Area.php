<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
  use HasFactory;

  protected $fillable = [
    'slug',
    'name',
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
  #endregion FORMATTED
}