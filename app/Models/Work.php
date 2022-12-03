<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Exception;

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
  #region VERIFICATIONS IS HAS CAN
  public function isProvider(){
    return $this->provider_id == auth()->user()->id;
  }
  public function isProcessing(){
    return in_array($this->status, [
      'requested',
      'accepted'
    ]);
  }
  public function isFinished(){
    return in_array($this->status, [
      'canceled_by_applicant',
      'canceled_by_provider',
      'ended'
    ]);
  }
  public function isCanceled(){
    return in_array($this->status, [
      'canceled_by_applicant',
      'canceled_by_provider'
    ]);
  }
  #endregion VERIFICATIONS IS HAS CAN
  #region STATIC FUNCTIONS
  public static function makeUniqueOrder(){
    $order = null;
    $limit = 0;
    do{
      $order = strtolower(Str::random(8));
      $limit++;
      if($limit >= 10) return (object)[
        'result' => false,
        'response' => 'Não foi possível gerar um número de ordem único'
      ];
    }while(Work::whereOrder($order)->first());
  
    return (object)[
      'result' => !!$order,
      'response' => $order ? $order : 'Houve um erro ao tentar gerar um número de ordem único'
    ];
  }
  #endregion STATIC FUNCTIONS
}