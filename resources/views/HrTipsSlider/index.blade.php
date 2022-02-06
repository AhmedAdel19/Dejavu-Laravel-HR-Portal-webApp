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
                           @php
                            $count_b=1;
                            @endphp
                            @foreach($all_tips as $tip)
                                <div class="col-md-6">
                                    <div class="card mb-3" style="min-width: 20rem;margin-left:5px">

                                        <div style="color:cornsilk" class="card-header text-white bg-dark">
                                            Tip {{$count_b}}
                                        </div>
                                        <div style="background-color:lavender" class="card-body">
                                            <div class="card-title">
                                                <h5>Tips</h5>
                                            </div>
                                            <div class="card-text">
                                                <ul>
                                                    <li>{{$tip->slide_text}}</li>
                                                </ul>
                                            </div>
                                            <hr>
                                            <div class="card-title">
                                                    <h5>Tip Images</h5>
                                                </div>
                                            <div class="card-text d-flex justify-content-center">
                                                    
                                                        <img src="{{asset('storage/SlideTipImages/'. $tip->slide_image)}}"  width="260" height="140"/>
              
                                                </div>
                                            <hr>

                                            <div class="card-text">
                                             <a href="{{url('HrTipsSlider/'.$tip->id.'/edit') }}" class="btn btn-dark d-flex justify-content-center"> Edit Tip</a>
                                            <hr>
                                            <form id="delete-form-{{$tip->id}}" class="delete d-flex justify-content-center"  action="{{route('hr_tip.destroy' , ['id'=>$tip->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                    {{-- <button type="submit" class="btn btn-danger" style="width:100%">Delete Tip</button> --}}
                                                </form>
                                                <button onclick="if(confirm('Are you sure you want to delete this Tip?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{$tip->id}}').submit();
                                                  }else
                                                  {
                                                    event.preventDefault();
                                                  }
                                          
                                                  " class="btn btn-danger" style="width:100%">Delete</button>
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

        <div class="col-md-3">
                <div class="card ml-3" style="max-width: 20rem;">
                        <div style="color:cornsilk" class="card-header text-white bg-dark"> Stats.</div>
                        <div style="background-color:lavender" class="card-body">
                        
                        <p class="card-text"> All Slide Tips: {{$count}} </p>
                        <a href="{{url('HrTipsSlider/createTip' )}}" class="btn btn-dark"> Add New Tip</a>

                        </div>
                    </div>
        </div>
</div>


    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            {{$all_tips->links()}}
        </div>
    </div>

  @endsection