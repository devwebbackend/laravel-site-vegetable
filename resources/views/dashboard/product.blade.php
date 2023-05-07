@extends('dashboard.layouts.add')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Products</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                 @foreach ($products as $product)
                   
                
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <img src="/images/{{$product->image}}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="User Image">
                    </td>
                    <td>{{$product->product}}</td>
                    <td> {{$product->category->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                      @if($product->status==1)
                      <a href="{{url('activeProduct/'.$product->id)}}" class="btn btn-success">activate</a>
                      @else
                       <a href="{{url('unactiveProduct/'.$product->id)}}"class="btn btn-warning">Unactivate</a>
                       @endif
                      <a href="{{url('products/'.$product->id).'/edit'}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                      <form action="{{url('products/'.$product->id)}}" method="post">
                     @csrf
                     @method('DELETE')
                   <button type="submit" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></button>
                        {{-- <a href="{{url('products/'.$product->id)}}" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a> --}}
                   </form>
                    </td>
                  </tr>
                   @endforeach
                  <tr>
                    <td>2</td>
                    <td>
                      <img src="dashboard/dist/img/user2-160x160.jpg" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="User Image">
                    </td>
                    <td>Win 95+</td>
                    <td>5</td>
                    <td>5</td>
                    <td>
                      <a href="#" class="btn btn-warning">Activate</a>
                      <a href="#" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                      <a href="#" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a>
                    </td>
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @endsection