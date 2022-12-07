@extends('Layout.v_template')

@section('title','User')
@section('sub_title','Ubah Data User')

@section('content')
    <a href="/users" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <div class="col-md-10">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Ubah Profile</a></li>
              <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Ganti Password</a></li >
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="profil">
                <form action="/users/update/{{$users->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="content">
                            <div class="row form-group" >
                                <div class="offset-md-1 col-sm-2">
                                  <label for="">Nama</label>
                                </div>
                                <div class="col-sm-6">
                                <select class="form-control select2 @error('id_profile') is-invalid @enderror" name="id_profile" id="" style="width: 100%;">
                                        <option value="">-- nama --</option>
                                        @foreach ($profile as $data)
                                        <option value='{{ $data->id }}' @if ($users->id_profile == $data->id ) selected @endif>{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                  <div class="text-danger">
                                    @error('id_profile')
                                      {{$message}}
                                    @enderror
                                </div>
                                </div>
                            </div>
                            <div class="row form-group" >
                                <div class="offset-md-1 col-sm-2">
                                  <label for="">Email</label>
                                </div>
                                <div class="col-sm-6">
                                  <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $users->email }}"aria-describedby="helpId">
                                  <div class="text-danger">
                                    @error('email')
                                      {{$message}}
                                    @enderror
                                </div>
                                </div>
                            </div>
                            <!--div class="row form-group" >
                                <div class="offset-md-1 col-sm-2">
                                  <label for="">Password</label>
                                </div>
                                <div class="col-sm-6">
                                  <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ $users->password }}"aria-describedby="helpId" autofocus>
                                  <div class="text-danger">
                                    @error('password')
                                      {{$message}}
                                    @enderror
                                </div>
                                </div>
                            </div>
                            <div class="row form-group" >
                                <div class="offset-md-1 col-sm-2">
                                  <label for="">Konfirmasi Password</label>
                                </div>
                                <div class="col-sm-6">
                                  <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ $users->password }}" placeholder="Password Confirmation" autofocus>
                                  <div class="text-danger">
                                    @error('password_confirmation')
                                      {{$message}}
                                    @enderror
                                </div>
                                <div class="text-danger">
                                    @error('password')
                                      {{$message}}
                                    @enderror
                                </div>
                                </div>
                            </div-->
                            <div class="row form-group">
                                <div class="offset-md-1 col-sm-2">
                                  <label for="">Akses</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-border @error('akses') is-invalid @enderror" name="akses" id="">
                                      <option value="" >-- Pilih  Akses --</option>
                                      <option value="Karyawan" @if ($users->akses == 'Karyawan') selected @endif>Karyawan</option>
                                      <option value="Kostumer" @if ($users->akses == 'Kostumer') selected @endif>Kostumer</option>
                                    </select>
                                  <div class="text-danger">
                                    @error('akses')
                                      {{$message}}
                                    @enderror
                                </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="offset-md-1 col-sm-2">
                                  <label for="">Role</label>
                                </div>
                                <div class="col-sm-6">
                                    <?php $arrayAkses = explode (",",$users->id_role);
                                    $a = 0;
                                        foreach ( $role as $role_list){
                                            if (in_array($role_list->id,$arrayAkses)) {
                                            ?>
                                            <div class="form-check">
                                                <input class="form-check-input @error('role') is-invalid @enderror" type="checkbox" name="role[]" value="{{$role_list->id}}" checked>
                                                <label class="form-check-label">{{$role_list->role}}</label>
                                            </div>
                                            <?php
                                            } else {
                                                ?>
                                            <div class="form-check">
                                                <input class="form-check-input @error('role') is-invalid @enderror" type="checkbox" name="role[]" value="{{$role_list->id}}" >
                                                <label class="form-check-label">{{$role_list->role}}</label>
                                            </div>
                                            <?php
                                            }
                                            $a++;
                                        }
                                        ?>
                                    <div class="text-danger">
                                    @error('role')
                                      {{$message}}
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <button class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </div>
                </form>
              </div>
              <div class="tab-pane" id="password">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                <form class="form-horizontal" method="POST" action="/users/changePassword/{{$users->id}}">
                @csrf
                    <div class="row form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="offset-md-1 col-sm-2 control-label">Current Password</label>

                        <div class="col-md-6">
                            <input id="current-password" type="password" class="form-control" name="current-password" required>

                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="offset-md-1 col-sm-2 control-label">New Password</label>

                        <div class="col-md-6">
                            <input id="new-password" type="password" class="form-control" name="new-password" required>

                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="text-danger">
                            @error('email')
                              {{$message}}
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="new-password-confirm" class="offset-md-1 col-sm-2 control-label">Confirm New Password</label>

                        <div class="col-md-6">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password-confirm" required>
                        </div>
                        <div class="text-danger">
                            @error('email')
                              {{$message}}
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-sm">Ubah Password</button>
                        </div>
                    </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>


@endsection
