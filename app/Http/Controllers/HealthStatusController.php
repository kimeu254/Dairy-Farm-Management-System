<?php

namespace App\Http\Controllers;

use App\Models\Calf;
use App\Models\Cattle;
use App\Models\HealthStatus;
use Illuminate\Http\Request;
use Response;
use DataTables;

class HealthStatusController extends Controller
{
    public function index()
    {
        $cattle = Cattle::where('status','Active')->get();
        $calves = Calf::where('status','Active')->get();
        return view('health-and-routine.health-status',compact('cattle','calves'));
    }

    public function store(Request $request){
        $status = HealthStatus::create([
            'date' => $request->date,
            'cattle_id' => $request->cattle_id,
            'calf_id' => $request->calf_id,
            'health_status' => $request->health_status,
            'body_fitness' => $request->body_fitness,
            'description' => $request->description,
            'remarks' => $request->remarks,
            'added_by' => auth()->user()->id,
        ]);
        return Response::json($status);
    }

    public function anyData()
    {

        $statuses = HealthStatus::with('cattle','calf','user')->get();
        return Datatables::of($statuses)
            ->addColumn('cow', function ($row) {
                return $row->cattle->cattle_no .''.$row->calf->calf_no ?? 'No cattle';
            })
            ->addColumn('user', function ($row) {
                return $row->user->fname.' '.$row->user->lname ?? 'No user';
            })
            ->addColumn('date', function($row)
            {
                $date = date("d F Y", strtotime($row->date));
                return $date;
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = HealthStatus::Where('id', $id)->get();
        return json_encode($data);
    }
    
    public function update(Request $request, $id)
    {
        $edit = HealthStatus::where('id', $id)
            ->update([
                'date' => $request->date,
                'cattle_id' => $request->cattle_id,
                'calf_id' => $request->calf_id,
                'health_status' => $request->health_status,
                'body_fitness' => $request->body_fitness,
                'description' => $request->description,
                'remarks' => $request->remarks,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = HealthStatus::where('id', $id)->delete();
        return response()->json($data);
    }
}
