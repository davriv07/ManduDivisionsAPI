<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubdivisionStoreRequest;
use Illuminate\Http\Request;
use App\Models\Subdivision;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class SubdivisionController extends Controller
{
  //
  public function index()
  {
    try {
      $subdivisions = Subdivision::all();
      if (!$subdivisions || sizeof($subdivisions) < 1) {
        return response()->json([
          'result' => 'Subdivisions relations not found!'
        ], 404);
      }
      return response()->json([
        'result' => $subdivisions
      ], 200);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'result' => 'Something went wrong!'
      ], 500);
    }
  }

  public function show($id)
  {
    try {
      $subdivision = Subdivision::find($id);
      if (!$subdivision) {
        return response()->json([
          'result' => 'Subdivision relation not found!'
        ], 404);
      }
      return response()->json([
        'result' => $subdivision
      ], 200);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'result' => 'Something went wrong!'
      ], 500);
    }
  }

  public function store(SubdivisionStoreRequest $request)
  {
    try {
      Subdivision::create([
        'id_division_parent' => $request->id_division_parent,
        'id_division_sub' => $request->id_division_sub,
      ]);
      return response()->json([
        'result' => 'Subdivision relation succesfully created!'
      ], 200);
    } catch (\Throwable $th) {
      // throw $th;
      return response()->json([
        'result' => 'Something went wrong! Could not store register.'
      ], 500);
    }
  }

  public function update(SubdivisionStoreRequest $request, $id)
  {
    try {
      $subdivision = Subdivision::find($id);
      if (!$subdivision) {
        return response()->json([
          'result' => 'No subdivision relation found.'
        ], 404);
      }
      DB::table('subdivisions_relations')
        ->where('id', $id)
        ->update([
          'id_division_parent' => $request->id_division_parent,
          'id_division_sub' => $request->id_division_sub,
        ]);
      return response()->json([
        'result' => 'Subdivision relation succesfully updated!'
      ], 200);
    } catch (\Throwable $th) {
      // throw $th;
      return response()->json([
        'result' => 'Something went wrong! Could not update register.'
      ], 500);
    }
  }

  public function delete($id)
  {
    try {
      $subdivision = Subdivision::find($id);
      if (!$subdivision) {
        return response()->json([
          'result' => 'No subdivision relation found.'
        ], 404);
      }
      $subdivision->delete();
      return response()->json([
        'result' => 'Subdivision relation succesfully deleted!'
      ], 200);
    } catch (\Throwable $th) {
      // throw $th;
      return response()->json([
        'result' => 'Something went wrong! Could not delete register.'
      ], 500);
    }
  }
}
