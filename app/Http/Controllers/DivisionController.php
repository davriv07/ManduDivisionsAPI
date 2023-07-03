<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisionStoreRequest;
use Illuminate\Http\Request;
use App\Models\Division;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
  //
  public function index(Request $request)
  {
    try {
      //* Results per page
      $perPage = $request->query('per_page', 10);
      $divisions = DB::table('divisions as d')
        ->select('d.id', 'd.division', 'd2.division as division_parent','d.level', 'd.collaborators', 'a.name as ambassador')
        ->selectSub(function ($subquery) {
          $subquery->from('subdivisions_relations as sbr')
            ->whereColumn('sbr.id_division_parent','d.id')
            ->selectRaw('count(sbr.id)');
        },'subdivisions')
        ->leftJoin('ambassadors as a', 'a.id', 'd.id_ambassador')
        ->leftJoin('divisions as d2', 'd2.id', 'd.division_parent')
        ->orderBy('d.id')
        ->paginate($perPage);
      //* Validate
      if (!$divisions) {
        return response()->json([
          'result' => 'Divisions not found!'
        ], 404);
      }
      return response()->json([
        'result' => $divisions,
      ], 200);
    } catch (\Throwable $th) {
      throw $th;
      return response()->json([
        'result' => 'Something went wrong!'
      ], 500);
    }
  }

  public function show($id)
  {
    try {
      $division = Division::find($id);
      if (!$division) {
        return response()->json([
          'result' => 'Division not found!'
        ], 404);
      }
      return response()->json([
        'result' => $division
      ], 200);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'result' => 'Something went wrong!'
      ], 500);
    }
  }

  public function store(DivisionStoreRequest $request)
  {
    try {
      Division::create([
        'division' => $request->division,
        'division_parent' => $request->division_parent,
        'level' => $request->level ?? 1,
        'collaborators' => $request->collaborators ?? 0,
        'id_ambassador' => $request->id_ambassador,
      ]);
      return response()->json([
        'result' => 'Division succesfully created!'
      ], 200);
    } catch (\Throwable $th) {
      throw $th;
      return response()->json([
        'result' => 'Something went wrong! Could not store register.'
      ], 500);
    }
  }

  public function update(DivisionStoreRequest $request, $id)
  {
    try {
      $division = Division::find($id);
      if (!$division) {
        return response()->json([
          'result' => 'No division found.'
        ], 404);
      }
      DB::table('divisions')
        ->where('id', $id)
        ->update([
          'division' => $request->division,
          'division_parent' => $request->division_parent,
          'level' => $request->level ?? 1,
          'collaborators' => $request->collaborators ?? 0,
          'id_ambassador' => $request->id_ambassador,
        ]);
      return response()->json([
        'result' => 'Division succesfully updated!'
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
      $division = Division::find($id);
      if (!$division) {
        return response()->json([
          'result' => 'No division found.'
        ], 404);
      }
      $division->delete();
      return response()->json([
        'result' => 'Division succesfully deleted!'
      ], 200);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json([
        'result' => 'Something went wrong! Could not delete register.'
      ], 500);
    }
  }
}
