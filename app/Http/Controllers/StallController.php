<?php

namespace App\Http\Controllers;

use App\Models\Stall;
use Illuminate\Http\Request;
use Response;
use DataTables;

class StallController extends Controller
{
    public function index()
    {
        return view('cattle.stalls');
    }

    public function store(Request $request){

        $stalls = Stall::create($request->all());
        return Response::json($stalls);
    }

    public function anyData()
    {

        $stalls = Stall::all();
        return Datatables::of($stalls)
            ->addColumn('action', function ($stall) {
                return '
                <a href="#edit-'.$stall->id.'" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_stall(' . "'" . $stall->id . "'" . ')"><i class="fa fa-edit" ></i></a>
                ';
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = Stall::Where('id', $id)->get();
        return json_encode($data);
    }

    public function update(Request $request, $id)
    {
        $edit = Stall::where('id', $id)
            ->update([
                'stall_no' =>  $request->stall_no,
                'capacity' =>  $request->capacity,
                'status' => $request->status,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Stall::where('id', $id)->delete();
        return response()->json($data);
    }
}
