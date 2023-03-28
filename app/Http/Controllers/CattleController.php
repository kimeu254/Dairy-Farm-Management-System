<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Calf;
use App\Models\Cattle;
use App\Models\Stall;
use Illuminate\Http\Request;
use Response;
use DataTables;

class CattleController extends Controller
{
    public function index()
    {
        $breeds = Breed::where('status','Active')->get();
        $stalls = Stall::where('status','Active')->get();
        return view('cattle.cattle', compact('breeds','stalls'));
    }

    public function store(Request $request){
        $cattle = Cattle::create([
            'cattle_no' => $request->cattle_no,
            'breed_id' => $request->breed_id,
            'stall_id' => $request->stall_id,
            'weight' => $request->weight,
            'farm_entry_date' => $request->farm_entry_date,
            'purchase_amt' => $request->purchase_amt,
            'current_value' => $request->current_value,
            'comments' => $request->comments,
            'status' => $request->status,
            'user_id' => auth()->user()->id,
        ]);
        return Response::json($cattle);
    }

    public function anyData()
    {

        $cattles = Cattle::with('breed','stall')->get();
        return Datatables::of($cattles)
            ->addColumn('action', function ($cattle) {
                return '
                <a href="'.route('cattle.view', $cattle->id).'" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="view_cattle(' . "'" . $cattle->id . "'" . ')"><i class="fa fa-eye" ></i></a>
                <a href="#edit-'.$cattle->id.'" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_cattle(' . "'" . $cattle->id . "'" . ')"><i class="fa fa-edit" ></i></a>
                ';
            })
            ->addColumn('breed', function ($row) {
                return $row->breed->title ?? 'No breed';
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
        $data = Cattle::Where('id', $id)->get();
        return json_encode($data);
    }

    public function edit($id)
    {
        $cattle = Cattle::with('user','breed','stall')->find($id);
        $calves = Calf::where('parent_id',$id)->where('status','Active')->get();
        return view('cattle.view-cattle',compact('cattle','calves'));
    }


    public function update(Request $request, $id)
    {
        $edit = Cattle::where('id', $id)
            ->update([
                'cattle_no' =>  $request->cattle_no,
                'breed_id' =>  $request->breed_id,
                'stall_id' =>  $request->stall_id,
                'weight' =>  $request->weight,
                'farm_entry_date' =>  $request->farm_entry_date,
                'purchase_amt' =>  $request->purchase_amt,
                'current_value' =>  $request->current_value,
                'comments' =>  $request->comments,
                'status' => $request->status,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Cattle::where('id', $id)->delete();
        return response()->json($data);
    }
}
