@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                       <nav class="nav">
                            <a class="nav-link active" aria-current="page" href="#">
                                Categories
                            </a>
                            
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
                         <a href="{{route('admin#createCategory')}}" class="btn btn-primary float-right">&nbsp;<i class="fa-solid fa-plus"></i> &nbsp; Add Categories</a>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
            @if (count($categories) != 0)
                    <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead class="bg-primary">
                    <tr>
                      <th>Action</th>
                      <th>No</th>
                      <th>Publish &nbsp;<i class="fa-solid fa-chevron-down"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($categories as $category)

                         <tr>
                            <td>
                                <a href="{{route('admin#editCategory',$category->id)}}" class="btn btn-success me-2">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="{{route('admin#deleteCategory',$category->id)}}" class="btn btn-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                                <td>{{$i}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="publish" role="switch" id="flexSwitchCheckChecked"@if ($category->publish == 1) {{'checked'}} @endif >
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
                    {{ $categories->links() }}
                </div>
              </div>
              <!-- /.card-body -->
                @else
                    <h3 class="text-secondary">There is no categories</h3>
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
