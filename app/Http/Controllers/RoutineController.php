<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use Illuminate\Http\Request;
use Response;
use DataTables;

class RoutineController extends Controller
{
    public function index()
    {
        return view('health-and-routine.cow-routine');
    }

    public function store(Request $request){
        $routine = Routine::create([
            'title' => $request->title,
            'rate' => $request->rate,
            'description' => $request->description,
            'comments' => $request->comments,
            'status' => $request->status,
            'added_by' => auth()->user()->id,
        ]);
        return Response::json($routine);
    }

    public function anyData()
    {

        $routines = Routine::all();
        return Datatables::of($routines)->make(true);
    }

    public function show($id)
    {
        $data = Routine::Where('id', $id)->get();
        return json_encode($data);
    }

    public function update(Request $request, $id)
    {
        $edit = Routine::where('id', $id)
            ->update([
                'title' => $request->title,
                'rate' => $request->rate,
                'description' => $request->description,
                'comments' => $request->comments,
                'status' => $request->status,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Routine::where('id', $id)->delete();
        return response()->json($data);
    }
}
