@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark">{{ __('Add Salary Details To Employee') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('employees_salary/'.$id.'/'.$emp_code)}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Month') }}</label>

                            <div class="col-md-6">
                                <input id="month" type="text" class="form-control{{ $errors->has('annual_leave') ? ' is-invalid' : '' }}" name="month" value="{{ old('month') }}">

                                @if ($errors->has('month'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Basic Salary') }}</label>

                            <div class="col-md-6">
                                <input id="basic_salary" type="text" class="form-control{{ $errors->has('basic_salary') ? ' is-invalid' : '' }}" name="basic_salary" value="{{ old('basic_salary') }}">

                                @if ($errors->has('basic_salary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('basic_salary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('T.Allowence') }}</label>

                            <div class="col-md-6">
                                <input id="t_allowence" type="text" class="form-control{{ $errors->has('t_allowence') ? ' is-invalid' : '' }}" name="t_allowence" value="{{ old('t_allowence') }}">

                                @if ($errors->has('t_allowence'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('t_allowence') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Other Exempt') }}</label>

                            <div class="col-md-6">
                                <input id="other_exempt" type="text" class="form-control{{ $errors->has('other_exempt') ? ' is-invalid' : '' }}" name="other_exempt" value="{{ old('other_exempt') }}">

                                @if ($errors->has('other_exempt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('other_exempt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('S.Comission') }}</label>

                            <div class="col-md-6">
                                <input id="month" type="text" class="form-control{{ $errors->has('s_commission') ? ' is-invalid' : '' }}" name="s_commission" value="{{ old('s_commission') }}">

                                @if ($errors->has('s_commission'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('s_commission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Day Off') }}</label>

                            <div class="col-md-6">
                                <input id="day_off" type="text" class="form-control{{ $errors->has('day_off') ? ' is-invalid' : '' }}" name="day_off" value="{{ old('day_off') }}">

                                @if ($errors->has('day_off'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('day_off') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Acting Allow') }}</label>

                            <div class="col-md-6">
                                <input id="acting_allow" type="text" class="form-control{{ $errors->has('acting_allow') ? ' is-invalid' : '' }}" name="acting_allow" value="{{ old('acting_allow') }}">

                                @if ($errors->has('acting_allow'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('acting_allow') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Overtime') }}</label>

                            <div class="col-md-6">
                                <input id="overtime" type="text" class="form-control{{ $errors->has('overtime') ? ' is-invalid' : '' }}" name="overtime" value="{{ old('overtime') }}">

                                @if ($errors->has('overtime'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('overtime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Late') }}</label>

                            <div class="col-md-6">
                                <input id="late" type="text" class="form-control{{ $errors->has('late') ? ' is-invalid' : '' }}" name="late" value="{{ old('late') }}">

                                @if ($errors->has('late'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('late') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Absense') }}</label>

                            <div class="col-md-6">
                                <input id="absense" type="text" class="form-control{{ $errors->has('absense') ? ' is-invalid' : '' }}" name="absense" value="{{ old('absense') }}">

                                @if ($errors->has('absense'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('absense') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Card') }}</label>

                            <div class="col-md-6">
                                <input id="card" type="text" class="form-control{{ $errors->has('card') ? ' is-invalid' : '' }}" name="card" value="{{ old('card') }}">

                                @if ($errors->has('card'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('card') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Other Deduct') }}</label>

                            <div class="col-md-6">
                                <input id="other_deduct" type="text" class="form-control{{ $errors->has('other_deduct') ? ' is-invalid' : '' }}" name="other_deduct" value="{{ old('other_deduct') }}">

                                @if ($errors->has('other_deduct'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('other_deduct') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Unpaid Leave') }}</label>

                            <div class="col-md-6">
                                <input id="unpaid_leave" type="text" class="form-control{{ $errors->has('unpaid_leave') ? ' is-invalid' : '' }}" name="unpaid_leave" value="{{ old('unpaid_leave') }}">

                                @if ($errors->has('unpaid_leave'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('unpaid_leave') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Penalty day') }}</label>

                            <div class="col-md-6">
                                <input id="penalty_day" type="text" class="form-control{{ $errors->has('penalty_day') ? ' is-invalid' : '' }}" name="penalty_day" value="{{ old('penalty_day') }}">

                                @if ($errors->has('penalty_day'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('penalty_day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Advance') }}</label>

                            <div class="col-md-6">
                                <input id="advance" type="text" class="form-control{{ $errors->has('advance') ? ' is-invalid' : '' }}" name="advance" value="{{ old('advance') }}">

                                @if ($errors->has('advance'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('advance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Loan') }}</label>

                            <div class="col-md-6">
                                <input id="loan" type="text" class="form-control{{ $errors->has('loan') ? ' is-invalid' : '' }}" name="loan" value="{{ old('loan') }}">

                                @if ($errors->has('loan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('loan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Insuranse') }}</label>

                            <div class="col-md-6">
                                <input id="emp_insu" type="text" class="form-control{{ $errors->has('emp_insu') ? ' is-invalid' : '' }}" name="emp_insu" value="{{ old('emp_insu') }}">

                                @if ($errors->has('emp_insu'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('emp_insu') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Net-Salary') }}</label>

                            <div class="col-md-6">
                                <input id="net_salary" type="text" class="form-control{{ $errors->has('net_salary') ? ' is-invalid' : '' }}" name="net_salary" value="{{ old('net_salary') }}">

                                @if ($errors->has('net_salary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('net_salary') }}</strong>
                                    </span>
                                @endif
                            </div>
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
