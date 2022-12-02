<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Service;
use App\Models\Work;

class WorkController extends Controller
{
  public function index(){
    $workInProgress = Work::whereIn('status',[
      'requested',
      'accepted'
    ])->whereUserId(auth()->user()->id)->get();

    $finishedWorks = Work::whereIn('status',[
      'canceled_by_applicant',
      'canceled_by_provider',
      'ended'
    ])->whereUserId(auth()->user()->id)->get();

    return view('work.index',[
      'workInProgress' => $workInProgress,
      'finishedWorks' => $finishedWorks
    ]);
  }
  public function order(){
    $workRequested = Work::whereStatus('requested')->whereProviderId(auth()->user()->id)->get();
    $workAccepted = Work::whereStatus('accepted')->whereProviderId(auth()->user()->id)->get();
    $workFinished = Work::whereStatus('ended')->whereProviderId(auth()->user()->id)->get();
    $workCanceled = Work::whereIn('status',[
      'canceled_by_applicant',
      'canceled_by_provider',
    ])->whereProviderId(auth()->user()->id)->get();

    return view('work.order',[
      'workRequested' => $workRequested,
      'workAccepted' => $workAccepted,
      'workFinished' => $workFinished,
      'workCanceled' => $workCanceled
    ]);
  }
  public function show($order){
    if(!$work = Work::whereOrder($order)->where(function($condition){
      return $condition->where('user_id', auth()->user()->id)
        ->orWhere('provider_id', auth()->user()->id);
    })->first()) return $this->sweet(
      redirect()->back(),
      'Pedido não encontrado, ou você não tem permissão de acessá-lo',
      'error',
      'Pedido'
    );

    return view('work.show',[
      'work' => $work
    ]);
  }
  #region JSON FUNCTIONS
  public function request(Request $request){
    #region VALIDATION
    if(!$request->service_id) return response()->json([
      'result' => false,
      'response' => 'Não foi possível identificar o serviço na sua solicitação'
    ]);
    if(!$request->description) return response()->json([
      'result' => false,
      'response' => 'É obrigatório preencher a descrição da solicitação'
    ]);    
    if(!$service = Service::whereId($request->service_id)->first()) return response()->json([
      'result' => false,
      'response' => 'Serviço não localizado'
    ]);
    if($service->user_id == auth()->user()->id) return response()->json([
      'result' => false,
      'response' => 'Você não pode solicitar um serviço em que você é o prestador'
    ]);
    $dataOrder = Work::makeUniqueOrder();
    if(!$dataOrder->result)  return response()->json($dataOrder);    
    #endregion VALIDATION

    $order = $dataOrder->response;
    $data = [
      'order' => $order,
      'service_id' => $service->id,
      'description' => $request->description,
      'provider_id' => $service->user_id,
      'user_id' => auth()->user()->id
    ];
    
    Work::create($data);

    return response()->json([
      'result' => true,
      'response' => $order
    ]);
  }
  public function accept(Request $request){
    
  }
  #endregion JSON FUNCTIONS
  public static function getResume($params = []){
    $service_id = null;
    if(isset($params['service_id'])) $service_id = $params['service_id'];


    $now = Carbon::now();
    $month = $now->format('m');
    $year = $now->format('Y');

    #region SERVICES
    $query = Work::whereUserId(auth()->user()->id)->whereIn('status', [
      'requested', 'accepted'
    ])->when($service_id, function($condition) use ($service_id){
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
    #region SERVICES
    $response = [
      'works' => $works,
      'requestedInThisMonth' => $requestedInThisMonth,
      'finalizedWorks' => $finalizedWorks,
      'finalizedInThisMonth' => $finalizedInThisMonth
    ];

    #region ORDERS
    if(auth()->user()->services()->count() > 0){
      $query = Work::whereProviderId(auth()->user()->id)->whereIn('status', [
        'requested', 'accepted'
      ])->when($service_id, function($condition) use ($service_id){
        return $condition->where('service_id',$service_id);
      });
      $orderWorks = $query->get();
      $orderRequestedInThisMonth = $query->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->count();
  
  
      $query = Work::whereProviderId(auth()->user()->id)->whereStatus('ended')->when($service_id, function($condition) use ($service_id){
        return $condition->where('service_id',$service_id);
      });
      $orderFinalizedWorks = $query->get();
      $orderFinalizedInThisMonth = $query->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->count();
  
      $response+= [
        'orderWorks' => $orderWorks,
        'orderRequestedInThisMonth' => $orderRequestedInThisMonth,
        'orderFinalizedWorks' => $orderFinalizedWorks,
        'orderFinalizedInThisMonth' => $orderFinalizedInThisMonth
      ];
    }
    #endregion ORDERS

    $data = (object)[
      'result' => true,
      'response' => $response
    ];

    return $data;
  }
}