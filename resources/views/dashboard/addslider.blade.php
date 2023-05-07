@extends('dashboard.layouts.add')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Add slider</h3>
              </div>
              <!-- /.card-header -->
              
@if(Session::has('succes'))
<div class='alert alert-success'>
<p>{{Session::get('succes')}}</p>
</div>
@endif
  
@if($errors->count()>0)

@foreach ($errors->all() as $error)
<div class='alert alert-danger'>
  <h6>{{$error}}</h6>
 </div>
  @endforeach

 
@endif
            
              <!-- form start -->
              <form  method="post" action="{{route('sliders.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slider description 1</label>
             <input type="text" name="description" class="form-control" id="exampleInputEmail1" placeholder="Enter slider description">
                       @error('description')
                        {{$message}}
             @enderror 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slider description 2</label>
                  
                    <input type="text" name="description2" class="form-control" id="exampleInputEmail1" placeholder="Enter slider description">
                   @error('description2')
                     {{$message}}
                  @enderror
                  </div>
                  <label for="exampleInputFile">Slider image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name='image' class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-warning">Submit</button> -->
                  <input type="submit" class="btn btn-warning" value="Save" >
                </div>
              </form>
            </div>
            <!-- /.card --> 
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection