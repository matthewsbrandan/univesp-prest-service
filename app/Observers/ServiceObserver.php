<?php

namespace App\Observers;

use App\Models\Service;

class ServiceObserver
{
  public function created(Service $service){
    $service->service_category->update([
      'count_services' => $service->service_category->services()->count()
    ]);
  }
  public function updated(Service $service){
    $service->service_category->update([
      'count_services' => $service->service_category->services()->count()
    ]);
  }
  public function deleted(Service $service){
    $service->service_category->update([
      'count_services' => $service->service_category->services()->count()
    ]);
  }
}
