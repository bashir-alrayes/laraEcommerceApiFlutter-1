<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingAddressesResource;
use App\Models\Shipping_Addresses;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $shippingaddresses = Shipping_Addresses::get() ;
       return ShippingAddressesResource::collection($shippingaddresses) ;
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
            'user_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);
        $shippingaddresses = Shipping_Addresses::create([

            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,



        ]);
        return new ShippingAddressesResource($shippingaddresses);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shippingaddresses = Shipping_Addresses::find($id) ;
        return new ShippingAddressesResource($shippingaddresses);
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
        $shippingaddresses = Shipping_Addresses::find($id);
        $shippingaddresses->update([

            'user_id'=> $request->user_id ?? $shippingaddresses->user_id,
            'first_name'=>$request->first_name ?? $shippingaddresses -> first_name ,
            'last_name'=>$request->last_name ?? $shippingaddresses -> last_name ,
            'address_line_1'=>$request->address_line_1 ?? $shippingaddresses -> address_line_1 ,
            'address_line_2'=>$request->address_line_2 ?? $shippingaddresses -> address_line_2 ,
            'city'=>$request->city ?? $shippingaddresses -> city ,
            'state'=>$request->state ?? $shippingaddresses -> state ,
            'zip_code'=>$request->zip_code ?? $shippingaddresses -> zip_code ,
            'country'=>$request->country ?? $shippingaddresses -> country ,
            
        ]);
        return new ShippingAddressesResource($shippingaddresses);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shippingaddresses = Shipping_Addresses::find($id);

        if ($shippingaddresses) {
            $shippingaddresses->delete();
            return response('Address has been deleted');
        } else {
            return response('Address not found', 404); // Return a 404 Not Found status if the user is not found
        }
    }
}
