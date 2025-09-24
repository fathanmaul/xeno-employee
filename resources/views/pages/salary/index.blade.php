@extends('layouts.app')

@section('title', 'List of Employees Salary')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Salary</h1>
      <div class="section-header-button">
        <a href="{{ route('salary.create') }}" class="btn btn-primary">Add New</a>
      </div>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('salary.index') }}">Salary</a></div>
        <div class="breadcrumb-item">List Salary</div>
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
            <div class="card-header">
              <h4>All Salary</h4>
            </div>
            <div class="card-body">

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
                    @foreach ($salaries as $item)
                      <tr>
                        <td>
                          {{ \Carbon\Carbon::create()->month($item->month)->format('F') }} {{ $item->year }}
                        </td>
                        <td>{{ $item->employee->name }}
                          <div class="table-links">
                            <a href="{{ route('salary.edit', $item->id) }}">Edit</a>
                            <div class="bullet"></div>
                            <a href="#" class="text-danger btn-delete" data-id="{{ $item->id }}">Delete</a>
                          </div>
                        </td>
                        <td>{{ $item->basic_salary }}</td>
                        <td>{{ $item->bonus }}</td>
                        <td>{{ $item->bpjs }}</td>
                        <td>{{ $item->jp }}</td>
                        <td>{{ $item->loan }}</td>
                        <td>{{ $item->total_salary }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="float-right">
                <nav>
                  <ul class="pagination">
                    {{ $salaries->links() }}
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <form id="form-delete" action="#" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
  </form>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).on('click', '.btn-delete', function (e) {
      e.preventDefault();
      let id = $(this).data('id');
      console.log(id);
      Swal.fire({
        title: 'Are you sure?',
        text: "This data will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          let form = $('#form-delete');
          form.attr('action', '/salary/' + id);
          form.submit();
        }
      });
    });
  </script>
@endpush