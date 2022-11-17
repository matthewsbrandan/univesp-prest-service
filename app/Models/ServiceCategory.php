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
  public function loadData(){
    $category = $this;

    $category->image_formatted = $category->getImage();
    
    return $category;
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