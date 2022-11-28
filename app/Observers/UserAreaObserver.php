<?php

namespace App\Observers;

use App\Models\UserArea;

class UserAreaObserver
{
  public function created(UserArea $userArea){
    $userArea->area->update([
      'num_followers' => $userArea->area->followersPivot()->count()
    ]);
  }
  public function updated(UserArea $userArea){
    $userArea->area->update([
      'num_followers' => $userArea->area->followersPivot()->count()
    ]);
  }
  public function deleted(UserArea $userArea){
    $userArea->area->update([
      'num_followers' => $userArea->area->followersPivot()->count()
    ]);
  }
}
