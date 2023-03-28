<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Response;
use DataTables;

class TagController extends Controller
{
    public function index()
    {
        return view('accounts.tag');
    }

    public function store(Request $request){
        $tag = Tag::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'added_by' => auth()->user()->id,
        ]);
        return Response::json($tag);
    }

    public function anyData()
    {

        $tags = Tag::all();
        return Datatables::of($tags)->make(true);
    }

    public function show($id)
    {
        $data = Tag::Where('id', $id)->get();
        return json_encode($data);
    }
    
    public function update(Request $request, $id)
    {
        $edit = Tag::where('id', $id)
            ->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'status' => $request->status,
            ]);
        return response()->json($edit);

    }

    public function destroy($id)
    {
        $data = Tag::where('id', $id)->delete();
        return response()->json($data);
    }
}
