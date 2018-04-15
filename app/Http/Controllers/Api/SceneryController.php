<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Auth;

use App\Scenery;

class SceneryController extends Controller
{
    /**
     * @param Request $request
     * @return Scenery
     */
    public function index(Request $request) {
        $sceneries = Scenery::get();
        return $sceneries;
    }

    /**
     * @param $id
     * @return Scenery
     */
    public function show(Request $request, $id) {
        $scenery = Scenery::findOrFail((int)$id);
        return $scenery;
    }

    /**
     * @param Request $request
     * @return Scenery
     */
    public function update(Request $request, $id) {
        $scenery = Scenery::find($id);
        // Return 403 if not enough permissions
        if(Auth::user()->cant('update', $scenery)) { return response()->json('Forbidden', 403); }

        $scenery->update($request->all());

        return $scenery->fresh();
    }
}
