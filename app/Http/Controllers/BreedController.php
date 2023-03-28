<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use Illuminate\Http\Request;
use Response;
use DataTables;

class BreedController extends Controller
{
    public function index()
    {
        return view('cattle.breeds');
    }

    public function store(Request $request){

        $breeds = Breed::create($request->all());
        return Response::json($breeds);
    }

    public function anyData()
    {

        $breeds = Breed::all();
        return Datatables::of($breeds)
            ->addColumn('action', function ($breed) {
                return '
                <a href="#edit-'.$breed->id.'" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_breed(' . "'" . $breed->id . "'" . ')"><i class="fa fa-edit" ></i></a>
                ';
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = Breed::Where('id', $id)->get();
        return json_encode($data);
    }

    public function update(Request $request, $id)
    {
        $edit = Breed::where('id', $id)
            ->update([
                'title' =>  $request->title,
                'status' => $request->status,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Breed::where('id', $id)->delete();
        return response()->json($data);
    }
}
