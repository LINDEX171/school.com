@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Admin</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
           
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name </label>
                    <input type="text" class="form-control" value="{{ $getRecord->name}}" placeholder="Name" value="{{ old('name',$getRecord->email) }}" required name="name" >
                  </div>
                  <div class="form-group">
                    <label>Email </label>
                    <input type="email" class="form-control" value="{{ $getRecord->email}}" placeholder="Email" value="{{ old('email',$getRecord->email) }}" required name="email" >
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Password </label>
                    <input type="password" class="form-control" placeholder="Password"  name="password">
                    <p>do you want to change your password please please add new password</p>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
           

          </div>
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection
