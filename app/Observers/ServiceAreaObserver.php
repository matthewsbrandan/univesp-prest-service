<?php

namespace App\Observers;

use App\Models\ServiceArea;

class ServiceAreaObserver
{
  public function created(ServiceArea $serviceArea){
    $serviceArea->area->update([
      'num_services' => $serviceArea->area->servicesPivot()->count()
    ]);
  }
  public function updated(ServiceArea $serviceArea){
    $serviceArea->area->update([
      'num_services' => $serviceArea->area->servicesPivot()->count()
    ]);
  }
  public function deleted(ServiceArea $serviceArea){
    $serviceArea->area->update([
      'num_services' => $serviceArea->area->servicesPivot()->count()
    ]);
  }
}
