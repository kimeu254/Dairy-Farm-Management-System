<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Response;
use DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('hr.employees');
    }

    public function store(Request $request){
        $employee = Employee::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'id_no' => $request->id_no,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'town' => $request->town,
            'work_description' => $request->work_description,
            'salary' => $request->salary,
            'rate' => $request->rate,
            'comments' => $request->comments,
            'status' => $request->status,
            'added_by' => auth()->user()->id,
        ]);
        return Response::json($employee);
    }

    public function anyData()
    {

        $employees = Employee::with('user')->get();
        return Datatables::of($employees)
            ->addColumn('action', function ($employee) {
                return '
                <a href="'.route('employee.view', $employee->id).'" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="view_employee(' . "'" . $employee->id . "'" . ')"><i class="fa fa-eye" ></i></a>
                <a href="#edit-'.$employee->id.'" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_employee(' . "'" . $employee->id . "'" . ')"><i class="fa fa-edit" ></i></a>
                ';
            })
            ->addColumn('name', function ($row) {
                return $row->fname.' '.$row->lname;
            })
            ->addColumn('user', function ($row) {
                return $row->user->fname.' '.$row->user->lname ?? 'No user';
            })
            ->addColumn('salary', function ($row) {
                $amt = number_format($row->salary,2);
                return $amt;
            })
            ->make(true);
    }

    public function show($id)
    {
        $data = Employee::Where('id', $id)->get();
        return json_encode($data);
    }

    public function edit($id)
    {
        $employee = Employee::with('user')->find($id);
        return view('hr.view-employee',compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $edit = Employee::where('id', $id)
            ->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'id_no' => $request->id_no,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'town' => $request->town,
                'work_description' => $request->work_description,
                'salary' => $request->salary,
                'rate' => $request->rate,
                'comments' => $request->comments,
                'status' => $request->status,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Employee::where('id', $id)->delete();
        return response()->json($data);
    }
}
