@extends('admin.master')

@section('content')


  <section id="container" >
        @include('admin.sidebar')
        <section id="main-content">
            <section class="wrapper">


                <div class="content-box-large">
                    <h1>Send New Mail</h1>

                    {!! Form::open(['url' => 'admin/send',  'method' => 'post']) !!}
                      {{csrf_field()}}
                    @if(session('msg'))
                <div class="alert alert-success">  
                    <a href='#' class="close" data-dismiss="alert" aria-label="close" style="width: 300px;">x</a>
                  
                    {{session('msg')}}
                
                </div>
                @endif
                    <table class="table-borderless" style="height:300px;">

                        <tr>
                            <td> Send Email To:</td>
                            <td><input type="text" name="to" class="form-control"></td>
                        </tr>

                        <tr>
                            <td> Message:</td>
                            <td><textarea name="message" cols="70" rows="10" class="form-control"></textarea></td>
                        </tr>
                   
                             <td colspan="2">
                        <input type="submit" value="Send" class="btn btn-success pull-right" >
                             </td>
                         </tr>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        {!! Form::close() !!}
                    </table>
                </div>

            </section>
      </section>
</section>

@endsection
  