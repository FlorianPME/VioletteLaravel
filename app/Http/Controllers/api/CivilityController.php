<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CivilityResource;
use App\Models\Civility;
use Illuminate\Http\Request;

class CivilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CivilityResource::collection(Civility::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $civility = Civility::find($id);
        return CivilityResource::make($civility);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Civility $civility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Civility $civility)
    {
        //
    }
}
