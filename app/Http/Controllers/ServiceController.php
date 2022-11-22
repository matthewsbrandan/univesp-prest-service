<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Work;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
  public function index($slug = null){
    if(auth()->user()->active_area){
      $categories_id = array_column(auth()->user()->active_area->services()
        ->groupBy('service_category_id')
        ->select('id')
        ->get()
        ->toArray(),
        'id'
      );
      $categories = $categories = ServiceCategory::when($slug, function($condition) use ($slug){
        return $condition->where('slug',$slug);
      })->whereIn('id',$categories_id)->where(
        'count_services', '>', 0
      )->take(3)->inRandomOrder()->get()->map(function($category){
        $category->service = auth()->user()->active_area->services()
          ->whereServiceCategoryId($category->id)
          ->inRandomOrder()
          ->first();
        return $category;
      })->filter(function($category){
        return !!$category->service;
      });
    }
    else $categories = ServiceCategory::when($slug, function($condition) use ($slug){
      return $condition->where('slug',$slug);
    })->where(
      'count_services', '>', 0
    )->take(3)->inRandomOrder()->get()->map(function($category){
      $category->service = $category->services()->inRandomOrder()->first();
      return $category;
    })->filter(function($category){
      return !!$category->service;
    });

    $outherCategories = ServiceCategory::whereNotIn('id', array_column(
      $categories->toArray()
      ,'id'
    ))->where('count_services','>',0)->take(5)->get();

    $data = $this->more(new Request([
      'json' => false
    ]));

    if(!$data->result) return $this->sweet(
      redirect()->back(),
      $data->response,
      'error',
      'Serviços'
    );
    $services = $data->response;

    $highServices = Service::inRandomOrder()->take(3)->get();

    $lastThreeServicesRequested = auth()->user()->applicant_works()
      ->orderByDesc('created_at')
      ->take(3)
      ->get();

    return view('service.index',[
      'services' => collect([]),
      'categories' => $categories,
      'outherCategories' => $outherCategories,
      'services' => $services,
      'highServices' => $highServices,
      'lastThreeServicesRequested' => $lastThreeServicesRequested
    ]);
  }
  public function more(Request $request){
    $exclude_ids = $request->exclude_ids ?? [];
    $search = $request->search ?? null;
    $json = $request->json ?? true;

    if(auth()->user()->active_area) $queryService = auth()->user()->active_area->services()->whereNotIn('id',$exclude_ids);
    else $queryService = Service::whereNotIn('id',$exclude_ids);    

    $services = $queryService->when($search, function($condition) use ($search){
      return $condition->where(function($query) use ($search){
        return $query->where('name', 'like', "%$search%")
          ->orWhere('slug', 'like', "%$search%")
          ->orWhere('description', 'like', "%$search%");
      });
    })->inRandomOrder()->take(7)->get();

    $data = [
      'result' => true,
      'response' => $services
    ];

    return $json ? response()->json($data) : (object) $data;
  }
  public function show($slug){
    dd('slug');
  }
  public function create(){
    $categories = ServiceCategory::get();

    if($categories->count() == 0) return $this->sweet(
      redirect()->back(),
      'Não é possível cadastrar um novo serviço, pois não há categorias disponíveis',
      'error',
      'Cadastrar Serviço'
    );

    return view('service.create.index',[
      'categories' => $categories
    ]);
  }
  public function store(Request $request){
    #region HANDLE FILL VALIDATION
    $errors = [];
    if(!$request->name) $errors[]= 'Preencha o nome';
    if(!$request->description) $errors[]= 'Preencha a descrição';
    if(!$request->service_category_id) $errors[]= 'Selecione a categoria do serviço';  
    if(!$request->contacts || !json_decode($request->contacts)) $errors[]= 'Preencha no mínimo uma informação de contato';
    // if(!$request->instructions) -- nullable
    // if(!$request->image_name) -- nullable
    if(count($errors) > 0) return $this->sweet(
      redirect()->back(),
      'Alguns campos obrigatórios não foram preenchidos:<br/>- ' . implode(
        '<br/>- ', $errors
      ),
      'error',
      'Salvar Serviço'
    );
    #region HANDLE FILL VALIDATION

    if(!$category = ServiceCategory::whereId(
      $request->service_category_id
    )->first()) return $this->sweet(
      redirect()->back(),
      'Categoria não encontrada',
      'error',
      'Salvar Serviço'
    );

    #region HANDLE IF IS UPDATE
    $id = null;
    if($request->service_id){
      if(!$service = Service::whereId($request->service_id)
        ->whereUserId(auth()->user()->id)
        ->first()
      ) return $this->sweet(
        redirect()->back(),
        'Serviço não encontrado ou você não tem permissão para editar esse serviço',
        'error',
        'Salvar Serviço'
      );
    }
    #endregion HANDLE IF IS UPDATE
    $contacts = json_decode($request->contacts); // COLOCAR ALGUMA FUNÇÃO PARA VERIFICAR SE ESTÁ DENTRO DO PADRÃO ESPERADO
    
    #region HANDLE IMAGE
    $image = null; // LIDAR COM IMAGEM
    if($request->image_name){
      $path = 'uploads/services/';
      $resImage = Controller::handleUploadImage(
        $request->image_name,
        $path
      );
      if($resImage->result) $data+= ['image' => $resImage->response];
      else return $this->sweet(
        redirect()->back(),
        $resImage->response,
        'error',
        'Salvar Serviço'
      );
    }
    #endregion HANDLE IMAGE

    $data = [
      'name' => $request->name,
      'description' => $request->description,
      
      'service_category_id' => $category->id,
      
      'contacts' => json_encode($contacts),
      'instructions' => $instructions,

      'image' => $image,
    ];
    
    if(!$id){
      $slug = Service::generateSlug($request->name);
      $data+=[
        'slug' => $slug,
        'user_id' => auth()->user()->id
      ];
    }

    Service::updateOrCreate(['id' => $id], $data);

    return $this->toast(
      redirect()->route('service.index'),
      'Serviço salvo com sucesso',
      'success',
      'Salvar Serviço'
    );
  }
}