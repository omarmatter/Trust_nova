<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RepleyController extends Controller
{
    public  function  store(Request $request,$id){

      $tiket= Tiket::find($id);
    $data=  $tiket->replies()->create([
          'message'=>$request->message
      ]);
    return response()->json(
[        'data'=>$data
]
    );
    }

}
