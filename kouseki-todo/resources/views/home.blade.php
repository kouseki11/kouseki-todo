@extends('layouts.main')

@section('container')

@if (session('notAllowed'))
<script>
    Swal.fire(
    'Kamu sudah Login!',
    '',
    'warning'
    )
</script>
@endif

<div class="container" style="margin-top:100px;">
<h1>Halaman {{ $title }}</h1>
</div>

@endsection
