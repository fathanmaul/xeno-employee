@extends('layouts.app')

@section('title', 'List of Employees Presence')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Presences</h1>
      <div class="section-header-button">
        <a href="{{ route('presences.create') }}" class="btn btn-primary">Add New</a>
      </div>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presences</a></div>
        <div class="breadcrumb-item">List Presences</div>
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
              <h4>All Presences</h4>
            </div>
            <div class="card-body">

              <div class="clearfix mb-3"></div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Check In</th>
                      <th>Check Out</th>
                      <th>Late in</th>
                      <th>Early Out</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($presences as $item)
                      <tr>
                        <td>{{ $item->employee->name }}
                          <div class="table-links">
                            <a href="{{ route('presences.edit', $item->id) }}">Edit</a>
                            <div class="bullet"></div>
                            <a href="#" class="text-danger btn-delete" data-id="{{ $item->id }}">Delete</a>
                          </div>
                        </td>

                        </td>
                        <td>
                          {{ $item->check_in }}
                        </td>
                        <td>
                          {{ $item->check_out }}
                        </td>
                        <td>{{ $item->late_in }}</td>
                        <td>{{ $item->early_out }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="float-right">
                <nav>
                  <ul class="pagination">
                    {{ $presences->links() }}
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
          form.attr('action', '/presences/' + id);
          form.submit();
        }
      });
    });
  </script>
@endpush