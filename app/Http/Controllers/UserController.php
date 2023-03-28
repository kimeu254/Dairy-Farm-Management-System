<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Response;
use DataTables;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('users.users', compact('roles'));
    }

    public function show($id)
    {
        $data = User::Where('id', $id)->get();
        return json_encode($data);
    }

    public function anyData()
    {
        $users = User::all();
        return DataTables::of($users)
            ->editColumn('action', function ($user) {
                return '
                <a href="#edit-'.$user->id.'" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onclick="edit_user(' . "'" . $user->id . "'" . ')"><i class="fa fa-edit" ></i></a>
                ';
            })
            ->addColumn('role', function($row)
            {
                return $row->roles->first()->display_name ?? 'No role';
            })
            ->addColumn('created_at', function($row)
            {
                $date = \Carbon\Carbon::parse($row->created_at)->toDayDateTimeString();
                return $date;
            })
            ->make(true);
    }

    public function update(Request $request, $id)
    {
        $edit = User::find($id);
        $current_role = $edit->roles->first();
        $edit->detachRole($current_role);
        $edit->attachRole($request->role_name);
        return response()->json($edit);

    }
}
