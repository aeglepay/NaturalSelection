<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
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
        $query = User::query();

        $records = $query->where('role', 'customer')->paginate(15);
        $title   = __("customers");
        $table   = (new User)->getTable();
        $fields  = array_diff((new User)->getFillable(), ['password', 'avatar']);
        $columns = array_diff($fields, ['role']);

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

        if ($request->hasFile('avatar')) {
            $avatar          = $request->file('avatar');
            $path           = $avatar->store('public/avatars');
            $path           = str_replace('public/', '', $path);
            $data['avatar'] = "storage/$path";
        } else {
            $data['avatar'] = "https://api.adorable.io/avatars/285/{$data['email']}";
        }

        try {
            $return = User::create($data);
            $return ? toast('Successfuly created record', 'success') : toast('Could not create record', 'warning');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $record
     * @return \Illuminate\Http\Response
     */
    public function show($record = null)
    {
        $record = is_null($record) ? auth()->user() : User::find($record);
        $title = $record->name;
        return view('admin.profile', compact('record', 'title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $record
     * @return \Illuminate\Http\Response
     */
    public function edit($record = null)
    {
        $record = is_null($record) ? auth()->user() : User::find($record);
        $title = "Edit {$record->name}";
        return view('admin.edit-profile', compact('record', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $record)
    {
        $record = User::find($record);
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $image          = $request->file('avatar');
            $path           = $image->store('public/avatars');
            $path           = str_replace('public/', '', $path);
            $data['avatar'] = "storage/$path";
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
     * @param  \App\User  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy($record)
    {
        $record = User::find($record);
        try {
            $return = $record->delete();
            $return ? toast('successfuly deleted record', 'success') : toast('could not delete record', 'warning');
        } catch (\throwable $th) {
            toast($th->getmessage(), 'error');
        }

        return back();
    }
}
