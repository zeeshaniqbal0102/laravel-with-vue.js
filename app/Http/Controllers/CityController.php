<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    /**
     * Get basic data for form
     * @return \Illuminate\Http\JsonResponse
     */
    function basicData()
    {
        return response()->json([
            'countries' => Country::with('states')->orderBy('name')->get(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CityResource::collection(City::orderBy('name')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cities',
            'state_id' => 'required|numeric',
            'country_id' => 'required|numeric'
        ]);
        $city = City::create($request->all());
        return response([
            'city' => new CityResource($city)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\City $city
     * @return CityResource
     */
    public function show(City $city)
    {
        return new CityResource($city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|unique:cities,name,' . $city->id,
            'state_id' => 'required|numeric',
            'country_id' => 'required|numeric'
        ]);

        $city->update($request->all());
        return response([
            'city' => new CityResource($city)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        try {
            $city->delete();
        } catch (QueryException $exception) {
            throw new \Exception('Please delete child record first.');
        }
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
