 @extends('dashboard.layouts.add')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ordes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ordes</li>
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
                <h3 class="card-title">All Ordes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Date</th>
                     <th>Address</th>
                    <th>Client Names</th>
                    <th>Orders</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($orders as $order)
                    <tr>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->name}}</td>
                   {{--  <td>{{$order->cart}}</td> --}}
                     <td> @foreach ($order->cart->items as $item)
                      {{$item['product_name'].','}}
                    @endforeach
                      </td> 
                    <td>
                      <a href="#" class="btn btn-primary"><i class="nav-icon fas fa-eye"></i></a>
                    </td>
                  </tr>
                @endforeach
                 
                 
                  
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Date</th>
                    <th>Client Names</th>
                    <th>Orders</th>
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