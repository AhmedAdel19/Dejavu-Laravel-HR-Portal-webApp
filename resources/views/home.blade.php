@extends('layouts.master')
@section('content')



<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $tip_count=0;
                    ?>
                @foreach($last_tips as $tip)
                <?php
                if($tip_count == 0){
                    ?>
                    <div class="carousel-item active">
                        <div style="background-color: #021a47;height: 50px;">
                            <h5 style="text-align: center;color:#fff;padding: 0px;margin: 0px;font-family:Arial, Helvetica, sans-serif;font-size:22px ;padding-top:15px;">{{$tip->slide_text}}</h5>
                        </div>
                        <img class="d-block w-100" src="{{asset('storage/SlideTipImages/'. $tip->slide_image)}}" width="200" height="400" alt="First slide">
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="carousel-item ">
                        <div style="background-color: #021a47;height: 50px;">
                            <h5 style="text-align: center;color:#fff;padding: 0px;margin: 0px;font-family:Arial, Helvetica, sans-serif;font-size:22px ;padding-top:15px;">{{$tip->slide_text}}</h5>
                        </div>
                        <img class="d-block w-100" src="{{asset('storage/SlideTipImages/'. $tip->slide_image)}}" width="200" height="400" alt="First slide">
                    </div>
                    <?php
                }
                ?>

                    <?php 
                        $tip_count++;
                    ?>
                   
                @endforeach    
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- <span class="d-flex justify-content-center mb-5 mt-5" style="font-family: Arial; font-size: 3rem"> Welcome
                {{ Auth::user()->name }} </span> -->
            <div class="card mb-5">
                <div style="color:cornsilk;margin-top:20px" class="card-header d-flex justify-content-center bg-dark" style="font-family: Arial; font-size: 1rem"> latest Balance for you</div>

                <div style="background-color: lavender" class="card-body">


                    <ul style="text-align: center;">
                        <li>Annual leave : {{$auth_user_annual_leave}}</li>
                        <li>Sick leave : {{$auth_user_sick_leave}}</li>
                    </ul>
                </div>
            </div>
            @if(count($last_hr_notes) > 0)
            <div class="card mb-5">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark" style="font-family: Arial; font-size: 1rem"> latest HR notification for you</div>

                <div class="card-body">


                    <div class="row">

                        @foreach($last_hr_notes as $Hnote)

                        <div class="col-md-12">
                            <div class="card mb-3" style="min-width: 20rem;margin-left:5px">
                                <div style="color:cornsilk" class="card-header  text-white bg-dark">
                                    Hr Note
                                </div>
                                <div style="background-color: lavender" class="card-body">
                                    <div class="card-title">
                                        <h5>Notes</h5>
                                    </div>

                                    <div class="card-text">
                                        <ul>
                                            <li>{{$Hnote->note_text1}}</li>
                                            <li>{{$Hnote->note_text2}}</li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="card-title">
                                        <h5>Note Images</h5>
                                    </div>

                                    <div class="card-text">
                                        @if (!($Hnote->note_image1 === 'NoImage.png'))
                                        <img src="{{asset('storage/EmployeeNotificationImages/'. $Hnote->note_image1)}}" width="305" height="170" />

                                        @endif
                                        @if (!($Hnote->note_image2 === 'NoImage.png'))
                                        <img src="{{asset('storage/EmployeeNotificationImages/' . $Hnote->note_image2 )}}" width="305" height="170" />
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
            @endif


            @if(count($last_notes) > 0)
            <div class="card mb-5">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark" style="font-family: Arial; font-size: 1rem"> latest HR General Notifications</div>

                <div class="card-body">


                    <div class="row">
                        @php
                        $count_b=1;
                        @endphp
                        @foreach($last_notes as $note)
                        <div class="col-md-6">
                            <div class="card mb-3" style="min-width: 20rem;margin-left:5px">
                                <div style="color:cornsilk" class="card-header text-white bg-dark">
                                    Note {{$count_b}}
                                </div>
                                <div style="background-color: lavender" class="card-body">
                                    <div class="card-title">
                                        <h5>Notes</h5>
                                    </div>
                                    <div class="card-text">
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
                                        @if (!($note->note_image1 === 'NoImage.png'))
                                        <img src="{{asset('storage/GeneralNotificationImages/'. $note->note_image1)}}" width="270" height="140" />
                                        @endif
                                        @if (!($note->note_image2 === 'NoImage.png'))
                                        <img src="{{asset('storage/GeneralNotificationImages/' . $note->note_image2 )}}" width="270" height="140" />
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
            @endif
            <!-- <div class="card mb-5">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark"
                    style="font-family: Arial; font-size: 1rem"> latest Your Salary Details</div>

                <div class="card-body">


                    <div class="row">

                        @if($salary_details == '')
                        <div class="card-title">
                            <h5>Sorry : no any Salary Updated for you yet</h5>
                        </div>
                        @else
                        @foreach($salary_details as $salary)
                        <div class="col-md-6" style="margin:auto;">
                            <div class="card mb-3" style="min-width: 20rem;margin-left:5px;text-align:center;">

                                <div style="background-color: lavender" class="card-body">
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
                                <h5>Basic Salary : <?php echo $decrypted_data_basic_salary ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_t_allowence = openssl_decrypt($salary->t_allowence, $encryptionMethod, $secretHash);
                            ?>
                                <h5>T.Allowance : <?php echo $decrypted_data_t_allowence ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_other_exempt = openssl_decrypt($salary->other_exempt, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Other Exempt : <?php echo $decrypted_data_other_exempt ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_s_commission = openssl_decrypt($salary->s_commission, $encryptionMethod, $secretHash);
                            ?>
                                <h5>S.Commission : <?php echo $decrypted_data_s_commission ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_day_off = openssl_decrypt($salary->day_off, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Day Off : <?php echo $decrypted_data_day_off ?></h5>
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
                                <h5>Overtime : <?php echo $decrypted_data_overtime ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_late = openssl_decrypt($salary->late, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Late : <?php echo $decrypted_data_late ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_absense = openssl_decrypt($salary->absense, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Absence : <?php echo $decrypted_data_absense ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_card = openssl_decrypt($salary->card, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Card : <?php echo $decrypted_data_card ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_other_deduct = openssl_decrypt($salary->other_deduct, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Other Deduct : <?php echo $decrypted_data_other_deduct ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_unpaid_leave = openssl_decrypt($salary->unpaid_leave, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Unpaid Leave : <?php echo $decrypted_data_unpaid_leave ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_penalty_day = openssl_decrypt($salary->penalty_day, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Penalty Day : <?php echo $decrypted_data_penalty_day ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_advance = openssl_decrypt($salary->advance, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Advance : <?php echo $decrypted_data_advance ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_loan = openssl_decrypt($salary->loan, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Loan : <?php echo $decrypted_data_loan ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_emp_insu = openssl_decrypt($salary->emp_insu, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Insuranse : <?php echo $decrypted_data_emp_insu ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_net_salary = openssl_decrypt($salary->net_salary, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Net Salary : <?php echo $decrypted_data_net_salary ?></h5>
                            </div>


                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>
                </div>
            </div> -->

            <!-- @if((Auth::user()->Djv_Group == 'admin' || Auth::user()->Djv_Group == 'TopManager'||
            Auth::user()->Djv_Group == 'hr'))
            <span class="d-flex justify-content-center mb-5 mt-5" style="font-family: Arial; font-size: 3rem"> Welcome
                {{ Auth::user()->name }} </span>
            <div class="card mb-5">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark"
                    style="font-family: Arial; font-size: 1rem"> latest Balance for you</div>

                <div style="background-color: lavender" class="card-body">


                    <ul>
                        <li>your Annual leave : {{$auth_user_annual_leave}}</li>
                        <li>your Sick leave : {{$auth_user_sick_leave}}</li>
                    </ul>
                </div>
            </div>

            <div class="card mb-5">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark"
                    style="font-family: Arial; font-size: 1rem"> latest HR notification for you</div>

                <div class="card-body">


                    <div class="row">
                        @foreach($last_hr_notes as $Hnote)
                        <div class="col-md-12">
                            <div class="card mb-3" style="min-width: 20rem;margin-left:5px">
                                <div style="color:cornsilk" class="card-header  text-white bg-dark">
                                    Hr Note
                                </div>
                                <div style="background-color: lavender" class="card-body">
                                    <div class="card-title">
                                        <h5>Notes</h5>
                                    </div>
                                    <div class="card-text">
                                        <ul>
                                            <li>{{$Hnote->note_text1}}</li>
                                            <li>{{$Hnote->note_text2}}</li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="card-title">
                                        <h5>Note Images</h5>
                                    </div>

                                    <div class="card-text">
                                        @if (!($Hnote->note_image1 === 'NoImage.png'))
                                        <img src="{{asset('storage/EmployeeNotificationImages/'. $Hnote->note_image1)}}"
                                            width="305" height="170" />

                                        @endif
                                        @if (!($Hnote->note_image2 === 'NoImage.png'))
                                        <img src="{{asset('storage/EmployeeNotificationImages/' . $Hnote->note_image2 )}}"
                                            width="305" height="170" />
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card mb-5">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark"
                    style="font-family: Arial; font-size: 1rem"> latest HR General Notifications</div>

                <div class="card-body">


                    <div class="row">
                        @php
                        $count_b=1;
                        @endphp
                        @foreach($last_notes as $note)
                        <div class="col-md-6">
                            <div class="card mb-3" style="min-width: 20rem;margin-left:5px">
                                <div style="color:cornsilk" class="card-header text-white bg-dark">
                                    Note {{$count_b}}
                                </div>
                                <div style="background-color: lavender" class="card-body">
                                    <div class="card-title">
                                        <h5>Notes</h5>
                                    </div>
                                    <div class="card-text">
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
                                        @if (!($note->note_image1 === 'NoImage.png'))
                                        <img src="{{asset('storage/GeneralNotificationImages/'. $note->note_image1)}}"
                                            width="270" height="140" />
                                        @endif
                                        @if (!($note->note_image2 === 'NoImage.png'))
                                        <img src="{{asset('storage/GeneralNotificationImages/' . $note->note_image2 )}}"
                                            width="270" height="140" />
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

            <div class="card mb-5">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark"
                    style="font-family: Arial; font-size: 1rem"> latest Your Salary Details</div>

                <div class="card-body">


                    <div class="row">

                        @if($salary_details == '')
                        <div class="card-title">
                            <h5>Sorry : no any Salary Updated for you yet</h5>
                        </div>
                        @else
                        @foreach($salary_details as $salary)
                        <div class="col-md-6" style="margin:auto;">
                            <div class="card mb-3" style="min-width: 20rem;margin-left:5px;text-align:center;">

                                <div style="background-color: lavender" class="card-body">
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
                                <h5>Basic Salary : <?php echo $decrypted_data_basic_salary ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_t_allowence = openssl_decrypt($salary->t_allowence, $encryptionMethod, $secretHash);
                            ?>
                                <h5>T.Allowance : <?php echo $decrypted_data_t_allowence ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_other_exempt = openssl_decrypt($salary->other_exempt, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Other Exempt : <?php echo $decrypted_data_other_exempt ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_s_commission = openssl_decrypt($salary->s_commission, $encryptionMethod, $secretHash);
                            ?>
                                <h5>S.Commission : <?php echo $decrypted_data_s_commission ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_day_off = openssl_decrypt($salary->day_off, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Day Off : <?php echo $decrypted_data_day_off ?></h5>
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
                                <h5>Overtime : <?php echo $decrypted_data_overtime ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_late = openssl_decrypt($salary->late, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Late : <?php echo $decrypted_data_late ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">

                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_absense = openssl_decrypt($salary->absense, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Absence : <?php echo $decrypted_data_absense ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_card = openssl_decrypt($salary->card, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Card : <?php echo $decrypted_data_card ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_other_deduct = openssl_decrypt($salary->other_deduct, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Other Deduct : <?php echo $decrypted_data_other_deduct ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_unpaid_leave = openssl_decrypt($salary->unpaid_leave, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Unpaid Leave : <?php echo $decrypted_data_unpaid_leave ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_penalty_day = openssl_decrypt($salary->penalty_day, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Penalty Day : <?php echo $decrypted_data_penalty_day ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_advance = openssl_decrypt($salary->advance, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Advance : <?php echo $decrypted_data_advance ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_loan = openssl_decrypt($salary->loan, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Loan : <?php echo $decrypted_data_loan ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_emp_insu = openssl_decrypt($salary->emp_insu, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Insuranse : <?php echo $decrypted_data_emp_insu ?></h5>
                            </div>
                            <hr>

                            <div class="card-title">
                            <?php
                            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
                            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
                            //To Decrypt
                            $decrypted_data_net_salary = openssl_decrypt($salary->net_salary, $encryptionMethod, $secretHash);
                            ?>
                                <h5>Net Salary : <?php echo $decrypted_data_net_salary ?></h5>
                            </div>


                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @else
            <span class="d-flex justify-content-center mb-5 mt-10"
                style="font-family: Arial; font-size: 3rem ;margin-top:200px"> Welcome Mr: {{ Auth::user()->name }}
            </span>
            @endif -->
        </div>
    </div>
</div>

{{-- <script>
        $(document).ready(function(){
        $("#user_name_home").fadeIn(300);
        $("#user_name_home").animate({left: '100px'}, "slow");
        $("#user_name_home").animate({fontSize: '3em'}, "slow"); 
        
        
            });
        </script> --}}
@endsection