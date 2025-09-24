<?php

namespace App\Http\Controllers;

use App\Helpers\AttendanceHelper;
use App\Helpers\SalaryHelper;
use App\Models\EmpPresence;
use App\Models\EmpSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmpPresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = EmpPresence::with('employee')->orderByDesc('created_at')->paginate(10);
        return view('pages.presence.index', compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = \App\Models\Employee::all();
        return view('pages.presence.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
        ]);

        $late_in = Carbon::parse($request->check_in);
        $early_out = $request->check_out ? Carbon::parse($request->check_out) : null;

        $presence = new EmpPresence();
        $presence->employee_id = $request->employee_id;
        $presence->check_in = $request->check_in;
        $presence->check_out = $request->check_out;
        $presence->late_in = AttendanceHelper::calculateLateIn($late_in);
        $presence->early_out = AttendanceHelper::calculateEarlyOut($early_out);
        $presence->save();

        return redirect()->route('presences.index')->with('success', 'Presence recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmpPresence $empPresence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmpPresence $presence)
    {
        $employees = \App\Models\Employee::all();
        $presence = EmpPresence::with('employee')->find($presence->id);
        return view('pages.presence.edit', compact('presence', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmpPresence $presence)
    {
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
        ]);

        $late_in = Carbon::parse($request->check_in);
        $early_out = $request->check_out ? Carbon::parse($request->check_out) : null;

        $presence->employee_id = $request->employee_id;
        $presence->check_in = $request->check_in;
        $presence->check_out = $request->check_out;
        $presence->late_in = AttendanceHelper::calculateLateIn($late_in);
        $presence->early_out = AttendanceHelper::calculateEarlyOut($early_out);
        $presence->save();


        return redirect()->route('presences.index')->with('success', 'Presence updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmpPresence $presence)
    {
        $presence->delete();
        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully.');
    }
}
