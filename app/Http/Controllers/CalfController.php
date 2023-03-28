<?php

namespace App\Http\Controllers;

use App\Models\Calf;
use App\Models\Cattle;
use App\Models\Stall;
use Illuminate\Http\Request;
use Response;
use DataTables;

class CalfController extends Controller
{
    public function index()
    {
        $parents = Cattle::where('status','Active')->get();
        $stalls = Stall::where('status','Active')->get();
        return view('cattle.calf',compact('parents','stalls'));
    }

    public function store(Request $request){
        $calf = Calf::create([
            'calf_no' => $request->calf_no,
            'parent_id' => $request->parent_id,
            'stall_id' => $request->stall_id,
            'weight' => $request->weight,
            'birth_date' => $request->birth_date,
            'insemination_type' => $request->insemination_type,
            'current_value' => $request->current_value,
            'comments' => $request->comments,
            'status' => $request->status,
            'user_id' => auth()->user()->id,
        ]);
        return Response::json($calf);
    }

    public function anyData()
    {

        $calves = Calf::with('cattle','stall')->get();
        return Datatables::of($calves)
            ->addColumn('action', function ($calf) {
                return '
                <a href="'.route('calf.view', $calf->id).'" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="view_calf(' . "'" . $calf->id . "'" . ')"><i class="fa fa-eye" ></i></a>
                <a href="#edit-'.$calf->id.'" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_calf(' . "'" . $calf->id . "'" . ')"><i class="fa fa-edit" ></i></a>
                ';
            })
            ->addColumn('cattle', function ($row) {
                return $row->cattle->cattle_no ?? 'No parent';
            })
            ->addColumn('stall', function ($row) {
                return $row->stall->stall_no ?? 'No stall';
            })
            ->addColumn('current_value', function ($row) {
                $amt = number_format($row->current_value,2);
                return $amt;
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = Calf::Where('id', $id)->get();
        return json_encode($data);
    }
    
    public function edit($id)
    {
        $calf = Calf::with('user','cattle','stall')->find($id);
        return view('cattle.view-calf',compact('calf'));
    }

    public function update(Request $request, $id)
    {
        $edit = Calf::where('id', $id)
            ->update([
                'calf_no' =>  $request->calf_no,
                'parent_id' =>  $request->parent_id,
                'stall_id' =>  $request->stall_id,
                'weight' =>  $request->weight,
                'birth_date' =>  $request->birth_date,
                'insemination_type' =>  $request->insemination_type,
                'current_value' =>  $request->current_value,
                'comments' =>  $request->comments,
                'status' => $request->status,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Calf::where('id', $id)->delete();
        return response()->json($data);
    }
}
