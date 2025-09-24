@extends('layouts.app')
@section('title', 'Edit Presence')

@section('content')
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{ route('presences.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Edit Presence</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presence</a></div>
        <div class="breadcrumb-item">Edit Presence</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Presence Form</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('presences.update', $presence->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                  <div class="form-group col-12 col-md-12">
                    <label for="employee_id">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-control">
                      <option value="" disabled>Select Employee</option>
                      @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $presence->employee_id == $employee->id ? 'selected' : '' }}>
                          {{ $employee->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('employee_id')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group col-12 col-md-6">
                    <label for="check_in">Check In</label>
                    <input type="datetime-local" class="form-control" id="check_in" name="check_in"
                      value="{{ old('check_in', \Carbon\Carbon::parse($presence->check_in)->format('Y-m-d\TH:i')) }}">
                    @error('check_in')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group col-12 col-md-6">
                    <label for="check_out">Check Out</label>
                    <input type="datetime-local" class="form-control" id="check_out" name="check_out"
                      value="{{ old('check_out', \Carbon\Carbon::parse($presence->check_out)->format('Y-m-d\TH:i')) }}">
                    @error('check_out')
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