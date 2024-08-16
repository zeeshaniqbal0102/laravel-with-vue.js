<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateResource;
use App\Models\State;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StateResource::collection(State::orderBy('name')->get());
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
            'name' => 'required|unique:states',
            'country_id' => 'required|numeric'
        ]);
        $state = State::create($request->all());
        return response([
            'state' => new StateResource($state)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\State $state
     * @return StateResource
     */
    public function show(State $state)
    {
        return new StateResource($state);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\State $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required|unique:states,name,' . $state->id,
            'country_id' => 'required|numeric'
        ]);

        $state->update($request->all());
        return response([
            'state' => new StateResource($state)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\State $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        try {
            $state->delete();
        } catch (QueryException $exception) {
            throw new \Exception('Please delete child record first.');
        }
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
