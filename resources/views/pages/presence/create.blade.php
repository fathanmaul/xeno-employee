@extends('layouts.app')
@section('title', 'Create New Presence')

@section('content')
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{ route('employees.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Create New Presence</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Presence</a></div>
        <div class="breadcrumb-item">Create Presence</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>New Employee Form</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('presences.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="check_in">Check In</label>
                    <input type="datetime-local" class="form-control" id="check_in" name="check_in" value="{{ old('check_in') }}">
                    @error('check_in')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="check_out">Check Out</label>
                    <input type="datetime-local" class="form-control" id="check_out" name="check_out" value="{{ old('check_out') }}">
                    @error('check_out')
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