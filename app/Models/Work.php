<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
  use HasFactory;

  protected $fillable = [
    'order',
    'description',
    'scheduled_to',
    'status',
    'applicant_rating',
    'provider_rating',
    'applicant_comment',
    'provider_comment',

    'service_id',
    'provider_id',
    'user_id'
  ];

  #region RALATIONSHIP
  public function service(){
    return $this->belongsTo(Service::class, 'service_id');
  }
  public function provider(){
    return $this->belongsTo(User::class, 'provider_id');
  }
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }
  #endregion RELATIONSHIP
  public function getStatus(){
    $formatted_status = [
      'requested' => 'Solicitado',
      'accepted' => 'Aceito',
      'canceled_by_applicant' => 'Cancelado pelo Solicitante',
      'canceled_by_provider' => 'Cancelado pelo Prestador',
      'ended' => 'Finalizado'
    ];

    return $formatted_status[$this->status] ?? null;
  }
}