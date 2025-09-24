@extends('layouts.app')
@section('title', 'Edit Employee')

@section('content')
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{ route('employees.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Edit Employee</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></div>
        <div class="breadcrumb-item">Edit Employee</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Employee Form</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="form-group col-12 col-md-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                      value="{{ old('name', $employee->name) }}">
                    @error('name')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-4">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                      value="{{ old('email', $employee->email) }}">
                    @error('email')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-4">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                      value="{{ old('phone', $employee->phone) }}">
                    @error('phone')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-12 col-md-12">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                      value="{{ old('address', $employee->address) }}">
                    @error('address')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group col-12 col-md-12">
                    <div id="image-preview" style="margin-bottom:10px;">
                      @if($employee->user_picture)
                        <img id="preview-img" src="{{ asset($employee->user_picture) }}" alt="Preview"
                          style="max-height:200px; border:1px solid #ddd; padding:5px;" />
                      @else
                        <img id="preview-img" src="" alt="Preview"
                          style="max-height:200px; display:none; border:1px solid #ddd; padding:5px;" />
                      @endif
                    </div>
                    <label for="image-upload" id="image-label">Picture</label>
                    <input type="file" name="image" id="image-upload" />
                    @error('image')
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

@push('scripts')
  <script>
    $(document).ready(function () {
      $("#image-upload").change(function () {
        let reader = new FileReader();
        reader.onload = function (e) {
          $("#preview-img")
            .attr("src", e.target.result)
            .css("max-height", "200px")
            .show();
        }
        if (this.files[0]) {
          reader.readAsDataURL(this.files[0]);
        }
      });
    });
  </script>
@endpush