<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductReviewResource;
use App\Models\Product_Reviews;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtReview = Product_Reviews::get() ;
        return ProductResource::collection($produtReview) ;
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

            'product_id' => 'required|integer',
            'user_id' => 'required|integer',
            'review' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
           
        ]);
        $produtReview = Product_Reviews::create([

            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'review' => $request->review,
            'rating' => $request->rating,



        ]);
        return new ProductReviewResource($produtReview);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produtReview = Product_Reviews::find($id) ;
        return new ProductReviewResource($produtReview) ;
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
        $produtReview = Product_Reviews::find($id);
        $produtReview->update([

            'product_id'=> $request->product_id ?? $produtReview->product_id,
            'user_id'=>$request->user_id ?? $produtReview -> user_id ,
            'review'=>$request->review ?? $produtReview -> review ,
            'rating'=>$request->rating ?? $produtReview -> rating ,
            
        ]);
        return new ProductReviewResource($produtReview);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produtReview = Product_Reviews::find($id);

        if ($produtReview) {
            $produtReview->delete();
            return response('produtReview has been deleted');
        } else {
            return response('produtReview not found', 404); // Return a 404 Not Found status if the user is not found
        }
    }
}
