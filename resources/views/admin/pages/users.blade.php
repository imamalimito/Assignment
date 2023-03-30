@extends('admin.layouts.default')
@section('abc')
<main id="main" class="main">

<div class="pagetitle">
  <h1>General Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">General</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Table with stripped rows</h5>

          <!-- Table with stripped rows -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Approved?</th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $u) 
              <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>
                <td>
                  @if($u->is_approved==0)
                  <a href="{{ url('admin/approve/'.$u->id) }}">Approve</a>
                  @else
                  Approved
                  @endif
                 
                </td>
              </tr>
            @endforeach 
              
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

      

    </div>
  </div>
</section>

</main><!-- End #main -->
@endsection
@section('scripts')
<script src="{{ asset('admin/assets/js/forms.js') }}"></script>
@endsection