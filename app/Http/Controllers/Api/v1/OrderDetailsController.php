<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailsResource;
use App\Models\Order_Details;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderDetails = Order_Details::get();
        return OrderDetailsResource::collection($orderDetails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'order_id' => 'required|integer|max:255',
            'product_id' => 'required|integer|max:255',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0|max:999999',

        ]);
        $orderDetails = Order_Details::create([

            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,



        ]);
        return new OrderDetailsResource($orderDetails);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderDetails = Order_Details::find($id) ;
        return new OrderDetailsResource($orderDetails) ;
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
        $orderDetails = Order_Details ::find($id);
        $orderDetails->update([

            'order_id'=> $request->order_id ?? $orderDetails->order_id,
            'product_id'=>$request->product_id ?? $orderDetails -> product_id ,
            'quantity' => $request -> quantity ?? $orderDetails -> quantity,
            'price' => $request -> price?? $orderDetails -> price
            
        ]);
        return new OrderDetailsResource($orderDetails);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderDetails = Order_Details::find($id);

        if ($orderDetails) {
            $orderDetails->delete();
            return response('Order Details has been deleted');
        } else {
            return response('Order Details not found', 404); // Return a 404 Not Found status if the user is not found
        }
    }
}
