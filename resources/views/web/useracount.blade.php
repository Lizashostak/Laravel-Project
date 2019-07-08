
@extends('master')
@section('content')


<section class="jumbotron align-content-center">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 col-md-12 col-lg-12 ">
                <div class="  col-md-6 col-md-6 col-lg-6 ">
                    <h3>MY ACOUNT:</h3>
                    <form class="form-signin" method="post" action="{{url('user/changedetailes')}}">
                        @csrf
                        <div class="form-group">
                            <input name="first_name" type="text" class="form-control" value="{{$user['first_name']}}"required >
                        </div>
                        <div class="form-group">
                            <input name="last_name" type="text" class="form-control" value="{{$user['last_name']}}" required >
                        </div>
                        <div>
                            <input name="submit" class="btn primary-btn pull-right" type="submit" value="SAVE CHANGES">
                        </div>
                    </form>
                    <form class="form-signin" method="post" action="{{url('user/changeemail')}}">
                        @csrf
                        <div class="form-group">
                            <input name="email" type="email" class="form-control"   value="{{$user['email']}}" required >
                        </div>
                        <div>
                            <input name="submit" class="btn primary-btn pull-right" type="submit" value="Update Email">
                        </div>
                    </form>
                </div>

                <div class="col-md-6 col-md-6 col-lg-6 ">
                    <h3 style=""><u><a class="change_password" onmouseover =" style = 'cursor: pointer;'">Change Password</a></u></h3>
                    <form class="form-signin" method="post" action="{{url('user/changepassword')}}">
                        @csrf
                        <div class="form-group">
                            <input class="form-control change_password_field" name="password" type="password" placeholder="Password" style="display: none;" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control change_password_field" name="password_confirmation" type="password" style="display: none;" placeholder="Confirm Password" required>
                        </div>
                        <div>
                            <input class="btn primary-btn pull-right save_change_password " name="submit" type="submit" style="display: none;" value="SAVE NEW PASSWORD">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-11 col-md-11 col-lg-11 ">
            </div>
            <div class="col-md-1 col-md-1 col-lg-1 ">
                <a onclick=" window.history.back();">
                    <input type="button" class="btn main-btn" value="Back"></a>
            </div>
        </div>
    </div>
</section>

@endsection('content')
