@extends('layouts.app')
@section('title', 'Create New Salary')

@section('content')
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{ route('salary.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Create New Salary</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('salary.index') }}">Salary</a></div>
        <div class="breadcrumb-item">Create Salary</div>
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
              <h4>New Salary Form</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('salary.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="form-group col-12 col-md-12">
                    <label for="name">Employee</label>
                    <select name="employee_id" id="" class="form-control">
                      <option value="" disabled selected>Select Employee</option>
                      @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                      @endforeach
                    </select>
                    @error('employee_id')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="month">Month</label>
                    <select name="month" id="month" class="form-control">
                      <option value="" disabled selected>Select Month</option>
                      @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                      @endforeach
                    </select>
                    @error('month')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="year">Year</label>
                    <select name="year" id="year" class="form-control">
                      <option value="" disabled selected>Select Year</option>
                      @foreach (range(date('Y') - 10, date('Y') + 10) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                      @endforeach
                    </select>
                    @error('year')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </select>
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="basic_salary">Basic Salary</label>
                    <input type="number" class="form-control" id="basic_salary" name="basic_salary">
                    @error('basic_salary')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="loan">Loan</label>
                    <input type="number" class="form-control" id="loan" name="loan">
                    @error('loan')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
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