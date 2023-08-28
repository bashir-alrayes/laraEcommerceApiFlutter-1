<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
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
        $order = Order::get() ;
        return OrderResource::collection($order) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->  validate ([

            'user_id' => 'required|integer', 
            'total' => 'required|numeric',
        ]) ;
        $order = Order:: create ([

            'user_id' => $request -> user_id ,
            'total' => $request -> total

        ]) ;
        return new OrderResource($order) ;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order :: find($id) ;
        return new OrderResource($order) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update([

            'user_id'=> $request->user_id ?? $order ->user_id,
            'total'=> $request->total ?? $order -> total ,
            
        ]);
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();
            return response('Order has been deleted');
        } else {
            return response('Order not found', 404); // Return a 404 Not Found status if the user is not found
        }
    }
}
