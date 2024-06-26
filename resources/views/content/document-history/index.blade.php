@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('page-script')
  <script src="{{asset('assets/js/ui-modals.js')}}"></script>
@endsection

@section('content')

  @error('error')
  <div class="alert alert-danger">{{$errors}}</div>
  @enderror
  <!-- Bootstrap Dark Table -->
  <div class="card">
    <h5 class="card-header">Document History List</h5>

    <div class="table-responsive text-nowrap">
      <table class="table table-dark">
        <thead>
        <tr>
          <th>Document Name</th>
          <th>User ID</th>
          <th>User Name</th>
          <th>Actions</th>
          <th>Action Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($history as $item)
          <tr>
            <td><i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i><span
                class="fw-medium">{{$item->document->name}}</span></td>
            <td>{{$item->user->id}}</td>
            <td>
              <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                    class="avatar avatar-xs pull-up" title="{{$item->user->name}}">
                  <div>
                    <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle">
                    <span>{{$item->user->name}}</span>
                  </div>
                </li>
              </ul>
            </td>
            <td><span class="badge rounded-pill bg-label-primary me-1">{{$item->action}}</span></td>
            <td><span class="badge rounded-pill bg-label-info me-1">{{$item->updated_at}}</span></td>

          </tr>
        @endforeach

        </tbody>
      </table>
    </div>
  </div>
  <!--/ Bootstrap Dark Table -->


  <hr class="my-5">

@endsection
