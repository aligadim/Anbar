@extends('layouts.app')

@section('axtar')
{{route('product')}}
@endsection

@section('title')
Product
@endsection

@section('combat')
<h2> Products </h2>
@if(Session::has ('mesaj'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
{{Session::get('mesaj')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if($errors->any())
    @foreach($errors->all() as $mesaj)
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
{{$mesaj}}<br>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                    
    @endforeach
@endif

@isset($sil_id)
<div class="card-body">
                    <blockquote class="blockquote blockquote-primary">
                      <p>Siz məlumatları silməyə əminsinizmi?</p>
                      <footer class="blockquote-footer"><a href="{{route('pr_del',$sil_id)}}"><button type="button" class="btn btn-outline-warning btn-fw"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
</svg></button></a> <cite title="Source Title"><a href="{{route('product')}}"><button type="button" class="btn btn-outline-danger btn-fw"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.854 7.146 8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 1 1 .708-.708z"/>
</svg></button></a> 
</cite></footer>
                    </blockquote>
                  </div>



@endisset
@isset($edit_data)
<div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Məsul daxil edin</h4>
                    
                    <form class="forms-sample" method="post" action="{{route('pr_update',$edit_data)}}" enctype="multipart/form-data">
                      @csrf
                      <select class="form-control" name="tehcizat_id">
                        <option value="">Tehcizat daxil edin</option>
                         @foreach($tehcizats as $tehcizat)
                         @if($tehcizat->id == $edit_data->tehcizat_id)
                         <option selected value="{{$tehcizat->id}}">{{$tehcizat->shirket}}</option>
                         @else
                         <option value="{{$tehcizat->id}}">{{$tehcizat->shirket}}</option>
                         @endif
                         @endforeach
</select><br>

                      <select class="form-control" name="brand_id">
                                <option value="">Brend daxil edin</option>
                                @foreach($brends as $brend)
                                @if($brend->id == $edit_data->brand_id)
                                <option selected value="{{$brend->id}}">{{$brend->ad}}</option>
                                @else
                                <option  value="{{$brend->id}}">{{$brend->ad}}</option>
                                @endif
                                @endforeach
                            
                              </select><br>

                      <div class="form-group">
                        <label for="exampleInputUsername1">Ad:</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="ad" placeholder="Adiniz..." value="{{$edit_data->ad}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Alis:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="alis" placeholder="Alis..." value="{{$edit_data->alis}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Satis:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="satis" placeholder="Satis..." value="{{$edit_data->satis}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Miqdar:</label>
                        <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="miqdar" placeholder="Miqdar..." value="{{$edit_data->miqdar}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Foto:</label><br>
                         <img style="width:70px; height:60px;" src="{{url($edit_data->image)}}">
                        <input type="file" class="form-control" id="image" name="image" >
                      </div>
                      <button type="submit" class="btn btn-primary mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
</svg> </button>
                      <a href="{{route('product')}}"><button class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.854 7.146 8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 1 1 .708-.708z"/>
</svg></button></a>
                    </form>
                  </div>
                </div>
@endisset


@empty($edit_data)

<div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Məhsul daxil edin</h4>
                    
                    <form class="forms-sample" method="post" action="{{route('productForm')}}" enctype="multipart/form-data">
                      @csrf
                      <select class="form-control" name="tehcizat_id">
                          <option value="">Tehcizati daxil edin</option>
                          @foreach($tehcizats as $tehcizat)
                          <option value="{{$tehcizat->id}}">{{$tehcizat->shirket}}</option>
                          @endforeach
                        </select><br>




                      <select class="form-control" name="brand_id">
                                <option value="">Brend daxil edin</option>
                                @foreach($brends as $brend)
                                <option value="{{$brend->id}}">{{$brend->ad}}</option>
                                @endforeach
                            
                              </select><br>

                      <div class="form-group">
                        <label for="exampleInputUsername1">Ad:</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="ad" placeholder="Adiniz...">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Alış:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="alis" placeholder="Alis...">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Satış:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="satis" placeholder="Satis...">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Miqdar:</label>
                        <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="miqdar" placeholder="Miqdar...">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Foto:</label>
                        <input type="file" class="form-control" id="exampleInputConfirmPassword1" name="image" >
                      </div>
                      <button type="submit" class="btn btn-primary mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
  <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z"/>
</svg></button>
                     
                    </form>
                  </div>
                </div>









@endempty

<br>
<br><br>
<p class="text-primary">Bazada {{$say}} Mehsul var</p>
<br><br>


<div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Məhsul siyahısı</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <form method="get" action="{{route('product')}}">
                            
                            <th> # </th>
                            <th> Foto </th>
                            <th>Shirket
                              @if(request()->get('f1')=='ASC')
                              <input type="submit" name="f1" value="DESC">
                              @elseif(request()->get('f1')=='DESC')
                              <input type="submit" name="f1" value="ASC">
                              @else
                              <input type="submit" name="f1" value="ASC">
                              @endif
                            </th>
                            <th> Brend
                            @if(request()->get('f2')=='ASC')
                              <input type="submit" name="f2" value="DESC">
                              @elseif(request()->get('f2')=='DESC')
                              <input type="submit" name="f2" value="ASC">
                              @else
                              <input type="submit" name="f2" value="ASC">
                              @endif
                            </th>
                            <th> Mehsul
                            @if(request()->get('f3')=='ASC')
                              <input type="submit" name="f3" value="DESC">
                              @elseif(request()->get('f3')=='DESC')
                              <input type="submit" name="f3" value="ASC">
                              @else
                              <input type="submit" name="f3" value="ASC">
                              @endif
                            </th>
                            <th> Alis
                            @if(request()->get('f4')=='ASC')
                              <input type="submit" name="f4" value="DESC">
                              @elseif(request()->get('f4')=='DESC')
                              <input type="submit" name="f4" value="ASC">
                              @else
                              <input type="submit" name="f4" value="ASC">
                              @endif
                            </th>
                            <th> Satis
                            @if(request()->get('f5')=='ASC')
                              <input type="submit" name="f5" value="DESC">
                              @elseif(request()->get('f5')=='DESC')
                              <input type="submit" name="f5" value="ASC">
                              @else
                              <input type="submit" name="f5" value="ASC">
                              @endif
                            </th>
                            <th> Miqdar
                            @if(request()->get('f6')=='ASC')
                              <input type="submit" name="f6" value="DESC">
                              @elseif(request()->get('f6')=='DESC')
                              <input type="submit" name="f6" value="ASC">
                              @else
                              <input type="submit" name="f6" value="ASC">
                              @endif
                            </th>
                            <th></th>
                          </form>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $i=>$info)
                        <tr>
                            <td>{{$i+=1}}</td>
                            <td><img style="width:70px; height:60px;" src="{{url($info->foto)}}"></td>
                            <td>{{$info->shirket}}</td>
                            <td>{{$info->brend}}</td>
                            <td>{{$info->mehsul}}</td>
                            <td>{{$info->alis}}</td>
                            <td>{{$info->satis}}</td>
                            <td>{{$info->miqdar}}</td>
                            <td>
                            <a href="{{route('pr_sil',$info->pid)}}"><button type="button" class="btn btn-outline-danger btn-fw"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></button></a>
                            <a href="{{route('pr_edit',$info->pid)}}"><button type="button" class="btn btn-outline-warning btn-fw"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button></a>
                            
                     
                            </td>
                            
                          </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>





    

@endsection