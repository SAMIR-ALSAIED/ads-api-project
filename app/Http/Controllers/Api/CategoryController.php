<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\category;
use App\traits\ApiResponse;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

use ApiResponse;

    public function index()
    {
        $categories = category::all();

        if( $categories ->count() >0){
            
        return  $this->successResponse(200,'Categories Retrieved Successfully' , CategoryResource::collection($categories));

        }

                return $this->errorResponse(404, 'No  Categories Found' ,null);



    }

  
    public function store(Request $request)
    {

    $data=$request->validate([

    'name'=>'required'

    ]);

       $category = category::create($data);


          
    return $this->successResponse(201,'Disrict Created SuccessFuly', new CategoryResource($category));
        

    }


    

    public function update(Request $request, category $category)
    {
        

        $data=$request->validate([

    'name'=>'required'

    ]);

      $category->update($data);


    return $this->successResponse(200,'Category Created SuccessFuly', new CategoryResource($category));
      



    }


    public function destroy(category $category)
    {
        
    $category->delete();



    return $this->successResponse(200,'Category deleted successfully' ,null);




    }
}
