@extends('layouts.app')


@section('title')
Tapşırıq
@endsection

@section('axtar')
{{route('komendant')}}
@endsection

@section('combat')


@if(Session::has('mesaj'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
{{Session::get ('mesaj')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if($errors->any())
@foreach($errors->all() as $mesaj)
<br><div class="alert alert-primary alert-dismissible fade show" role="alert">
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
                      <p>Siz məlumatları silmeyə əminsinizmi?</p>
                      <footer class="blockquote-footer"><a href="{{route('k_del',$sil_id)}}"><button type="button" class="btn btn-outline-primary btn-fw btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
</svg></button></a> <cite title="Source Title"><a href="{{route('komendant')}}"><button type="button" class="btn btn-outline-danger btn-fw btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.854 7.146 8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 1 1 .708-.708z"/>
</svg></button></a> 
</cite></footer>
                    </blockquote>
                  </div>

@endisset

@isset($edit_data)
<div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tapsiriqi yenileyin</h4>
                    
                    <form class="forms-sample" method="post" action="{{route('komendant_update',$edit_data)}}" enctype="multipart/form-data" >
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Foto:</label>
                        <img style="width:60px; height:70px;" src="{{url($edit_data->image)}}">
                        <input type="file" class="form-control" id="image" name="image">
                      </div>

                      <select class="form-control" name="staff_data">
                                <option value="">Isci adini daxil edin</option>
                                @foreach($staffs as $staff)
                                @if($staff->id == $edit_data->staff_data)
                                <option selected value="{{$staff->id}}">{{$staff->ad}} {{$staff->soyad}}</option>
                                @else
                                <option  value="{{$staff->id}}">{{$staff->ad}} {{$staff->soyad}}</option>
                                @endif
                               
                                
                                @endforeach
                            
                              </select><br>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Tapsiriq:</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="tapsiriq"  value="{{$edit_data->tapsiriq}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tarix:</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="tarix"  value="{{$edit_data->tarix}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Vaxt:</label>
                        <input type="time" class="form-control" id="exampleInputPassword1" name="vaxt"  value="{{$edit_data->vaxt}}">
                      </div>
                      
                     
                      <button type="submit" class="btn btn-primary mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
</svg></button>
                      <a href = "{{route('komendant')}}"><button type="button" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.854 7.146 8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 1 1 .708-.708z"/>
</svg></button></a>
                    </form>
                  </div>
                </div>

@endisset

@empty($edit_data)
<div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tapsiriq daxil edin</h4>
                    
                    <form class="forms-sample" method="post" action="{{route('komendantForm')}}" enctype="multipart/form-data" >
                      @csrf

                      <select class="form-control" name="staff_data">
                                <option value="">Isci daxil edin</option>
                                @foreach($staffs as $staff)
                              
                                <option value="{{$staff->id}}">{{$staff->ad}} {{$staff->soyad}}</option>
                               
                                
                                @endforeach
                            
                              </select><br>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Tapsiriq:</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="tapsiriq" placeholder="Tapsiriq...">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tarix:</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="tarix" placeholder="Tarix...">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Vaxt:</label>
                        <input type="time" class="form-control" id="exampleInputPassword1" name="vaxt" placeholder="Vaxt">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Foto:</label>
                        <input type="file" class="form-control" id="image" name="image" >
                      </div>
                      
                     
                      <button type="submit" class="btn btn-primary mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
  <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z"/>
</svg></button>
                     
                    </form>
                  </div>
                </div>
@endempty


<br>
<p class="text-primary">
  <form method="post" action="{{route('komendant_say')}}">
  @csrf
  <button  class="btn btn-link" name="btn" value="toplam">Toplam: {{$toplam}} </button>
 <button  class="btn btn-link" name="btn" value="aktiv"> Aktiv: {{$active}}</button> 
 <button  class="btn btn-link" name="btn" value="tamam">Tamam: {{$tamam}}</button>
</form></p>



<div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tapsiriq siyahısı</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <form method="get" action="{{route('komendant')}}">
                              @csrf
                            <th> # </th>
                            <th> Foto </th>
                            <th> Ad 
                              @if(request()->get('f1')=='DESC')
                              <input type="submit" name="f1" value="ASC">
                              @elseif(request()->get('f1')=='ASC')
                              <input type="submit" name="f1" value="DESC">
                              @else
                              <input type="submit" name="f1" value="ASC">
                              @endif

                            </th>
                            <th> Tapsiriq 
                              @if(request()->get('f2')=='DESC')
                              <input type="submit" name="f2" value="ASC">
                              @elseif(request()->get('f2')=='ASC')
                              <input type="submit" name="f2" value="DESC">
                              @else
                              <input type="submit" name="f2" value="ASC">
                              @endif
                            </th>
                            <th> Tarix 
                              @if(request()->get('f3')=='DESC')
                              <input type="submit" name="f3" value="ASC">
                              @elseif(request()->get('f3')=='ASC')
                              <input type="submit" name="f3" value="DESC">
                              @else
                              <input type="submit" name="f3" value="ASC">
                              @endif
                            </th>
                            <th> Saat
                              @if(request()->get('f4')=='DESC')
                              <input type="submit" name="f4" value="ASC">
                              @elseif(request()->get('f4')=='ASC')
                              <input type="submit" name="f4" value="DESC">
                              @else
                              <input type="submit" name="f4" value="ASC">
                              @endif </th>
                            <th> Qaliq </th>
                            <th></th>
                          </form>
                          </tr>
                        </thead>
                        <tbody>

@if($step=='aktiv')
                        
                        @foreach($data as $i=>$info)

                        @php
                          //2023-07-25 23:03:00
                          $t1 = $info->tarix.' '.$info->vaxt;
                          $t1 = strtotime($t1);

                          $t2 = time();

                          $san = $t1 - $t2;
                          $deq = round($san/60);
                          $saat = round($deq/60);
                          $gun = round($saat/24);

                          if($deq<60 && $san>0)
                          {$qaliq = $deq.' deqiqe';}
                          elseif($deq>60 && $saat<24)
                          {$qaliq = $saat.' saat';}
                          elseif($saat>23)
                          {$qaliq = $gun.' gun';}
                          else
                          {$qaliq = 'Tamam';}

                          $aktiv = 0;
                          $tamam = 0;




                          if($san<1)
                          {$tamam++;}

                          $aktiv = $toplam - $tamam;

                        @endphp







                        @if($qaliq!='Tamam')


                        <tr>
                          <td>{{$i+=1}}</td>
                          <td><img style="width:80px; height:70px;" src="{{url($info->image)}}"></td>
                          <td>{{$info->ad}} {{$info->soyad}} </td>
                          <td>{{$info->tapsiriq}} </td>
                          <td>{{$info->tarix}}</td>
                          <td>{{$info->vaxt}}</td>
                          <td>{{$qaliq}}</td>
                          
                        <td>   

                        <a href="{{route('k_sil',$info->kid)}}"><button type="button" class="btn btn-outline-danger btn-fw btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></button></a>
                        <a href="{{route('k_edit',$info->kid)}}"><button type="button" class="btn btn-outline-warning btn-fw btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button></a>


                        </td>
                          
                        
                        </tr>

                       
                        @endif

                        @endforeach
                  




@elseif($step=='tamam')

                        @foreach($data as $i=>$info)

                          @php
                            //2023-07-25 23:03:00
                            $t1 = $info->tarix.' '.$info->vaxt;
                            $t1 = strtotime($t1);

                            $t2 = time();

                            $san = $t1 - $t2;
                            $deq = round($san/60);
                            $saat = round($deq/60);
                            $gun = round($saat/24);

                            if($deq<60 && $san>0)
                            {$qaliq = $deq.' deqiqe';}
                            elseif($deq>60 && $saat<24)
                            {$qaliq = $saat.' saat';}
                            elseif($saat>23)
                            {$qaliq = $gun.' gun';}
                            else
                            {$qaliq = 'Tamam';}

                            $aktiv = 0;
                            $tamam = 0;


                          

                            if($san<1)
                            {$tamam++;}

                            $tamam = $toplam - $aktiv;



                          @endphp

                          
                          @if($qaliq =='Tamam')
                         
                          <tr>
                            <td>{{$i+=1}}</td>
                            <td><img style="width:80px; height:70px;" src="{{url($info->image)}}"> </td>
                            <td>{{$info->ad}} {{$info->soyad}} </td>
                            <td>{{$info->tapsiriq}} </td>
                            <td>{{$info->tarix}}</td>
                            <td>{{$info->vaxt}}</td>
                            <td>{{$qaliq}}</td>
                            
                         <td>   

                        <a href="{{route('k_sil',$info->kid)}}"><button type="button" class="btn btn-outline-danger btn-fw btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></button></a>
                        <a href="{{route('k_edit',$info->kid)}}"><button type="button" class="btn btn-outline-warning btn-fw btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button></a>

                        
                         </td>
                            
                           
                          </tr>
                          
                          
                          @endif
                          @endforeach
@else

                          @foreach($data as $i=>$info)

                          @php
                            //2023-07-25 23:03:00
                            $t1 = $info->tarix.' '.$info->vaxt;
                            $t1 = strtotime($t1);

                            $t2 = time();

                            $san = $t1 - $t2;
                            $deq = round($san/60);
                            $saat = round($deq/60);
                            $gun = round($saat/24);

                            if($deq<60 && $san>0)
                            {$qaliq = $deq.' deqiqe';}
                            elseif($deq>60 && $saat<24)
                            {$qaliq = $saat.' saat';}
                            elseif($saat>23)
                            {$qaliq = $gun.' gun';}
                            else
                            {$qaliq = 'Tamam';}

                            $aktiv = 0;
                            $tamam = 0;


                          

                            if($san<1)
                            {$tamam++;}

                            $toplam = $tamam + $aktiv;



                          @endphp
                          
                          
                          
                         
                        
                         
                          <tr>
                            <td>{{$i+=1}}</td>
                            <td><img style="width:80px; height:70px;" src="{{url($info->image)}}"> </td>
                            <td>{{$info->ad}} {{$info->soyad}} </td>
                            <td>{{$info->tapsiriq}} </td>
                            <td>{{$info->tarix}}</td>
                            <td>{{$info->vaxt}}</td>
                            <td>{{$qaliq}}</td>
                            
                         <td>   

                        <a href="{{route('k_sil',$info->kid)}}"><button type="button" class="btn btn-outline-danger btn-fw btn-sm">Sil</button></a>
                        <a href="{{route('k_edit',$info->kid)}}"><button type="button" class="btn btn-outline-warning btn-fw btn-sm">Redakte</button></a>

                        
                         </td>
                            
                           
                          </tr> 
                          @endforeach

 @endif
                          
                         
                        
                         



                         
                         
                         
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection