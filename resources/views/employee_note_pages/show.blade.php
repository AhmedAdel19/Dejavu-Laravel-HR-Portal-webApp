@extends('layouts.master')

@section('content')

<style>
    .watermark {
        width: 311px;
        /* height: 100px; */
        display: block;
        font-size: 102px;
        position: absolute;
        margin-top: 36%;
        margin-left: 17%;
        opacity: 0.9;
        /* offset-rotate: reverse; */
        transform-origin: 0 0;
        transform: rotate(26deg);
    }
    
    .watermark::after {
      content: "";
     background:url(https://www.google.co.in/images/srpr/logo11w.png);
      opacity: 0.2;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      position: absolute;
      z-index: -1;   
    }
    </style>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3" style="min-width: 28rem;">
                                <div style="color:cornsilk" class="card-header text-white d-flex justify-content-center bg-dark">
                                      employee info  
                                </div>
                                <div style="background-color:lavender" class="card-body">
                                    <div class="card-title">
                                        <h5>employee name </h5>
                                    </div>
                                    <div class="card-text">
                                        <h6>{{$user->name}}</h6>
                                    </div>
                                    <hr>
                                    <div class="card-title">
                                        <h5>employee email </h5>
                                        </div>
                                        <div class="card-text">
                                         <h6>{{$user->email}}</h6>
                                        </div>
                                        <hr>
                                    <div class="card-title">
                                        <h5>employee mobile </h5>
                                        </div>
                                        <div class="card-text">
                                            <h6>{{$user->mobile}}</h6>
                                        </div>
                                </div>    
                            </div>
                       </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
                <div class="card ml-3" style="max-width: 20rem;">
                        <div style="color:cornsilk" class="card-header text-white bg-dark"> Stats.</div>
                        <div style="background-color:lavender" class="card-body">
                        
                        <p class="card-text"> All employee Notes: {{$count}} </p>
                        @if((Auth::user()->Djv_Group == 'admin' || Auth::user()->Djv_Group == 'TopManager'|| Auth::user()->Djv_Group == 'hr'))
                        <a href="{{url('employees_notify/'.$user->id.'/'.$user->employee_code.'/create')}}" class="btn btn-dark"> Add new note</a>
                        @endif

                        </div>
                    </div>
        </div>
</div>

<hr>

<div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="row">
                   @php
                    $count_b=1;
                    @endphp
                    @foreach($all_emp_notes as $note)
                    <div class="col-md-6">
                        <div class="card mb-3" style="min-width: 25rem;margin-left:100px">
                            @if (!($note->start_date <= $current && $note->end_date >= $current))
                            <div class="watermark" id="background">
                                <p style="font-size: 27px;" id="bg-text">this notification is Expired</p>
                                  </div>
                            @endif
                            <div style="color:cornsilk" class="card-header text-white bg-dark">
                                Note {{$count_b}}
                            </div>
                            <div style="background-color:lavender" class="card-body">
                                <div class="card-title">
                                    <h5>Notes</h5>
                                </div>
                                <div  class="card-text">
                                    <ul>
                                        <li>{{$note->note_text1}}</li>
                                        <li>{{$note->note_text2}}</li>
                                    </ul>
                                </div>
                                <hr>
                                <div class="card-title">
                                        <h5>Note Images</h5>
                                    </div>
                                <div class="card-text">                                 
                                    <img src="{{asset('storage/EmployeeNotificationImages/'. $note->note_image1)}}"  width="170" height="200"/>
                                    <img src="{{asset('storage/EmployeeNotificationImages/' . $note->note_image2 )}}" width="170" height="200"/> 
                                </div>
                                <hr>
                                <div class="card-text">
                                
                                 @if((Auth::user()->Djv_Group == 'admin' || Auth::user()->Djv_Group == 'TopManager'|| Auth::user()->Djv_Group == 'hr'))
                                 <a href="{{url('employees_notify/'.$note->id.'/edit')}}" class="btn btn-dark d-flex justify-content-center"> Edit Note</a>

                                 <hr>
                                <form id="delete-form-{{$note->id}}"  class="delete d-flex justify-content-center"  action="{{route('employee_note.destroy' , ['user_id'=> $user->id , 'id'=>$note->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')                                         
                                        {{-- <button type="submit" class="btn btn-danger" style="width:100%">Delete Note</button> --}}                                       
                                    </form>

                                    <button onclick="if(confirm('Are you sure you want to delete this notification?')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{$note->id}}').submit();
                                      }else
                                      {
                                        event.preventDefault();
                                      }
                              
                                      " class="btn btn-danger" style="width:100%">Delete</button>
                                
                                @endif
                            </div>
                            </div>    
                        </div>
                   </div>       
                       @php
                           $count_b++;
                       @endphp
                    @endforeach
                </div>
            </div>
        </div>


</div>

    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            {{$all_emp_notes->links()}}
        </div>
    </div>

  @endsection