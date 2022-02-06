@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark">{{ __('Add New Slider Tip') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('HrTipsSlider')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="tip" class="col-md-4 col-form-label text-md-right">{{ __('tip ') }}</label>

                            <div class="col-md-6">
                                <textarea id="tip" type="text" class="form-control{{ $errors->has('tip') ? ' is-invalid' : '' }}" name="tip" value="{{ old('tip') }}"></textarea>

                                @if ($errors->has('tip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" style="margin-left: 250px">  
                                <input type="file" class="form-control col-lg-8" id="img" placeholder="choose image" name="img">  
                        </div>

        
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
