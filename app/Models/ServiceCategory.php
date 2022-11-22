<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\Controller;

class ServiceCategory extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'slug',
    'keywords',
    'description',
    'image',
    'count_services'
  ];

  #region RELATIONSHIP
  public function services(){
    return $this->hasMany(Service::class, 'service_category_id');
  }
  #endregion RELATIONSHIP
  #region MUTATORS
  public function getImageAttribute($value){
    return asset($value);
  }
  public function getKeywordsAttribute($value){
    return explode(',', $value) ?? [];
  }
  #endregion MUTATORS
  public function getImageWithoutAsset($default = null){
    return $this->image ? str_replace(asset(''), $this->image, '') : $default;
  }
  #region STATIC FUNCTIONS
  public static function generateSlug($name){
    $slug = Controller::generateSlug($name);
    $append = '';
    $count = 0;
    while(ServiceCategory::whereSlug($slug.$append)->first()){
      $append = "-".Str::random(
        $count <= 2 ? 2 : ( $count <= 4 ? 4 : 6 )
      );
      $count++;
    }
    return $slug.$append;
  }
  #endregion STATIC FUNCTIONS
}