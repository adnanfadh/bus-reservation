@extends('Layout.v_template')

@section('title','Users')
@section('sub_title','Detail Data User')

@section('content')
    <a href="/users" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>
    <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-circle"
                     src="{{ url('img/'.$users->foto) }}"
                     alt="User profile picture" style='width:50%'>
              </div>

              <h3 class="profile-username text-center">{{ $users->name }}</h3>

              <p class="text-muted text-center">{{ $users->akses }}</p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Profile</a></li>
                <!--li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li -->
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="profil">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>NIP</td>
                                <td>{{ $users->nip }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>{{ $users->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $users->email }}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                    <td>{{ $users->akses }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--div class="tab-pane" id="settings">
                  <form class="form-horizontal">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName2" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
                </div-->
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
