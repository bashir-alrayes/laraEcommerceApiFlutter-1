<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist = Wishlist::get() ;
        return WishlistResource::collection($wishlist);
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
            'product_id' => 'required|integer',
            
           
        ]);
        $wishlist = Wishlist::create([

           
            'user_id' => $request->user_id,
            'product_id' => $request->review,
            



        ]);
        return new WishlistResource($wishlist);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wishlist = Wishlist::find($id);
        return new WishlistResource($wishlist) ;
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
        $wishlist = Wishlist::find($id);
        $wishlist->update([

            'user_id'=> $request->user_id ?? $wishlist->user_id,
            'product_id'=>$request->product_id ?? $wishlist -> product_id ,
            
        ]);
        return new WishlistResource($wishlist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::find($id);

        if ($wishlist) {
            $wishlist->delete();
            return response('wishlist has been deleted');
        } else {
            return response('wishlist not found', 404); // Return a 404 Not Found status if the user is not found
        }
    }
}
