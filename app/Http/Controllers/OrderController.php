<?php

namespace App\Http\Controllers;

use Stripe;
use App\User;
use App\Models\Order;
use App\Models\UserMeta;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function review(Request $request)
    {
        $title = "Register and Pay";
        $order = session()->get('order');
        if ($request->has('order')) {
            $order = $request->order;

            session()->put('order', $order);
        }

        return view('user.pay', compact('title', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $title = "Thank you for choosing us!";

        return view('user.success', compact('title'));
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

        $user         = $data['user'];
        $user['role'] = 'customer';
        $user['name'] = "{$user['first_name']} {$user['last_name']}";

        $order           = session()->get('order');
        $order['amount'] = $order['amount'] + $order['fee'];

        $token         = $request->stripeToken;
        $paymentMethod = $request->paymentMethod;

        try {
            $user = User::firstOrCreate(['email' => $user['email']], $user);
            UserMeta::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'user_id' => $user->id,
                    'meta'    => [
                        'address' => $user['address'],
                    ],
                ]
            );

            Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));

            if (is_null($user->stripe_id)) {
                $user->createAsStripeCustomer();
            }

            Stripe\Customer::createSource(
                $user->stripe_id,
                [
                    'source' => $token
                ]
            );

            $user->newSubscription('default', 'price_monthly')
                ->quantity(5)
                ->create(
                    $paymentMethod,
                    [
                        'email' => $user->email,
                    ],
                    [
                        'metadata' => [
                            'note' => 'Some extra information.'
                        ],
                    ]
                );

            $order['user_id'] = $user->id;
            $return           = Order::create($order);

            $return ? toast('Successfuly placed order', 'success') : toast('Could not place your order', 'warning');

            return redirect()->to('success');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function track(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function modify(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function cancel(Order $order)
    {
        //
    }
}
