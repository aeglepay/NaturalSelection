<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Stripe;

class CategoryController extends Controller
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
        $records = Category::query();
        $records = $records->paginate(15);
        $title   = __("Categories");
        $table   = (new Category)->getTable();
        $fields  = array_diff((new Category)->getFillable(), ['slug', 'plan', 'product']);
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
            $return = Category::create($data);
            $return ? toast('Successfuly created record', 'success') : toast('Could not create record', 'warning');
            if ($return) {
                Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));
                $plan = Stripe\Plan::create([
                    'amount'   => 1,
                    'currency' => 'usd',
                    'interval' => 'month',
                    'product'  => [
                        'name'        => $data['title'],
                        'description' => $data['content'],
                    ],
                ]);

                $return['plan']    = $plan->id;
                $return['product'] = $plan->product;
            }
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Category $record)
    {
        return $record;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $record)
    {
        $record = Category::find($record);
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
            if ($return) {
                Stripe\Plan::update(
                    'price_1HApY12eZvKYlo2Cf6ljCBjN',
                    ['metadata' => ['order_id' => '6735']]
                );
            }
        } catch (\throwable $th) {
            toast($th->getmessage(), 'error');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy($record)
    {
        $record = Category::find($record);
        try {
            $return = $record->delete();
            $return ? toast('successfuly deleted record', 'success') : toast('could not delete record', 'warning');
        } catch (\throwable $th) {
            toast($th->getmessage(), 'error');
        }

        return back();
    }
}
