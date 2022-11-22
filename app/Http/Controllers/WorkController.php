<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Work;

class WorkController extends Controller
{
  public function index(){
    $workInProgress = Work::whereIn('status',[
      'requested',
      'accepted'
    ])->get();

    $finishedWorks = Work::whereIn('status',[
      'canceled_by_applicant',
      'canceled_by_provider',
      'ended'
    ])->take(6)->get();

    return view('work.index',[
      'workInProgress' => $workInProgress,
      'finishedWorks' => $finishedWorks
    ]);
  }
}