@extends('Layout.v_template')

@section('title','Role - Permission')
@section('sub_title','Atur Role Akses')

@section('content')
    <a href="/role" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/role/permission/{{$role->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Role</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="role" id="" class="form-control @" value="{{ $role->name }}" aria-describedby="helpId">
                  <div class="text-danger">
                    @error('role')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="offset-md-1 col-sm-2">
                  <label for="">Permission</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-check">
                        <?php /*
                        @foreach ( $roleHasPerm as $dataRolePerm )
                            @if ($dataRolePerm->role_id == $role->id)
                                @foreach ($permission as $dataPerm)
                                        <input class="form-check-input" type="checkbox" name="pemissions[]" value="{{$dataPerm->name}}" @if ($dataRolePerm->permission_id == $dataPerm->id)
                                        checked @endif>
                                        <label class="form-check-label">{{$dataPerm->name}}</label>
                                        <br>
                                @endforeach
                            @endif
                        @endforeach
                        @foreach ( $roleHasPerm as $dataRolePerm)
                                @foreach ($permission as $dataPerm)
                                        <input class="form-check-input" type="checkbox" name="pemissions[]" value="{{$dataPerm->name}}" @if ($dataRolePerm->permission_id == $dataPerm->id)
                                        checked @endif>
                                        <label class="form-check-label">{{$dataPerm->name}}</label>
                                        <br>
                                @endforeach
                        @endforeach
                        */ ?>
                        <?php
                            $dataArray = explode(", ", $roleHasPerm);
                                        $a = 0;
                                        foreach ($permission as $dataPerm){
                                            if (in_array($dataPerm->id,$dataArray)) {
                                            ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="pemissions[]" value="{{$dataPerm->name}}"
                                                checked>
                                                <label class="form-check-label">{{$dataPerm->name}}</label>
                                            </div>
                                            <?php
                                            } else {
                                                ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="pemissions[]" value="{{$dataPerm->name}}" >
                                                <label class="form-check-label">{{$dataPerm->name}}</label>
                                            </div>
                                            <?php
                                            }
                                            $a++;
                                        }
                                        ?>
                    </div>
                    <div class="text-danger">
                        @error('level')
                        {{$message}}
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <button class="offset-md-3 btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>
@endsection
