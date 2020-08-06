<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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


   	//send data to url
    $response = Http::asForm()->post('https://atomic.incfile.com/fakepost', [
    'name' => $req->Name,
    'lastName' => $req->lastName,
     ]);
     //if data fail
    if($response->successful() == false ||  
      $response->successful() ||
      $response->failed() ||
      $response->clientError() ||
      $response->serverError()){
    
       return redirect()->back()->withInput()->with('error', 'error, try again!');  
    
    }else{
        return redirect()->back()->with('success', 'success!');     
 
    }




   }


}
