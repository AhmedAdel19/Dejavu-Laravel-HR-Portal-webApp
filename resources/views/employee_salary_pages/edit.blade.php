@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark">{{ __('Edit Balance') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('employees_salary/'.$salary->id)}}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Month') }}</label>

                            <div class="col-md-6">
                                <input id="month" type="text" class="form-control{{ $errors->has('annual_leave') ? ' is-invalid' : '' }}" name="month" value="{{$salary->month}}">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_basic_salary = openssl_decrypt($salary->basic_salary, $encryptionMethod, $secretHash);
                                ?>
                                <input id="basic_salary" type="text" class="form-control{{ $errors->has('basic_salary') ? ' is-invalid' : '' }}" name="basic_salary" value="<?php echo $decrypted_data_basic_salary;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_t_allowence = openssl_decrypt($salary->t_allowence, $encryptionMethod, $secretHash);
                                ?>
                                <input id="t_allowence" type="text" class="form-control{{ $errors->has('t_allowence') ? ' is-invalid' : '' }}" name="t_allowence" value="<?php echo $decrypted_data_t_allowence;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_other_exempt = openssl_decrypt($salary->other_exempt, $encryptionMethod, $secretHash);
                                ?>
                                <input id="other_exempt" type="text" class="form-control{{ $errors->has('other_exempt') ? ' is-invalid' : '' }}" name="other_exempt" value="<?php echo $decrypted_data_other_exempt;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_s_commission = openssl_decrypt($salary->s_commission, $encryptionMethod, $secretHash);
                                ?>
                                <input id="month" type="text" class="form-control{{ $errors->has('s_commission') ? ' is-invalid' : '' }}" name="s_commission" value="<?php echo $decrypted_data_s_commission;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_day_off = openssl_decrypt($salary->day_off, $encryptionMethod, $secretHash);
                                ?>
                                <input id="day_off" type="text" class="form-control{{ $errors->has('day_off') ? ' is-invalid' : '' }}" name="day_off" value="<?php echo $decrypted_data_day_off ;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_acting_allow = openssl_decrypt($salary->acting_allow, $encryptionMethod, $secretHash);
                                ?>
                                <input id="acting_allow" type="text" class="form-control{{ $errors->has('acting_allow') ? ' is-invalid' : '' }}" name="acting_allow" value="<?php echo $decrypted_data_acting_allow;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_overtime = openssl_decrypt($salary->overtime, $encryptionMethod, $secretHash);
                                ?>
                                <input id="overtime" type="text" class="form-control{{ $errors->has('overtime') ? ' is-invalid' : '' }}" name="overtime" value="<?php echo $decrypted_data_overtime;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_late = openssl_decrypt($salary->late, $encryptionMethod, $secretHash);
                                ?>
                                <input id="late" type="text" class="form-control{{ $errors->has('late') ? ' is-invalid' : '' }}" name="late" value="<?php echo $decrypted_data_late;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_absense = openssl_decrypt($salary->absense, $encryptionMethod, $secretHash);
                                ?>
                                <input id="absense" type="text" class="form-control{{ $errors->has('absense') ? ' is-invalid' : '' }}" name="absense" value="<?php echo $decrypted_data_absense;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_card = openssl_decrypt($salary->card, $encryptionMethod, $secretHash);
                                ?>
                                <input id="card" type="text" class="form-control{{ $errors->has('card') ? ' is-invalid' : '' }}" name="card" value="<?php echo $decrypted_data_card;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_other_deduct = openssl_decrypt($salary->other_deduct, $encryptionMethod, $secretHash);
                                ?>
                                <input id="other_deduct" type="text" class="form-control{{ $errors->has('other_deduct') ? ' is-invalid' : '' }}" name="other_deduct" value="<?php echo $decrypted_data_other_deduct;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_unpaid_leave = openssl_decrypt($salary->unpaid_leave, $encryptionMethod, $secretHash);
                                ?>
                                <input id="unpaid_leave" type="text" class="form-control{{ $errors->has('unpaid_leave') ? ' is-invalid' : '' }}" name="unpaid_leave" value="<?php echo $decrypted_data_unpaid_leave;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_penalty_day = openssl_decrypt($salary->penalty_day, $encryptionMethod, $secretHash);
                                ?>
                                <input id="penalty_day" type="text" class="form-control{{ $errors->has('penalty_day') ? ' is-invalid' : '' }}" name="penalty_day" value="<?php echo $decrypted_data_penalty_day;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_advance = openssl_decrypt($salary->advance, $encryptionMethod, $secretHash);
                                ?>
                                <input id="advance" type="text" class="form-control{{ $errors->has('advance') ? ' is-invalid' : '' }}" name="advance" value="<?php echo $decrypted_data_advance;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_loan = openssl_decrypt($salary->loan, $encryptionMethod, $secretHash);
                                ?>
                                <input id="loan" type="text" class="form-control{{ $errors->has('loan') ? ' is-invalid' : '' }}" name="loan" value="<?php echo $decrypted_data_loan;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_emp_insu = openssl_decrypt($salary->emp_insu, $encryptionMethod, $secretHash);
                                ?>
                                <input id="emp_insu" type="text" class="form-control{{ $errors->has('emp_insu') ? ' is-invalid' : '' }}" name="emp_insu" value="<?php echo $decrypted_data_emp_insu ;?>">

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
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_net_salary = openssl_decrypt($salary->net_salary, $encryptionMethod, $secretHash);
                                ?>
                                <input id="net_salary" type="text" class="form-control{{ $errors->has('net_salary') ? ' is-invalid' : '' }}" name="net_salary" value="<?php echo $decrypted_data_net_salary;?>">

                                @if ($errors->has('net_salary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('net_salary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!-- testtttttt-->

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Edit') }}
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
