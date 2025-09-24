@extends('layouts.app')

@section('title', 'List of Monthly Salary')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Monthly Salary</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('salary.index') }}">Monthly Salary</a></div>
        <div class="breadcrumb-item">List Monthly Salary</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
          <div class="card">
            <div class="card-body">
              <div class="float-left w-100">
                <form>
                  <div class="row">
                    <div class="col-12 col-md-3 mb-3">
                      <select name="month" id="month" class="form-control">
                        <option value="">Select Month</option>
                        @foreach (range(1, 12) as $item)
                          <option value="{{ $item }}" {{ $item == $month ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($item)->format('F') }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                      <select name="year" id="year" class="form-control">
                        <option value="">Select Year</option>
                        @foreach (range(date('Y'), 2000) as $item)
                          <option value="{{ $item }}" {{ $item == $year ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                      <button class="btn btn-primary">Calculate</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="clearfix mb-3"></div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Name</th>
                      <th>Basic Salary</th>
                      <th>Bonus</th>
                      <th>BPJS</th>
                      <th>JP</th>
                      <th>Loan</th>
                      <th>Total Salary</th>
                    </tr>
                  </thead>
                  <tbody>
                    @isset($salaries)
                      @foreach ($salaries as $item)
                        <tr>
                          <td>
                            {{ \Carbon\Carbon::create()->month($item->month)->format('F') }} {{ $item->year }}
                          </td>
                          <td>{{ $item->employee->name }}</td>
                          <td>{{ $item->basic_salary }}</td>
                          <td>{{ $item->bonus }}</td>
                          <td>{{ $item->bpjs }}</td>
                          <td>{{ $item->jp }}</td>
                          <td>{{ $item->loan }}</td>
                          <td>{{ $item->total_salary }}</td>
                        </tr>
                      @endforeach
                      <tr>
                        <td colspan="7">Total</td>
                        <td>{{$total_salaries}}</td>
                      </tr>
                    @endisset
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection