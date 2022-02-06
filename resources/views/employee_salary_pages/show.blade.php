@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3" style="min-width: 28rem;">
                        <div style="color:cornsilk"
                            class="card-header text-white d-flex justify-content-center bg-dark">
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
        <div class="card ml-3" style="max-width: 20rem;width: 111%;">
            <div style="color:cornsilk" class="card-header text-white bg-dark"> Stats.</div>
            <div style="background-color:lavender" class="card-body">

                <p class="card-text"> All employee Salaries Details: {{$count}} </p>
                @if((Auth::user()->Djv_Group == 'admin' || Auth::user()->Djv_Group == 'TopManager'||
                Auth::user()->Djv_Group == 'hr'))
                <a href="{{url('employees_salary/'.$user->id.'/'.$user->employee_code.'/create' )}}"
                    class="btn btn-dark"> Add new Salary Details</a>
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
                @foreach($all_emp_salaries as $salary)
                <div class="col-md-6">
                    <div class="card mb-3" style="min-width: 25rem;margin-left:100px">
                        <div style="color:cornsilk" class="card-header text-white bg-dark">
                            Salary Card {{$count_b}}
                        </div>
                        <div style="background-color:lavender" class="card-body">
                            <div class="card-title">
                                <h5>Month : {{$salary->month}}</h5> 
                            </div>
    
                            <hr>

                            <div class="card-title">
                                <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_basic_salary = openssl_decrypt($salary->basic_salary, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Basic Salary : <?php echo $decrypted_data_basic_salary?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_t_allowence = openssl_decrypt($salary->t_allowence, $encryptionMethod, $secretHash);
                                ?>
                                <h5>T.Allowance : <?php echo $decrypted_data_t_allowence?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_other_exempt = openssl_decrypt($salary->other_exempt, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Other Exempt : <?php echo $decrypted_data_other_exempt?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_s_commission = openssl_decrypt($salary->s_commission, $encryptionMethod, $secretHash);
                                ?>
                                <h5>S.Commission : <?php echo $decrypted_data_s_commission?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_day_off = openssl_decrypt($salary->day_off, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Day Off : <?php echo $decrypted_data_day_off?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_acting_allow = openssl_decrypt($salary->acting_allow, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Acting Allow : <?php echo $decrypted_data_acting_allow ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_overtime = openssl_decrypt($salary->overtime, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Overtime : <?php echo $decrypted_data_overtime?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_late = openssl_decrypt($salary->late, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Late : <?php echo $decrypted_data_late?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_absense = openssl_decrypt($salary->absense, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Absence : <?php echo $decrypted_data_absense?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_card = openssl_decrypt($salary->card, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Card : <?php echo $decrypted_data_card?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_other_deduct = openssl_decrypt($salary->other_deduct, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Other Deduct : <?php echo $decrypted_data_other_deduct?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_unpaid_leave = openssl_decrypt($salary->unpaid_leave, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Unpaid Leave : <?php echo $decrypted_data_unpaid_leave?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_penalty_day = openssl_decrypt($salary->penalty_day, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Penalty Day : <?php echo $decrypted_data_penalty_day?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_advance = openssl_decrypt($salary->advance, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Advance : <?php echo $decrypted_data_advance?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_loan = openssl_decrypt($salary->loan, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Loan : <?php echo $decrypted_data_loan?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_emp_insu = openssl_decrypt($salary->emp_insu, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Insuranse : <?php echo $decrypted_data_emp_insu?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                                        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                                        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                                        //To Decrypt
                                        $decrypted_data_net_salary = openssl_decrypt($salary->net_salary, $encryptionMethod, $secretHash);
                                ?>
                                <h5>Net Salary : <?php echo $decrypted_data_net_salary?></h5>
                            </div>

                            @if((Auth::user()->Djv_Group == 'admin' || Auth::user()->Djv_Group == 'TopManager'||
                            Auth::user()->Djv_Group == 'hr'))
                            <hr>
                            <div class="card-text">
                                <a href="{{url('employees_salary/'.$salary->id.'/edit')}}"
                                    class="btn btn-dark d-flex justify-content-center"> Edit Balance</a>
                                <hr>
                                <form id="delete-form-{{$salary->id}}" class="delete d-flex justify-content-center"
                                    action="{{route('employee_salary.destroy' , ['user_id'=> $user->id , 'id'=>$salary->id])}}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    {{-- <button type="submit" class="btn btn-danger" style="width:100%">Delete Note</button> --}}
                                </form>

                                <button onclick="if(confirm('Are you sure you want to delete this Salary Card?')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{$salary->id}}').submit();
                                      }else
                                      {
                                        event.preventDefault();
                                      }
                              
                                      " class="btn btn-danger" style="width:100%">Delete</button>
                            </div>
                            @endif
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
        {{$all_emp_salaries->links()}}
    </div>
</div>

@endsection