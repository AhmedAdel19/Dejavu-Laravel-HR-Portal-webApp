@extends('layouts.master')

@section('content')
<div class="container">
    <h1>{{Session::get('data')}}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="color:cornsilk" class="card-header d-flex justify-content-center bg-dark">{{ __('Import Employee CSV File') }}</div>

                <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{url('/upload')}}">
                    @csrf
                    <div class="form-group">
                        <table class="table">
                         <tr>
                          <td width="40%" align="right"><label>Select File for Upload</label></td>
                          <td width="30">
                           <input type="file" name="upload_file" />
                          </td>
                          <td width="30%" align="left">
                           <input type="submit" name="upload" class="btn btn-dark" value="Upload">
                          </td>
                         </tr>
            
                        </table>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
