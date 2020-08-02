<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Feature::query();

        $records = $records->paginate(15);
        $title   = __("Features");
        $table   = (new Feature)->getTable();
        $fields  = array_diff((new Feature)->getFillable(), ['slug']);
        $columns = array_diff($fields, ['image']);

        return view('admin.table', compact('records', 'fields', 'columns', 'title', 'table'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = str_slug($data['title']);

        if ($request->hasFile('image')) {
            $image         = $request->file('image');
            $path          = $image->store('public/images');
            $path          = str_replace('public/', '', $path);
            $data['image'] = "storage/$path";
        } else {
            $data['image'] = "https://api.adorable.io/avatars/285/{$data['title']}";
        }

        try {
            $return = Feature::create($data);
            $return ? toast('Successfuly created record', 'success') : toast('Could not create record', 'warning');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feature  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $record)
    {
        return $record;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feature  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $record)
    {
        $record = Feature::find($record);
        $data   = $request->all();

        if ($request->hasFile('image')) {
            $image         = $request->file('image');
            $path          = $image->store('public/images');
            $path          = str_replace('public/', '', $path);
            $data['image'] = "storage/$path";
        }

        try {
            $return = $record->update($data);
            $return ? toast('successfuly updated record', 'success') : toast('Could not update record', 'warning');
        } catch (\throwable $th) {
            toast($th->getmessage(), 'error');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feature  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $record)
    {
        try {
            $return = $record->delete();
            $return ? toast('successfuly deleted record', 'success') : toast('could not delete record', 'warning');
        } catch (\throwable $th) {
            toast($th->getmessage(), 'error');
        }

        return back();
    }
}
