<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Tag;
use Illuminate\Http\Request;
use Response;
use DataTables;

class LedgerController extends Controller
{
    public function index()
    {
        $tags = Tag::where('status','Active')->where('added_by','!=','')->get();
        return view('accounts.ledger',compact('tags'));
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
            'added_by' => auth()->user()->id,
        ]);
        return Response::json($ledger);
    }

    public function anyData()
    {

        $ledgers = Ledger::with('user','tag')->get();
        return Datatables::of($ledgers)
            ->addColumn('action', function ($ledger) {
                return '
                <a href="'.route('ledger.view', $ledger->id).'" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="view_ledger(' . "'" . $ledger->id . "'" . ')"><i class="fa fa-eye" ></i></a>
                ';
            })
            ->addColumn('tag', function ($row) {
                return $row->tag->title ?? 'No tag';
            })
            ->addColumn('amount', function ($row) {
                $amt = number_format($row->amount,2);
                return $amt;
            })
            ->addColumn('date', function($row)
            {
                $date = date("d F Y", strtotime($row->date));
                return $date;
            })
            ->addColumn('user', function ($row) {
                return $row->user->fname.' '.$row->user->lname ?? 'No user';
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = Ledger::Where('id', $id)->get();
        return json_encode($data);
    }

    public function edit($id)
    {
        $ledger = Ledger::with('user','tag')->find($id);
        return view('accounts.view-ledger',compact('ledger'));
    }
    
    public function update(Request $request, $id)
    {
        $edit = Ledger::where('id', $id)
            ->update([
                'tag_id' => $request->tag_id,
                'ledger_type' => $request->ledger_type,
                'date' => $request->date,
                'description' => $request->description,
                'source' => $request->source,
                'contact' => $request->contact,
                'amount' => $request->amount,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Ledger::where('id', $id)->delete();
        return response()->json($data);
    }
}
