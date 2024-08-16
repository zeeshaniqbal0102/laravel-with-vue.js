<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
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
            'departments' => DepartmentResource::collection(Department::orderBy('name')->get()),
            'countries' => Country::with('states.cities')->orderBy('name')->get(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::latest()->get());
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
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'department_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'zip' => 'required|numeric'
        ]);

        $employee = Employee::create($request->all());
        return response([
            'employee' => new EmployeeResource($employee)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return EmployeeResource
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'department_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'zip' => 'required|numeric'
        ]);

        $employee->update($request->all());
        return response([
            'employee' => new EmployeeResource($employee)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
        } catch (QueryException $exception) {
            throw new \Exception('Please delete child record first.');
        }
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
