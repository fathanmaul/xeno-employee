@extends('layouts.app')
@section('title', 'Edit Salary')

@section('content')
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{ route('salary.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Edit Salary</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('salary.index') }}">Salary</a></div>
        <div class="breadcrumb-item">Edit Salary</div>
      </div>
    </div>

    @error('duplicate')
      <div class="alert alert-danger">
        {{ $message }}
      </div>
    @enderror

    <div class="section-body">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Salary Form</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('salary.update', $salary->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="form-group col-12 col-md-12">
                    <label for="name">Employee</label>
                    <select name="employee_id" class="form-control" disabled>
                      @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $salary->employee_id == $employee->id ? 'selected' : '' }}>
                          {{ $employee->name }}
                        </option>
                      @endforeach
                    </select>
                    <input type="hidden" name="employee_id" value="{{ $salary->employee_id }}">
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="month">Month</label>
                    <select name="month" id="month" class="form-control" disabled>
                      @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}" {{ $salary->month == $month ? 'selected' : '' }}>
                          {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                        </option>
                      @endforeach
                    </select>
                    <input type="hidden" name="month" value="{{ $salary->month }}">
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="year">Year</label>
                    <select name="year" id="year" class="form-control" disabled>
                      @foreach (range(date('Y') - 10, date('Y') + 10) as $year)
                        <option value="{{ $year }}" {{ $salary->year == $year ? 'selected' : '' }}>
                          {{ $year }}
                        </option>
                      @endforeach
                    </select>
                    <input type="hidden" name="year" value="{{ $salary->year }}">
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="basic_salary">Basic Salary</label>
                    <input type="number" class="form-control" id="basic_salary" name="basic_salary" value="{{ old('basic_salary', $salary->basic_salary) }}">
                    @error('basic_salary')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="loan">Loan</label>
                    <input type="number" class="form-control" id="loan" name="loan" value="{{ old('loan', $salary->loan) }}">
                    @error('loan')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
