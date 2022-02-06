@extends('layouts.master')

@section('content')



<!-------------------------Start Create Form-------------------------------->

<div id="CreateComlainForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content d-flex justify-content-center ">
            <div class="modal-header">
                <h3 style="text-align: center; margin-left: 30%" class="modal-title">Add Complain</h3>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('complains')}}" enctype="multipart/form-data">
                  @csrf
                    <div style="padding: 5%" class="form-group">
                        <div>
                            <textarea style="margin-top: 5%" id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}"></textarea>

                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                            <input style="margin-top: 5%" type="file" class="form-control input-lg" id="img1" placeholder="choose first image" name="img1">  

                            <div style="margin-top: 5%" class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="chek_identy" name="chek_identy">
                                <label class="custom-control-label" for="chek_identy"><span style="color: #000;font-size: 17px" >Know me</span></label>
                              </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="form-control btn btn-success">Send</button>
                        </div>
                    </div>
  
                </form>
            </div>
        </div>
    </div>
  </div>
<!---------------------------End Create Form-------------------------------->

<!-- Card -->
<style>
    .collapse-content {
      float: right;
  }
  .text-muted {
      color: #000!important;
  }
  .collapse-content .fa.fa-trash-alt:hover {
    color: #0d47a1 !important;
  }
  </style>

  {{-- <button type="submit" class="form-control btn btn-success">Add new Complain</button>  --}}

  <a style="background-color: #021a47;margin-left: 13%; margin-bottom: 2%" class="btn" data-toggle="modal" data-target="#CreateComlainForm" data-placement="top" title="Add New Complain" aria-expanded="false" href="#CreateComlainForm">Add New Complain</a>

  @foreach ($all_complain as $complain)
  
  <!-- Modal HTML Markup -->
  <div id="ModalLoginForm{{$complain->id}}" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Write reply</h1>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('/complains/reply')}}">
                  @csrf
                    {{-- <input type="hidden" name="_token" value=""> --}}
                    <div class="form-group">
                        <label class="control-label">reply content</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="reply_content" value="">
                            <input type="hidden" class="form-control input-lg" name="complain_id" value="{{$complain->id}}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success">Reply</button>
                        </div>
                    </div>
  
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  

   <div style="max-width: 76%; margin-left: 13%" class="card promoting-card">
  
    @php
        $emp_id = $complain->user_id;
       $emp= DB::select("select * from  users where id = $emp_id")[0];
    @endphp
  
      <!-- Card content -->
      <div class="card-body d-flex flex-row">
    
        <!-- Avatar -->
        <img src="{{asset('storage/EmployeeProfileImages/'. $emp->user_pp)}}" class="rounded-circle mr-3" height="50px" width="50px" alt="avatar">
    
        <!-- Content -->
        <div>
    
          <!-- Title -->
        <h4 class="card-title font-weight-bold mb-2">{{$emp->name}}</h4>
  
          <!-- Subtitle -->
        <p class="card-text"><i class="far fa-clock pr-2"></i>{{$complain->created_at}}</p>
    
        </div>
    
      </div>
      <div style="padding: 10px; font-family: Arial; font-size: 18px">
        {{$complain->content}}
      </div>
      <!-- Card image -->
      <div class="view overlay">
  
        @if (!($complain->complain_image === 'NoImage.png'))
        
        <img style="width: 60%;margin-left: 20%;max-height: 300px" class="card-img-top rounded-0" src="{{asset('storage/ComplainImages/'. $complain->complain_image)}}" alt="complain image">
        <a href="#!">
          <div class="mask rgba-white-slight"></div>
        </a>
            
        @endif
      </div>
    
      <!-- Card content -->
      <div class="card-body">
    
    
          {{-- <!-- Text -->
        <p class="card-text collapse" id="collapseContent{{$complain->id}}">{{$complain->content}}.</p>
          <!-- Button --> --}}
  
          <!--Complain replies section-->
          <div class="card-text collapse" id="collapseReplaiesContent{{$complain->id}}">
            @php
               $replies= DB::select("select * from  complain_replies where 	complain_id = $complain->id");
            @endphp
            @foreach ($replies as $reply)
               @if ($reply->user_id == Auth::user()->id)
               <p style="margin-left:10%;margin-top: 10px" class="card-text"><i class="far fa-clock pr-2"></i>{{$reply->created_at}}</p>
               <div style="font-family: Arial;font-size: 18px;background-color:burlywood ;margin-left:10%; max-width: 300px;text-align: center;padding: 10px;border-color: #000;border-radius: 20px" >{{$reply->reply}}</div>
               @else
               <p style="margin-left:60%;margin-top: 10px" class="card-text"><i class="far fa-clock pr-2"></i>{{$reply->created_at}}</p>
               <div style="font-family: Arial;font-size: 18px;background-color: cyan; margin-left:60%; max-width: 300px;text-align: center;padding: 10px;border-color: #000;border-radius: 20px" >{{$reply->reply}}</div>
               @endif
            @endforeach
          </div>
          <!--########################-->
  
        <a style="background-color: #fff" class="btn btn-flat red-text p-1 my-1 mr-0 mml-1 " aria-expanded="false" href="#ModalLoginForm{{$complain->id}}" aria-controls="collapseContent"><i class="fas fa-comment-dots fa-lg text-muted float-right p-1 my-1" data-toggle="modal" data-target="#ModalLoginForm{{$complain->id}}" data-placement="top" title="write reply"></i></a>
        {{-- <a class="btn btn-flat red-text p-1 my-1 mr-0 mml-1 collapsed" data-toggle="collapse" href="#collapseContent{{$complain->id}}" aria-expanded="false" aria-controls="collapseContent"><i class="fas fa-eye text-muted float-right p-1 my-1" data-toggle="tooltip" data-placement="top" title="show more"></i></a> --}}
  
        <a style="background-color: #fff" class="btn btn-flat red-text p-1 my-1 mr-0 mml-1 collapsed" data-toggle="collapse" aria-expanded="false" href="#collapseReplaiesContent{{$complain->id}}" aria-controls="collapseContent"><i class="fas fa-eye fa-lg text-muted float-right p-1 my-1" data-toggle="tooltip" data-target="#collapseReplaiesContent{{$complain->id}}" data-placement="top" title="show replies"></i></a>
  
  
  
        <div class="collapse-content">
        <form id="delete-form-{{$complain->id}}" class="delete d-flex justify-content-center"  action="{{route('complains.destroy',$complain->id)}}" method="POST">
          @csrf
          @method('DELETE')
          
          {{-- <button type="submit" class="btn btn-danger" style="width:100%">Delete Note</button> --}}
      </form>
  
      <button style="background-color: #fff" onclick="if(confirm('Are you sure you want to delete this Complain?')){
        event.preventDefault();
        document.getElementById('delete-form-{{$complain->id}}').submit();
      }else
      {
        event.preventDefault();
      }
  
      " class="btn btn-sm"><i style="color: #fff" class="fas fa-trash-alt fa-lg text-muted float-right p-1 my-1" data-toggle="tooltip" data-placement="top" title="delete this complain"></i></button>      </div>
           
  
           {{-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalLoginForm">
              Launch demo modal
            </button> --}}
      </div>
    
    </div>
    <!-- Card -->

  
  @endforeach


@endsection
