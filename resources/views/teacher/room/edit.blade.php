@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Room</div>


                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.room.update',['id'=>$room->id]) }}" enctype="multipart/form-data">
                        @csrf

                        @method('put')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Room Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $room->name }}" >

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">Room Type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="type" id="type-selector">
                                    @if($room->type == 'free')
                                    <option selected value="free">Free</option>
                                    <option value="limit">Limit</option>
                                    @endif
                                    @if($room->type == 'limit')
                                    <option value="free">Free</option>
                                    <option selected value="limit">Limit</option>
                                    @endif

                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="password-field" style="display: {{ $room->type == 'free' ? 'none' : '' }}">
                            <label for="" class="col-md-4 col-form-label text-md-right">Room Password</label>

                            <div class="col-md-6">
                                <input id="password" type="integer" class="form-control @error('name') is-invalid @enderror" name="password" value="{{ $room->password }}" >

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fileupload"  class="col-md-4 col-form-label text-md-right">Room Avatar</label>



                            <div class="col-md-6">

                                <div style="display:flex">
                                    <img id="thumbnil" src="{{ URL::to('storage/'.$room->avatar) }}" height="100%" width="100%" alt="image"/>
                                </div>
                                <button class="addfiles btn-success" style="border: 1px;
                                margin-left: 40px" >Add Your Files</button>
                                <button class="addfiles btn-warning" style="border: 1px;
                                margin-left: 30px" >Add Your Files</button>
                                <input id="fileupload" type="file" name="avatar" style='display: none;'
                                accept="image/*"  onchange="showMyImage(this)"
                                class="form-control @error('avatar') is-invalid @enderror">



                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit Room
                                </button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>

    $(document).ready(function(){
        $('#type-selector').on('change', function() {
          if ( this.value == 'limit')
          {
            $("#password-field").show();
        }
        else
        {
            $("#password-field").hide();
        }
    });


    });



    $('.addfiles').on('click', function() { $('#fileupload').click();return false;});

    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {

                continue;
            }
            var img=document.getElementById("thumbnil");
            img.file = file;
            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);

        }
    }



</script>
@endsection
