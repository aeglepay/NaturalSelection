<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $records = Brand::query();
        $records = $records->paginate(15);
        $title   = __("Brand Selections");
        $table   = (new Brand)->getTable();
        $fields  = array_diff((new Brand)->getFillable(), ['slug']);
        $columns = array_diff($fields, ['image', 'content']);

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
            $data['image'] = "https://api.adorable.io/images/285/{$data['title']}";
        }

        try {
            $return = Brand::create($data);
            $return ? toast('Successfuly created record', 'success') : toast('Could not create record', 'warning');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $record)
    {
        return $record;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $record)
    {
        $record = Brand::find($record);
        $data = $request->all();

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
     * @param  \App\Brand  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy($record)
    {
        $record = Brand::find($record);
        try {
            $return = $record->delete();
            $return ? toast('successfuly deleted record', 'success') : toast('could not delete record', 'warning');
        } catch (\throwable $th) {
            toast($th->getmessage(), 'error');
        }

        return back();
    }
}
