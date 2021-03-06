<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        $records = Order::query();
        $records = $records->paginate(15);
        $title   = __("Box Orders");
        $table   = (new Order)->getTable();
        $fields  = array_diff((new Order)->getFillable(), ['slug']);
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

        try {
            $return = Order::create($data);
            $return ? toast('Successfuly created record', 'success') : toast('Could not create record', 'warning');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Order $record)
    {
        return $record;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $record)
    {
        $record = Order::find($record);
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
     * @param  \App\Order  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy($record)
    {
        $record = Order::find($record);
        try {
            $return = $record->delete();
            $return ? toast('successfuly deleted record', 'success') : toast('could not delete record', 'warning');
        } catch (\throwable $th) {
            toast($th->getmessage(), 'error');
        }

        return back();
    }
}
