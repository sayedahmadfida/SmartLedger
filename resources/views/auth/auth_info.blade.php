@include('layouts.partials.css')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Your Info
        <small>Complete Your information here</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">First Name:</label>
                  <input type="text" name="first_name" placeholder="First Name" value="{{ auth()->user()->f_name }}" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Last Name:</label>
                  <input type="text" name="last_name" placeholder="Last Name" value="{{ auth()->user()->l_name }}" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Email:</label>
                  <input type="email" name="email" placeholder="Email Address" value="{{ auth()->user()->email }}" class="form-control">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Username:</label>
                  <input type="text" name="username" placeholder="Username" value="{{ auth()->user()->username }}" class="form-control">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="">Category:</label>
                  <select name="" id="" class="form-control">
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Password:</label>
                  <input type="password" name="new_password" placeholder="Password"  class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Confirm Password:</label>
                  <input type="password" name="retype_password" placeholder="Confirm Password" class="form-control">
                </div>
              </div>
              <div class="col-xs-1 pull-right">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->