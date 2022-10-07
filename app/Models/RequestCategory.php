<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCategory extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'status',
    'response',

    'user_id',
  ];

  #region RELATIONSHIP
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }
  #endregion RELATIONSHIP

  public function getStatus(){
    $fomatted = [
      'requested' => 'Solicitado',
      'approved' => 'Aprovado',
      'repproved' => 'Reprovado'
    ];
    return $fomatted[$this->status] ?? null;
  }
}