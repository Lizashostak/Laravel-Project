@extends('master')
@section('content')

<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-md-6">
                    <form method="POST" action="{{url('user/signin')}}">
                        @csrf
                        <div class="form-group">
                            <label class="pull-left" for="InputEmail1">Email Address:</label>
                            <input name="email" type="email"  class="form-control" placeholder="Enter email" autofocus required>
                        </div>
                        <div class="form-group">
                            <label  class="pull-left" for="InputPassword">Password:</label>
                            <input name="password" type="password" class="form-control" placeholder="Password" required>
                        </div>
                        <input name="submit" class="btn primary-btn pull-right" type="submit"value="LOG IN &#10143">
                    </form>
                </div>
                <br>
                <br>
                <div class="col col-md-6">
                    <h3>NEW CUSTOMER?</h3>
                    <a href="{{url('/user/signup')}}"class="main-btn">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection('content')
