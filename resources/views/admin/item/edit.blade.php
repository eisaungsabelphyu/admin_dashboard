@extends('admin.layouts.master')
@section('title', 'Item Edit Page')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <nav class="nav">
                            <a class="nav-link" aria-current="page" href="{{route('admin#itemList')}}">
                                Item List
                                &emsp;<i class="fa-solid fa-chevron-right"></i>
                            </a>
                            <a class="nav-link active" aria-current="page" href="#">
                                Edit Items
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
                        <h3 class="card-title fw-bold">Edit Items</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <form id="myForm" action="{{route('admin#updateItem',$item->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="fw-bold">Item Information</h5>
                                        <div class="form-group">
                                            <label for="name">Item Name<span class="required"
                                                    style="color:red;">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name"
                                                placeholder="Input Name" value="{{old('name',$item->name)}}" required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Select Category<span class="required" style="color:red;">*</span></label>
                                            <select class="form-select @error('category') is-invalid @enderror" name="category" style="width: 100%;" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{$c->id}}" @if($c->id == $item->category_id) selected  @endif>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="price">Price<span class="required"
                                                    style="color:red;">*</span></label>
                                            <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{old('price',$item->price)}}" name="price"
                                                placeholder="Enter Price" required>
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description<span class="required"
                                                    style="color:red;">*</span></label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="text-textarea" name="description" placeholder="Enter Description" rows="5">{{old('description',$item->description)}}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Select Item Condition</label>
                                            <select class="form-select" name="condition" style="width: 100%;">
                                                <option value="" >Select Item Condition</option>
                                                <option value="New" @if($item->condition == 'New') selected  @endif>New</option>
                                                <option value="Used" @if($item->condition == 'Used') selected  @endif>Used</option>
                                                <option value="Good second hand" @if($item->condition == 'Good second hand') selected  @endif>Good Second Hand</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label>Select Item Type</label>
                                            <select class="form-select" name="type" style="width: 100%;">
                                                <option value="">Select Item Type</option>
                                                <option value="Sell" @if($item->type == 'Sell') selected  @endif>Sell</option>
                                                <option value="Buy" @if($item->type == 'Buy') selected  @endif>Buy</option>
                                                <option value="for exchange" @if($item->type == 'for exchange') selected  @endif>For Exchange</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status"
                                                 id="defaultCheck1" @if ($item->status) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Publish
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Item Photo<span class="required"
                                                    style="color:red;">*</span></label>
                                            <p class="text-muted">Recommemdes Size 400 &times; 200</p>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                                required>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <h5 class="fw-bold">Owner Information</h5>
                                        <div class="form-group">
                                            <label for="ownerName">Owner Name<span class="required"
                                                    style="color:red;">*</span></label>
                                            <input type="text" class="form-control @error('owner_name') is-invalid @enderror" value="{{old('ownerName',$item->owner_name)}}" name="ownerName"
                                                placeholder="Input Owner Name" required>
                                            @error('ownerName')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Contact Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+95 &nbsp;<i
                                                            class="fa-solid fa-chevron-down "></i></span>
                                                </div>
                                                <input type="number" name="phone" value="{{old('phone',$item->phone)}}" class="form-control @error('phone') is-invalid @enderror"
                                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address" rows="3">{{old('address',$item->address)}}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input class="map-picker mb-2"  type="text" name="latLng" value="{{ $item->lat_long }}" />
                                            <div id="mapContainer" style="height:400px; position:relative; overflow:hidden;">
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-outline-primary" onclick="clearForm()">Cancel</button>
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
@section('scripts')
<script src="{{asset('js/clearform.js')}}"></script>
    <script>

            //ckeditor
            ClassicEditor
            .create( document.querySelector( '#text-textarea' ) )
            .catch( error => {
                console.error( error );
            } );
            //map marker
            var map = L.map('mapContainer', {
                         scrollWheelZoom: false
                        }).setView([18.208, 96.482], 6);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            var marker = null;
            map.on('click', function (e) {
                if(marker){
                     map.removeLayer(marker);
                     $('input.map-picker').val('');
                }
                marker = L.marker(e.latlng).addTo(map);
                var inputMarker = e.latlng.lat + ',' + e.latlng.lng;
                $('input.map-picker').val(inputMarker);
                marker.bindPopup("Marker at " + e.latlng.toString()).openPopup();
            });




    </script>

@endsection
