@extends('layouts.master')

@section('content')



<!-- Card -->
<style>
  .collapse-content {
    float: right;
  }

  .text-muted {
    color: #000 !important;
  }

  .collapse-content .fa.fa-trash-alt:hover {
    color: #0d47a1 !important;
  }
</style>


<div style="  margin: auto;
  width: 50%;
  border: 1px solid #000;
  border-radius:20px;
  padding: 10px;">
        <h5 style="text-align: center;">HR Send Bulk Salary Messages</h5>
        <form method="POST" action="{{url('/sendWMessages')}}" enctype="multipart/form-data">
        @csrf
            <!-- <div style="margin:auto;" class="form-check">
                <input type="checkbox" class="form-check-input" id="use_email" name="use_email">
                <label class="form-check-label" for="use_email">Send Emails </label>
            </div>             -->
            <!-- <div id="email_section" style="display:none;">
            </br>
            <input type="email" id="email" name="email" class="form-control"
                placeholder="Enter HR Email"  />
            </br>
            <input type="password" id="password" name="password" class="form-control"
                placeholder="Enter HR Email Password" />
            </div>
            </br>
            <input type="text" id="message_subject" name="message_subject" value="<?php echo $m_subject ;?>" class="form-control"
                placeholder="Enter Subject" />
            </br>
            <div> -->
            <input type="file" class="form-control" id="filename" name='filename'  />
            </br>
            <input class="send_btn form-control btn btn-primary" type='submit' name='submit' value='Send'>
        </form>
    </div>

@endsection