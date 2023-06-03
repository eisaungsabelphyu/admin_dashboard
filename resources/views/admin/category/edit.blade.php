@extends('admin.layouts.master')
@section('title', 'Category Edit Page')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <nav class="nav">
                            <a class="nav-link" aria-current="page" href="{{route('admin#categoryList')}}">
                                Categories
                                &emsp;<i class="fa-solid fa-chevron-right"></i>
                            </a>
                            <a class="nav-link active" aria-current="page" href="#">
                                Edit Categories
                            </a>
                        </nav>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header bg-primary-subtle ">
                        <h3 class="card-title fw-bold">Edit Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <form id="myForm" action="{{route('admin#updateCategory',$category->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="name">Category<span class="required"
                                                    style="color:red;">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name',$category->name)}}"
                                                placeholder="Input Name" required>
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Category Photo<span class="required"
                                                    style="color:red;">*</span></label>
                                            <p class="text-muted">Recommemdes Size 400 &times; 200</p>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                                required>
                                            <img src="{{asset('storage/'.$image)}}" class="img-thumbnail" style="width:300px; height:300px;">
                                                @error('image')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status"
                                                 id="defaultCheck1" @if($category->publish == 1) {{'checked'}} @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Publish
                                                </label>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <a href="{{route('admin#categoryList')}}" class="btn btn-outline-primary" >Cancel</a>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.col -->
                            </form>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

