<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'filter']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::with(['user'])->get();

        return response()->json([
            'status' => true,
            'advertisements' => $advertisements,
        ]);
    }

    /**
     * Display a filtered listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $advertisements = Advertisement::with(['user'])->get();

        return response()->json([
            'status' => true,
            'advertisements' => $advertisements,
            'filters' => $request->all(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertisementRequest $request)
    {
        $advertisement = Advertisement::create($request->all());

        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user->advertisements()->save($advertisement);

        return response()->json([
            'status' => true,
            'message' => "Advertisement Created successfully!",
            'advertisement' => $advertisement
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdvertisementRequest $request, Advertisement $advertisement)
    {
        $advertisement->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Advertisement Updated successfully!",
            'advertisement' => $advertisement
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();

        return response()->json([
            'status' => true,
            'message' => "Advertisement Deleted successfully!",
        ], 200);
    }
}
