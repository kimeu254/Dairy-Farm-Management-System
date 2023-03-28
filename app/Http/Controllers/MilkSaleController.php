<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\MilkSale;
use App\Models\Tag;
use Illuminate\Http\Request;
use Response;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class MilkSaleController extends Controller
{
    public function index()
    {
        return view('milk.milk-sale');
    }

    public function saleMilk()
    {
        $milktag = Tag::where('slug','milksale')->first();
        return view('milk.new-milk-sale',compact('milktag'));
    }

    public function store(Request $request){
        $ledger = Ledger::create([
            'tag_id' => $request->tag_id,
            'ledger_type' => $request->ledger_type,
            'date' => $request->date,
            'description' => $request->description,
            'source' => $request->source,
            'contact' => $request->contact,
            'amount' => $request->amount,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'added_by' => auth()->user()->id,
        ]);
        $milksale = MilkSale::create([
            'ledger_id' => $ledger->id,
        ]);
        return Redirect::back()->with([
            'message' => 'Milk Sale Added Successfully!',
            'milksale' => $milksale,
            'ledger' => $ledger,
        ]);
    }

    public function anyData()
    {

        $milksales = MilkSale::with('ledger')->get();
        return Datatables::of($milksales)
            ->addColumn('action', function ($milksale) {
                return '
                <a href="'.route('ledger.view', $milksale->ledger->id).'" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="view_milksale(' . "'" . $milksale->ledger->id . "'" . ')"><i class="fa fa-eye" ></i></a>
                ';
            })
            ->addColumn('date', function($row)
            {
                $date = date("d F Y", strtotime($row->ledger->date));
                return $date;
            })
            ->addColumn('quantity', function ($row) {
                return $row->ledger->quantity ?? 'No quantity';
            })
            ->addColumn('buyer', function ($row) {
                return $row->ledger->source ?? 'No buyer';
            })
            ->addColumn('contact', function ($row) {
                return $row->ledger->contact ?? 'No contact';
            })
            ->addColumn('amount', function ($row) {
                $amt = number_format($row->ledger->amount,2);
                return $amt;
            })
            ->addColumn('user', function ($row) {
                return $row->ledger->user->fname.' '.$row->ledger->user->lname ?? 'No user';
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = MilkSale::Where('id', $id)->get();
        return json_encode($data);
    }
    
    public function destroy($id)
    {
        $data = MilkSale::where('id', $id)->delete();
        return response()->json($data);
    }
}
