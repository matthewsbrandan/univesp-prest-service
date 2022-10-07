<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
  use HasFactory;

  protected $fillable = [
    'service_id',
    'area_id'
  ];

  #region RELATIONSHIP
  public function service(){
    return $this->belongsTo(Service::class, 'service_id');
  }
  public function area(){
    return $this->belongsTo(Area::class, 'area_id');
  }
  #endregion RELATIONSHIP
}