<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ads\StoreAdsRequest;
use App\Http\Requests\Ads\UpdateAdsRequest;
use App\Http\Resources\AdsResource;
use App\Models\Ads;
use App\traits\ApiResponse;
use Illuminate\Http\Request;

class AdsController extends Controller
{

use ApiResponse;
    

public function index(){


        $ads=Ads::latest()->paginate(1);

        if($ads ->count() >0){

        $data=[

        'records'=>AdsResource::collection($ads),

        'paginarion'=>[
        
        'current_page'=> $ads->currentPage(),

        'per page'=>$ads->perPage(),

        'total'=>$ads->total(),

        'links'=>[

        'first_page'=>$ads>url(1),
        'last_page'=>$ads->url($ads->lastPage()),
      
        ],

        ]

        ];
        return $this->successResponse(200, 'ads retrieved successfully', $data);

        }

        return $this->errorResponse(404, 'no ads found' ,null);


}

 

       public function latest(){

        $ads= Ads::latest()->take(2)->get();

        if($ads ->count() >0){

        return  $this->successResponse(200 ,'latest ads retrieved successfully' , AdsResource::collection($ads));

        }

        return $this->errorResponse(404, 'No Latest Ads Not Found' , null);

       }



       public function search(Request $request){

       $words=  $request->input('search');

       $ads= Ads:: where('title','like','%' .$words .'%')->latest()->paginate(3);

       if($ads ->count() >0){


       return $this->successResponse(200,'search results retrieved successfully' , AdsResource::collection($ads));

       }

       return $this->errorResponse(404,'No Ads Found Matching Your Search' ,null);



       }


       public function createAds(StoreAdsRequest $request){

       $data= $request->validated();

       $ads=Ads::create($data);


       if( $ads){

       return $this->successResponse(201,'Ads created successfully' , new AdsResource($ads));


       }


           return $this->errorResponse(400, 'Ads Data Not Found' ,null);




       }



       public function updateAds(UpdateAdsRequest $request , Ads $ads){


       $data= $request->validated();

       $ads->update($data);

       return $this->successResponse(200 ,'Ads updated successfully' , new AdsResource($ads));

       


       }



       public function deleteAds(Ads $ads){


           $ads->delete();

               return $this->successResponse(200, 'Ads deleted successfully' ,null);



       }


}
