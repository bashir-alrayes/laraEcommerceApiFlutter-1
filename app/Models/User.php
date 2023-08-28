<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One-to-Many relation with Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Many-to-Many relation with Products for Wishlist
    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wishlists');
    }

    // One-to-Many relation with Reviews
    public function reviews()
    {
        return $this->hasMany(Product_Reviews::class);
    }

    // One-to-Many relation with ShippingAddresses
    public function shippingAddresses()
    {
        return $this->hasMany(Shipping_Addresses::class);
    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->login($request->device_name)->plainTextToken;
    
    }
    
    public function signout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=> 'Token revoked']);
    }


}
