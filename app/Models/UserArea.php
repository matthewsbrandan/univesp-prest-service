<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArea extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'area_id'
  ];

  #region RELATIONSHIP
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }
  public function area(){
    return $this->belongsTo(Area::class, 'area_id');
  }
  #endregion RELATIONSHIP
}