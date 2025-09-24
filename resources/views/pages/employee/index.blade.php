@extends('layouts.app')

@section('title', 'List of Employees')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Employees</h1>
      <div class="section-header-button">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Add New</a>
      </div>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></div>
        <div class="breadcrumb-item">List Employees</div>
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
              <h4>All Employee</h4>
            </div>
            <div class="card-body">
              <div class="float-right">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="clearfix mb-3"></div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 50px;"></th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Phone</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($employee as $item)
                      <tr>
                        <td>
                          <a href="#">
                            <img alt="image" src="{{ $item->user_picture }}" class="rounded-circle" width="35"
                              data-toggle="title" title="">
                          </a>
                        </td>
                        <td>{{ $item->name }}
                          <div class="table-links">
                            <a href="{{ route('employees.edit', $item->id) }}">Edit</a>
                            <div class="bullet"></div>
                            <a href="#" class="text-danger btn-delete" data-id="{{ $item->id }}">Delete</a>
                          </div>
                        </td>
                        <td>
                          <a href="#">{{ $item->email }}</a>
                        </td>
                        <td>
                          {{ strlen($item->address) > 20 ? substr($item->address, 0, 20) . '.' : $item->address }}
                        </td>
                        <td>{{$item->phone}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="float-right">
                <nav>
                  <ul class="pagination">
                    {{ $employee->links() }}
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <form id="form-delete" action="#" method="POST"
    style="display: none;">
    @csrf
    @method('DELETE')
  </form>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).on('click', '.btn-delete', function (e) {
      e.preventDefault();
      console.log('clicked');
      let id = $(this).data('id');
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
          form.attr('action', '/employees/' + id);
          form.submit();
        }
      });
    });
  </script>
@endpush