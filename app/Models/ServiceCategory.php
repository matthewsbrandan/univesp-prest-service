<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'slug',
    'keywords',
    'description',
    'image'
  ];

  #region RELATIONSHIP
  public function services(){
    return $this->hasMany(Service::class, 'service_category_id');
  }
  #endregion RELATIONSHIP
  public function getImage(){
    return asset($this->image);
  }
}