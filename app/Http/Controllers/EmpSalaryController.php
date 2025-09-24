<?php

namespace App\Http\Controllers;

use App\Helpers\SalaryHelper;
use App\Models\Employee;
use App\Models\EmpSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmpSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = EmpSalary::with('employee')->orderByDesc('created_at')->paginate(10);
        return view('pages.salary.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('pages.salary.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'basic_salary' => 'required|numeric|min:0',
            'loan' => 'required|numeric|min:0',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|numeric',
        ]);

        $exists = EmpSalary::where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['duplicate' => 'Salary for this employee in the selected month and year already exists.']);
        }

        $salary = new EmpSalary();
        $salary->employee_id = $request->employee_id;
        $salary->month = $request->month;
        $salary->year = $request->year;
        $salary->basic_salary = $request->basic_salary;
        $salary->bpjs = (int) ($request->basic_salary * 0.02);
        $salary->jp = (int) ($request->basic_salary * 0.01);
        $salary->loan = $request->loan;

        $penalty = SalaryHelper::calculatePenalty($request->employee_id);
        $salary->bonus = -$penalty;
        $salary->total_salary = SalaryHelper::calculateTotalSalary(
            $salary->basic_salary,
            $salary->bonus,
            $salary->bpjs,
            $salary->jp,
            $salary->loan,
            $penalty
        );

        $salary->save();

        return redirect()->route('salary.index')->with('success', 'Salary record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmpSalary $empSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmpSalary $salary)
    {
        $salary = EmpSalary::findOrFail($salary->id);
        $employees = Employee::all();

        return view('pages.salary.edit', compact('salary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'basic_salary' => 'required|numeric|min:0',
            'loan' => 'required|numeric|min:0',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|numeric',
        ]);

        $salary = EmpSalary::findOrFail($id);

        $exists = EmpSalary::where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->where('id', '!=', $salary->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['duplicate' => 'Salary for this employee in the selected month and year already exists.']);
        }

        $salary->basic_salary = $request->basic_salary;
        $salary->loan = $request->loan;
        $salary->bpjs = (int) ($request->basic_salary * 0.02);
        $salary->jp = (int) ($request->basic_salary * 0.01);

        $penalty = SalaryHelper::calculatePenalty($request->employee_id);
        $salary->bonus = -$penalty;

        $salary->total_salary = SalaryHelper::calculateTotalSalary(
            $salary->basic_salary,
            $salary->bonus,
            $salary->bpjs,
            $salary->jp,
            $salary->loan,
            $penalty
        );

        $salary->save();

        return redirect()->route('salary.index')->with('success', 'Salary record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmpSalary $salary)
    {
        $salary->delete();
        return redirect()->route('salary.index')->with('success', 'Salary record deleted successfully.');
    }

    /**
     * Display information for generating monthly salaries.
     */
    public function monthly(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $salaries = EmpSalary::with('employee')
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        $total_salaries = $salaries->sum('total_salary');

        return view('pages.salary.monthly.index', compact('salaries', 'month', 'year', 'total_salaries'));
    }

}