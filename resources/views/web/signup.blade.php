
@extends('master')
@section('content')

<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-md-6">
                    <h3>Join Us:</h3>
                    <form class="form-signin" method="post" action="{{url('user/signup')}}">
                        @csrf
                        <div class="form-group">
                            <input name="first_name" type="text" class="form-control" placeholder="First Name" required autofocus>
                        </div>
                        <div class="form-group">
                            <input name="last_name" type="text" class="form-control" placeholder="Last Name" required autofocus>
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" class="form-control"  placeholder="Enter Your Email Adress">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <input name="submit" class="btn primary-btn pull-right" type="submit"value="Sign Up &#10143">
                    </form>
                </div>

                <br>
                <br>
                <div class="col col-md-6">
                    <h3>Already Have An Account?</h3>
                    <a href="{{url('/user/signin')}}"class="main-btn">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection('content')
