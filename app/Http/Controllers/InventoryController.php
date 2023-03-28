<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Ledger;
use App\Models\Tag;
use Illuminate\Http\Request;
use Response;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class InventoryController extends Controller
{
    public function index()
    {
        return view('inventory.inventories');
    }

    public function newInventory()
    {
        $inventorytag = Tag::where('slug','inventory')->first();
        return view('inventory.new-inventory',compact('inventorytag'));
    }

    public function store(Request $request){
        $ledger = Ledger::create([
            'tag_id' => $request->tag_id,
            'ledger_type' => $request->ledger_type,
            'name' => $request->name,
            'date' => $request->date,
            'inventory_type' => $request->inventory_type,
            'description' => $request->description,
            'source' => $request->source,
            'contact' => $request->contact,
            'amount' => $request->amount,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'remaining_quantity' => $request->quantity,
            'warrant' => $request->warrant,
            'added_by' => auth()->user()->id,
        ]);
        $inventory = Inventory::create([
            'ledger_id' => $ledger->id,
        ]);
        return Redirect::back()->with([
            'message' => 'Inventory Added Successfully!',
            'inventory' => $inventory,
            'ledger' => $ledger,
        ]);
    }

    public function anyData()
    {

        $inventories = Inventory::with('ledger')->get();
        return Datatables::of($inventories)
            ->addColumn('action', function ($inventory) {
                return '
                <a href="'.route('ledger.view', $inventory->ledger->id).'" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="view_inventory(' . "'" . $inventory->ledger->id . "'" . ')"><i class="fa fa-eye" ></i></a>
                ';
            })
            ->addColumn('date', function($row)
            {
                $date = date("d F Y", strtotime($row->ledger->date));
                return $date;
            })
            ->addColumn('inventory_type', function ($row) {
                return $row->ledger->inventory_type ?? 'No inventory type';
            })
            ->addColumn('warrant', function ($row) {
                return $row->ledger->warrant ?? 'No warrant';
            })
            ->addColumn('unit', function ($row) {
                return $row->ledger->unit ?? 'No unit';
            })
            ->addColumn('quantity', function ($row) {
                return $row->ledger->quantity ?? 'No quantity';
            })
            ->addColumn('remaining_quantity', function ($row) {
                return $row->ledger->remaining_quantity ?? 'Out of stock';
            })
            ->addColumn('source', function ($row) {
                return $row->ledger->source ?? 'No source';
            })
            ->addColumn('contact', function ($row) {
                return $row->ledger->contact ?? 'No contact';
            })
            ->addColumn('name', function ($row) {
                return $row->ledger->name ?? 'No name';
            })
            ->addColumn('description', function ($row) {
                return $row->ledger->description ?? 'No description';
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
        $data = Inventory::Where('id', $id)->get();
        return json_encode($data);
    }
    
    public function destroy($id)
    {
        $data = Inventory::where('id', $id)->delete();
        return response()->json($data);
    }
}
