@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark">{{ __('Add new Employee Notification') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('employees_notify/'.$id.'/'.$emp_code)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="note1" class="col-md-4 col-form-label text-md-right">{{ __('Note 1') }}</label>

                            <div class="col-md-6">
                                <textarea id="note1" type="text" class="form-control{{ $errors->has('note1') ? ' is-invalid' : '' }}" name="note1" value="{{ old('note1') }}"></textarea>

                                @if ($errors->has('note1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note2" class="col-md-4 col-form-label text-md-right">{{ __('Note 2') }}</label>

                            <div class="col-md-6">
                                <textarea id="note2" type="text" class="form-control{{ $errors->has('note2') ? ' is-invalid' : '' }}" name="note2" value="{{ old('note2') }}" ></textarea>

                                @if ($errors->has('note2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row" style="margin-left: 140px">  
                            <label for="start_date" class="col-md-2 col-form-label ">{{ __('Start') }}</label>

                            <input type="date" class="form-control col-lg-7" id="start_date" name="start_date">  
                        </div>
                        <div class="form-group row" style="margin-left: 140px">  
                            <label for="end_date" class="col-md-2 col-form-label ">{{ __('End ') }}</label>

                            <input type="date" class="form-control col-lg-7" id="end_date" name="end_date">  
                        </div>
                        <div class="form-group row" style="margin-left: 250px">  
                                <input type="file" class="form-control col-lg-8" id="img1" placeholder="choose first image" name="img1">  
                        </div>
                        <div class="form-group row" style="margin-left: 250px">  
                                <input type="file" class="form-control col-lg-8" id="img2" placeholder="choose second image" name="img2">  
                        </div>



                        <!-- testtttttt-->

                        {{-- <div class="form-group row">
                                <label for="group" class="col-md-4 col-form-label text-md-right">{{ __('Add To') }}</label>
                                <div class="col-md-6">
                                <select class="mdb-select  md-outline colorful-select dropdown-primary form-control" name="emp_group" id="emp_group">
                                    @php
                                        $all_groups = DB::select('select * from  djv_groups order by id desc'); 
                                    @endphp
                                        <option value="" disabled selected>Choose employee</option>
                                        @foreach ($all_groups as $group)
                                        <option value={{$group->group_name}}>{{$group->group_name}}</option>
                                        @endforeach
                                      </select> 
          
                                </div>
                            </div> --}}
                        
                        <!--ttttttttttt-->                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Add') }}
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
