<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\postDataJob;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class fakePostController extends Controller
{
  

  public function index(){

  	 return view('welcome');
  }  


   
   public function postData(Request $req){

   	$validator = Validator::make($req->all(), [
       'name' => 'required',
       'lastName' => 'required',
      ]);

   	  //return error if fail something
   if ($validator->fails()){
   	    $messages = $validator->messages();
       return redirect()->back()->withErrors($messages)->withInput();
    } 

      $data =array(
      	       'name'=>$req->name,
      	       'lastName'=>$req->lastName
               );


    //send data to url
    $response = Http::asForm()->post('https://atomic.incfile.com/fakepost',$data);

     //if data fail
    if($response->successful() == false ||  
      $response->successful() ||
      $response->failed() ||
      $response->clientError() ||
      $response->serverError()){

     //Job
     postDataJob::dispatch($data); 
    
    return redirect()->back()->withInput()->with('error', 'error, try again!');   
    
    }else{
      
    return redirect()->back()->with('success', 'success!');    
         
    }

  }

}
