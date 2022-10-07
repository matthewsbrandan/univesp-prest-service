<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}