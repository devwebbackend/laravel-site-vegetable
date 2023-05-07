@extends('dashboard.layouts.add')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add category</small></h3>
              </div>
            @if(Session::has('succes')) 
           <div class="alert alert-success">
             {{Session::get('succes')}}
           </div>
            @endif 
        @if(count($errors)>0)
               <div class="alert alert-danger">
               <ul>
                 @foreach ($errors->all()  as $error )
                   <li>{{$error}}</li>
                 @endforeach
              </ul> 
               </div>   
            @endif  
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('categories.store')}}">
                @csrf
              
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category name</label>
                
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter category">
                    @error('name')
                   
                 @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                  <input type="submit" class="btn btn-primary" value="Save" >
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