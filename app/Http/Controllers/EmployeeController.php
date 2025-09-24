<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::paginate(10);
        return view('pages.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:employee',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:25',
            'image' => 'nullable|image|max:2048'
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $filename, 'public');
            $employee->user_picture = 'storage/' . $path;
        }
        $employee->password = bcrypt('password');
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::findOrFail($employee->id);
        return view('pages.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:employee,email,' . $employee->id,
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:25',
            'image' => 'nullable|image|max:2048'
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;

        if ($request->hasFile('image')) {
            if ($employee->user_picture && file_exists(public_path($employee->user_picture))) {
                unlink(public_path($employee->user_picture));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $filename, 'public');
            $employee->user_picture = 'storage/' . $path;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->user_picture && file_exists(public_path($employee->user_picture))) {
            unlink(public_path($employee->user_picture));
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
