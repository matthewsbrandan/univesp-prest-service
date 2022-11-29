<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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

  public static function getResume($params = []){
    $service_id = null;
    if(isset($params['service_id'])) $service_id = $params['service_id'];


    $now = Carbon::now();
    $month = $now->format('m');
    $year = $now->format('Y');

    $query = Work::whereUserId(auth()->user()->id)->whereStatus('requested')->when($service_id, function($condition) use ($service_id){
      return $condition->where('service_id',$service_id);
    });
    $works = $query->get();
    $requestedInThisMonth = $query->whereMonth('created_at', $month)
      ->whereYear('created_at', $year)
      ->count();


    $query = Work::whereUserId(auth()->user()->id)->whereStatus('ended')->when($service_id, function($condition) use ($service_id){
      return $condition->where('service_id',$service_id);
    });
    $finalizedWorks = $query->get();
    $finalizedInThisMonth = $query->whereMonth('created_at', $month)
      ->whereYear('created_at', $year)
      ->count();

    $data = (object)[
      'result' => true,
      'response' => [
        'works' => $works,
        'requestedInThisMonth' => $requestedInThisMonth,
        'finalizedWorks' => $finalizedWorks,
        'finalizedInThisMonth' => $finalizedInThisMonth
      ]
    ];

    return $data;
  }
}