@extends('layouts.master')

@section('page_title')
Reset your password for Electric Autos
@endsection

@section('metas')
<meta name="description" value="Create an account and login to Electric Autos to manage your car adverts" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Create an account and login to Electric Autos to manage your car adverts." />
<meta name="og:title" value="Login to Electric Autos" />
<meta name="twitter:description" value="Create an account and login to Electric Autos to manage your car adverts" />
<meta name="twitter:title" value="Login to Electric Autos" />
@endsection

@section('content')

<section class="main">

    <div class="container">

        <div class="row">

            <div class="col-sm-12 col-md-12">

                <div class="row">

                    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                        <div class="box login">

                            <div class="login-description text-center">
                                Reset Password
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @include('partials.errors')

                            <form action="{{ url('/password/email') }}" method="POST" class="form" role="form">
                                {{ csrf_field() }}

                                <div class="form-group">

                                    <div class="group-control">

                                        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required="" aria-required="true" autofocus="">
                                    </div>
                                </div>

                                <div class="form-group text-right">

                                    <button type="submit" class="btn btn-success">Send reset link</button>

                                </div>

                            </form>

                        </div>

                        <div class="form-links">

                            <ul>
                                <li><a href="{{ route('register') }}">Don't have an account?</a></li>
                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection