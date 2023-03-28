<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Ledger;
use App\Models\Usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Response;
use DataTables;

class UsageController extends Controller
{
    public function index()
    {
        return view('inventory.usage');
    }

    public function newUsage()
    {
        $inventories = Inventory::with('ledger')->get();
        return view('inventory.new-usage', compact('inventories'));
    }

    public function store(Request $request)
    {
        if ($request->used_qty > $request->initial_qty) {
            return Redirect::back()->with(
                'error','Usage cannot be larger than the Available Quantity.'
            );
        }

        if ($request->used_qty < 1) {
            return Redirect::back()->with(
                'error','Select a Valid Quantity.'
            );
        }
        $usage = Usage::create([
            'inventory_id' => $request->inventory_id,
            'date' => $request->date,
            'initial_qty' => $request->initial_qty,
            'used_qty' => $request->used_qty,
            'final_qty' => $request->initial_qty-$request->used_qty,
            'description' => $request->description,
            'added_by' => auth()->user()->id,
        ]);
        $inventory = Inventory::with('ledger')->where('id',$usage->inventory_id)->first();
        $ledger = Ledger::where('id', $inventory->ledger->id)->update([
            'remaining_quantity' => $usage->final_qty,
        ]);

        return Redirect::back()->with([
            'message' => 'Usage Added Successfully!',
            'inventory' => $inventory,
            'ledger' => $ledger,
            'usage' => $usage,
        ]);
    }

    public function anyData()
    {

        $usages = Usage::with('inventory','user')->get();
        return Datatables::of($usages)
            ->addColumn('action', function ($usage) {
                return '
                <a href="'.route('usage.view', $usage->id).'" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="view_usage(' . "'" . $usage->id . "'" . ')"><i class="fa fa-eye" ></i></a>
                ';
            })
            ->addColumn('date', function($row)
            {
                $date = date("d F Y", strtotime($row->date));
                return $date;
            })
            ->addColumn('name', function ($row) {
                return $row->inventory->ledger->name ?? 'No name';
            })
            ->addColumn('unit', function ($row) {
                return $row->inventory->ledger->unit ?? 'No unit';
            })
            ->addColumn('user', function ($row) {
                return $row->user->fname.' '.$row->user->lname ?? 'No user';
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = Usage::Where('id', $id)->get();
        return json_encode($data);
    }

    public function edit($id)
    {
        $usage = Usage::with('user','inventory')->find($id);
        return view('inventory.view-usage',compact('usage'));
    }
    
    public function destroy($id)
    {
        $data = Usage::where('id', $id)->delete();
        return response()->json($data);
    }
}
