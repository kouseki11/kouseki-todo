@extends('layouts.main')

@section('container')
<div class="d-flex  align-items-center vh-100 justify-content-center">
    <div class="col-md-4">
     <main class="form-signin w-100 mb-5">
            <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
            <form action="/login" method="POST">
              @csrf

              @if (session('notAllowed'))
              <script>
                  Swal.fire(
                  'Silahkan Login Terlebih Dahulu!',
                  '',
                  'warning'
                  )
              </script>
              @endif

                @if (session('success'))
                <script>
                    Swal.fire(
                    'Berhasil Register!',
                    'Silahkan Login!',
                    'success'
                    )
                </script>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="email">
                <label for="email">Email address</label>
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Password</label>
              </div>
          
              <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <small class="d-block text-center mt-3">Not registred? <a href="/register">Register Now!</a></small>
          </main>
    </div>
</div>

@endsection