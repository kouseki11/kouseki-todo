@extends('layouts.main')

@section('container')

<div class="d-flex  align-items-center vh-100 justify-content-center">
    <div class="col-lg-5">
        <main class="form-registration w-100 mb-5">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
            <form action="{{ route('registerAccount') }}" method="post">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
                @csrf
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top" id="name" placeholder="Name">
                <label for="name">Name</label>     
            </div>
              <div class="form-floating">
                <input type="text" name="username" class="form-control" id="username" placeholder="username">
                <label for="username">Username</label>
              </div>

              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
              </div>

              <div class="form-floating">
                <input type="password" name="password" class="form-control rounded-bottom" id="password" placeholder="Password">
                <label for="password">Password</label>
              </div>
          
              <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Sign Up</button>
            </form>
            <small class="d-block text-center mt-3">Already registred? <a href="/">Login</a></small>
          </main>
    </div>
</div>

@endsection