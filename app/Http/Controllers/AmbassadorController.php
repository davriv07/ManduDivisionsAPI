<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use App\Http\Requests\AmbassadorStoreRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class AmbassadorController extends Controller
{

  public function index()
  {
    $ambassadors = Ambassador::all();
    if (!$ambassadors) {
      return response()->json([
        'result' => 'No ambasadors found.'
      ], 404);
    }
    return response()->json([
      'result' => $ambassadors
    ], 200);
  }

  public function show($id)
  {
    $ambassador = Ambassador::find($id);
    if (!$ambassador) {
      return response()->json([
        'result' => 'No ambassador found!'
      ], 404);
    }
    return response()->json([
      'result' => $ambassador
    ], 200);
  }

  public function store(AmbassadorStoreRequest $request)
  {
    try {
      Ambassador::create([
        'name' => $request->name,
      ]);
      return response()->json([
        'result' => 'Ambassador succesfully created!'
      ], 200);
    } catch (Exception $ex) {
      return response()->json([
        'result' => 'Something went wrong! Could not store register.'
      ], 500);
    }
  }

  public function update(AmbassadorStoreRequest $request, $id)
  {
    try {
      $ambassador = Ambassador::find($id);
      if (!$ambassador) {
        return response()->json([
          'result' => 'No ambasador found.'
        ], 404);
      }
      DB::table('ambassadors')
        ->where('id', $id)
        ->update([
          'name' => $request->name,
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      return response()->json([
        'result' => 'Ambassador succesfully updated!'
      ], 200);
    } catch (\Throwable $th) {
      throw $th;
      return response()->json([
        'result' => 'Something went wrong! Could not update register.'
      ], 500);
    }
  }

  public function delete($id)
  {
    try {
      $ambassador = Ambassador::find($id);
      if (!$ambassador) {
        return response()->json([
          'result' => 'No ambasador found.'
        ], 404);
      }
      $ambassador->delete();
      return response()->json([
        'result' => 'Ambassador succesfully deleted!'
      ], 200);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'result' => 'Something went wrong! Could not delete register.'
      ], 500);
    }
  }
  
}
