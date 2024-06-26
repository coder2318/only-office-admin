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
    <h5 class="card-header">Document List</h5>
    <!-- Bootstrap modals -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="row gy-3">
          <!-- Vertically Centered Modal -->
          <div class="col-lg-4 col-md-6">
            <div class="mt-3">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                Create Document
              </button>

              <!-- Modal -->
              <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="modalCenterTitle">Document Name</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('document.create') }}" method="POST">
                      @csrf
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter File Name"
                                     name="filename" required>
                              <label for="nameWithTitle">Name</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Document</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <!--/ Bootstrap modals -->
    <div class="table-responsive text-nowrap">
      <table class="table table-dark">
        <thead>
        <tr>
          <th>ID</th>
          <th>Document Name</th>
          <th>Client</th>
          <th>Document History</th>
          <th>Updated At</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($documents as $item)
          <tr>
            <td>{{$item->id}}</td>
            <td><i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i><span
                class="fw-medium">{{$item->name}}</span></td>
            <td>{{$item->path}}</td>
            <td>
              <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                    class="avatar avatar-xs pull-up" title="History">
                  <a href="{{route('document-history.index', ['document_id' => $item->id])}}"><i class='mdi mdi-cog-outline text-warning mdi-24px me-1'></i>show history</a>

                </li>
              </ul>
            </td>
            <td><span class="badge rounded-pill bg-label-primary me-1">{{$item->updated_at}}</span></td>
            <td>
              <a href="{{ route('document.show', ['id' => $item->id]) }}">
                <button class="dropdown-item" type="submit">
                  <i class='mdi mdi-pencil-outline me-1'></i>
                  Edit
                </button>
              </a>

              <form action="{{ route('document.delete', ['id' => $item->id]) }}" method="POST">
                @csrf
                @method("DELETE")
                <button class="dropdown-item" type="submit">
                  <i class='mdi mdi-trash-can-outline me-1'></i>
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @endforeach

        </tbody>
      </table>
    </div>
  </div>
  <!--/ Bootstrap Dark Table -->


  <hr class="my-5">

@endsection
