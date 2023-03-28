<?php

namespace App\Http\Controllers;

use App\Models\Cattle;
use App\Models\Milk;
use Illuminate\Http\Request;
use Response;
use DataTables;

class MilkController extends Controller
{
    public function index()
    {
        $cattles = Cattle::where('status','Active')->get();
        return view('milk.produce',compact('cattles'));
    }

    public function store(Request $request){
        $total = $request->morning_amt+$request->noon_amt+$request->evening_amt;
        $milk = Milk::create([
            'cattle_id' => $request->cattle_id,
            'date' => $request->date,
            'morning_amt' => $request->morning_amt,
            'noon_amt' => $request->noon_amt,
            'evening_amt' => $request->evening_amt,
            'total' => $total,
            'added_by' => auth()->user()->id,
        ]);
        return Response::json($milk);
    }

    public function anyData()
    {

        $milks = Milk::with('cattle','user')->get();
        return Datatables::of($milks)
            ->addColumn('action', function ($milk) {
                return '
                <a href="#edit-'.$milk->id.'" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_milk(' . "'" . $milk->id . "'" . ')"><i class="fa fa-edit" ></i></a>
                ';
            })
            ->addColumn('cattle', function ($row) {
                return $row->cattle->cattle_no ?? 'No cattle';
            })
            ->addColumn('user', function ($row) {
                return $row->user->fname.' '.$row->user->lname ?? 'No user';
            })
            ->addColumn('date', function($row)
            {
                $date = date("d F Y", strtotime($row->date));
                return $date;
            })
            ->addColumn('morning_amt', function ($row) {
                $amt = number_format($row->morning_amt);
                return $amt;
            })
            ->addColumn('noon_amt', function ($row) {
                $amt = number_format($row->noon_amt);
                return $amt;
            })
            ->addColumn('evening_amt', function ($row) {
                $amt = number_format($row->evening_amt);
                return $amt;
            })
            ->addColumn('total', function ($row) {
                $amt = number_format($row->total);
                return $amt;
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = Milk::Where('id', $id)->get();
        return json_encode($data);
    }

    public function update(Request $request, $id)
    {
        $edit = Milk::where('id', $id)
            ->update([
                'cattle_id' => $request->cattle_id,
                'date' => $request->date,
                'morning_amt' => $request->morning_amt,
                'noon_amt' => $request->noon_amt,
                'evening_amt' => $request->evening_amt,
                'total' => $request->morning_amt+$request->noon_amt+$request->evening_amt,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Milk::where('id', $id)->delete();
        return response()->json($data);
    }
}
