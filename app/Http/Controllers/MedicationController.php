<?php

namespace App\Http\Controllers;

use App\Models\Calf;
use App\Models\Cattle;
use App\Models\Ledger;
use App\Models\Medication;
use App\Models\Tag;
use Illuminate\Http\Request;
use Response;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class MedicationController extends Controller
{
    public function index()
    {
        return view('health-and-routine.medication');
    }

    public function newMedication()
    {
        $medictag = Tag::where('slug','medication')->first();
        $cattle = Cattle::where('status','Active')->get();
        $calves = Calf::where('status','Active')->get();
        return view('health-and-routine.new-medication',compact('medictag','cattle','calves'));
    }

    public function store(Request $request){
        $ledger = Ledger::create([
            'tag_id' => $request->tag_id,
            'ledger_type' => $request->ledger_type,
            'date' => $request->date,
            'cattle_id' => $request->cattle_id,
            'calf_id' => $request->calf_id,
            'medication_name' => $request->medication_name,
            'description' => $request->description,
            'source' => $request->source,
            'contact' => $request->contact,
            'amount' => $request->amount,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'vet_remarks' => $request->vet_remarks,
            'next_appointment' => $request->next_appointment,
            'added_by' => auth()->user()->id,
        ]);
        $medication = Medication::create([
            'ledger_id' => $ledger->id,
        ]);
        return Redirect::back()->with([
            'message' => 'Medication Added Successfully!',
            'medication' => $medication,
            'ledger' => $ledger,
        ]);
    }

    public function anyData()
    {

        $medications = Medication::with('ledger')->get();
        return Datatables::of($medications)
            ->addColumn('action', function ($medication) {
                return '
                <a href="'.route('ledger.view', $medication->ledger->id).'" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="view_medication(' . "'" . $medication->ledger->id . "'" . ')"><i class="fa fa-eye" ></i></a>
                ';
            })
            ->addColumn('date', function($row)
            {
                $date = date("d F Y", strtotime($row->ledger->date));
                return $date;
            })
            ->addColumn('next_appointment', function($row)
            {
                $date = date("d F Y", strtotime($row->ledger->next_appointment));
                return $date;
            })
            ->addColumn('cow', function ($row) {
                return $row->ledger->cattle->cattle_no .''.$row->ledger->calf->calf_no ?? 'No cattle';
            })
            ->addColumn('medicine_name', function ($row) {
                return $row->ledger->medication_name ?? 'No medicine name';
            })
            ->addColumn('quantity', function ($row) {
                return $row->ledger->quantity ?? 'No quantity';
            })
            ->addColumn('vet', function ($row) {
                return $row->ledger->source ?? 'No vet';
            })
            ->addColumn('unit', function ($row) {
                return $row->ledger->unit ?? 'No unit';
            })
            ->addColumn('contact', function ($row) {
                return $row->ledger->contact ?? 'No contact';
            })
            ->addColumn('description', function ($row) {
                return $row->ledger->description ?? 'No description';
            })
            ->addColumn('remarks', function ($row) {
                return $row->ledger->vet_remarks ?? 'No vet remarks';
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
        $data = Medication::Where('id', $id)->get();
        return json_encode($data);
    }
    
    public function destroy($id)
    {
        $data = Medication::where('id', $id)->delete();
        return response()->json($data);
    }
}
