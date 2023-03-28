<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Response;
use DataTables;

class LeaveController extends Controller
{
    public function index()
    {
        $employees = Employee::where('status','Active')->get();
        return view('hr.leaves',compact('employees'));
    }

    public function store(Request $request){
        $leave = Leave::create([
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'comments' => $request->comments,
            'check_in_status' => $request->check_in_status,
            'added_by' => auth()->user()->id,
        ]);
        return Response::json($leave);
    }

    public function anyData()
    {

        $leaves = Leave::with('user','employee')->get();
        return Datatables::of($leaves)
            ->addColumn('action', function ($leave) {
                return '
                <a href="#edit-'.$leave->id.'" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_leave(' . "'" . $leave->id . "'" . ')"><i class="fa fa-edit" ></i></a>
                ';
            })
            ->addColumn('user', function ($row) {
                return $row->user->fname.' '.$row->user->lname ?? 'No user';
            })
            ->addColumn('employee', function ($row) {
                return $row->employee->fname.' '.$row->employee->lname ?? 'No employee';
            })
            ->addColumn('start_date', function($row)
            {
                $date = date("d F Y", strtotime($row->start_date));
                return $date;
            })
            ->addColumn('end_date', function($row)
            {
                $date = date("d F Y", strtotime($row->end_date));
                return $date;
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = Leave::Where('id', $id)->get();
        return json_encode($data);
    }

    public function update(Request $request, $id)
    {
        $edit = Leave::where('id', $id)
            ->update([
                'employee_id' => $request->employee_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'comments' => $request->comments,
                'check_in_status' => $request->check_in_status,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Leave::where('id', $id)->delete();
        return response()->json($data);
    }
}
