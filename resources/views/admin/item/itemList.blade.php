@extends('admin.layouts.master')
@section('title', 'Item List Page')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                       <nav class="nav">
                            <a class="nav-link active" aria-current="page" href="#">
                                Item List
                            </a>
                            {{-- <a class="nav-link {{Request::is('item/create') ? 'active' : ''}}" href="#">Add Items</a> --}}
                        </nav>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if (session('message'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{session('message')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                         <a href="{{route('admin#createItem')}}" class="btn btn-primary float-right">&nbsp;<i class="fa-solid fa-plus"></i> &nbsp; Add Items</a>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
            @if (count($items) != 0)
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead class="bg-primary">
                    <tr>
                      <th>Action</th>
                      <th>No</th>
                      <th>Item &nbsp;<i class="fa-solid fa-chevron-down "></i></th>
                      <th>Category &nbsp;<i class="fa-solid fa-chevron-down"></i></th>
                      <th>Description &nbsp;<i class="fa-solid fa-chevron-down"></i></th>
                      <th>Price &nbsp;<i class="fa-solid fa-chevron-down"></i></th>
                      <th>Owner &nbsp;<i class="fa-solid fa-chevron-down"></i></th>
                      <th>Publish &nbsp;<i class="fa-solid fa-chevron-down"></i></th>
                    </tr>
                  </thead>
                  <tbody>

                   @php
                       $i=1;
                   @endphp
                        @foreach ($items as $item)
                             <tr>
                                <td>
                                    <a href="{{route('admin#editItem',$item->id)}}" class="btn btn-success me-2">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="{{route('admin#deleteItem',$item->id)}}" class="btn btn-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                                <td>{{ $i }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{!! $item->description !!}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->owner_name }}</td>
                                <td>
                                    <div class="form-check form-switch text-center">
                                        <input class="form-check-input" type="checkbox" name="status" role="switch" id="flexSwitchCheckChecked" @if($item->status) {{'checked'}} @endif >
                                    </div>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                  </tbody>
                </table>
                <div class="mt-3">
                    {{ $items->links() }}
                </div>
              </div>
              @else
                <h3 class="text-secondary">There is no items</h3>
              <!-- /.card-body -->
              @endif
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
