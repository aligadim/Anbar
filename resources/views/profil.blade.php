@extends('layouts.app')


@section('title')
Profile
@endsection

@section('combat')
@if($errors->any())
  @foreach($errors ->all() as $mesaj)
   <br><div class="alert alert-primary alert-dismissible fade show" role="alert">
{{$mesaj}}<br>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  @endforeach
@endif   

@if(Session::has ('mesaj'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
{{Session::get ('mesaj')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


          <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Default form</h4>
                    <p class="card-description"> Basic form layout </p>
                    <form class="forms-sample" method="post" action="{{route('profil_update')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Ad</label>
                        <input type="text" class="form-control" id="exampleInputUsername1"  name="name" value="{{Auth::user()->name}}">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{Auth::user()->email}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Parol</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="parol" placeholder="Dəyişməyəcəksinizse boş buraxın:">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Cari parol</label>
                        <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Dəyişkləri yadda saxlamaq üçün cari parol daxil edin" name="password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Foto</label>
                        <img style="width:100px; height:100px;" src="{{url(Auth::user()->image)}}">
                        <input type="file" class="form-control" id="image" name="image">
                      </div>
                      
                      
                      <button type="submit" class="btn btn-primary mr-2">Yenile</button>
                      <a href="{{route('profil')}}"><button class="btn btn-dark">Imtina</button></a>
                    </form>
                  </div>
                </div>

                

 
                

                @endsection