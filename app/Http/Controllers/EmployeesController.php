<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        return response()->json(Employee::all());
    }

    public function show($id)
    {
        return response()->json(Employee::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'position' => 'required',
            'superior' => 'required_if:position,==,Developer'
        ]);

        $employee = Employee::create($request->all());

        return response()->json($employee, 201);
    }

    public function update($id, Request $request)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return response()->json($employee, 200);
    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

    public function getManagementEmployees($id)
    {
        return Employee::findOrFail($id)->employees()->get();
    }

    public function filterByPosition($position)
    {
        return Employee::where('position', $position)->get();
    }
}
