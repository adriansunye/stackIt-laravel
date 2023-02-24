<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function me()
    {
        return response()->json([
            'status' => true,
            'user' => [
                'user' => new UserResource(auth()->user()),
            ]
        ]);
    }

    public function myAdvertisements()
    {
        $user_id = Auth::user()->id;
        $advertisements = User::where('id', $user_id)->with(['advertisements'])->get();
        return response()->json([
            'status' => true,
                'advertisements' => $advertisements,
        ]);
    }
}
