@extends('layouts.main')

@section('container')

{{-- <div class="wrapper bg-white shadow-lg" style="margin-top:80px;">
    <div class="d-flex align-items-start justify-content-between">
        <div class="d-flex flex-column">

            @if (session('success'))
                <script>
                    Swal.fire(
                    'Berhasil Login!',
                    '',
                    'success'
                    )
                </script>
                @endif
                
                @if (session('successAdd'))
                <script>
                    Swal.fire(
                    'Berhasil Mebambahkan Todo!',
                    '',
                    'success'
                    )
                </script>
                @endif

                @if (session('successUpdate'))
                <script>
                    Swal.fire(
                    'Berhasil Mengedit Todo!',
                    '',
                    'success'
                    )
                </script>
                @endif

                @if (session('successDel'))
                <script>
                    Swal.fire(
                    'Berhasil Menghapus Todo!',
                    '',
                    'success'
                    )
                </script>
                @endif
                
            <div class="h5">Completed Todo's</div>
            <p class="text-muted text-justify">
                Here's a list of activities you have to do
            </p>
            <br>
            <span>
                <a href="/dashboard">Uncompleted</a>
            </span>
        </div>
        <div class="info btn ml-md-4 ml-0">
            <span class="fas fa-info" title="Info"></span>
        </div>
    </div>
    
    <div class="work border-bottom pt-3">
        <div class="d-flex align-items-center py-2 mt-1">
            <div>
                <span class="text-muted fas fa-comment btn"></span>
            </div>
            <div class="text-muted">{{ $todos->count() }} Todos</div>
            <button class="ml-auto btn bg-white text-muted fas fa-angle-down" type="button" data-toggle="collapse"
                data-target="#comments" aria-expanded="false" aria-controls="comments"></button>
        </div>
    </div>

    @foreach ($todos as $todo)
    <div id="comments" class="mt-1">
        <div class="comment d-flex align-items-start justify-content-between">
            <div class="mr-2 d-flex">
                <label class="option">
                </label>
                <div class="d-flex flex-column">
                    <b class="text-justify">
                        {{ $todo->title }}
                    </b>
                    <p class="text-muted">{{ $todo->description }} </p>
                    <p class="text-muted">{{ $todo->status == 1 ? 'Completed' : 'On-Process' }} <span class="date">{!! date('M d, Y', strtotime($todo->date))!!}</span></p>
                    <div class="mt-2">
                        <form method="post" action="{{ route('delete', $todo->id) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><span>Delete</span></button>
                            <form action="/update/{{ $todo['id'] }}" method="post" id="create-form" class="w-75">
                                @csrf
                                <a href="{{ route('updateundo', $todo->id) }}" class="btn btn-primary">Undo</a>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div> --}}

@if (session('updated'))
    <script>
        Swal.fire(
        'Todo Dikembalikan!',
        'Silahkan cek Uncompleted',
        'success'
        )
    </script>
    @endif

<div class="container" style="margin-top:80px;">
    <div class="border-dark border-bottom d-flex justify-content-between">
        <p class="">{{ Auth::user()->username }} | {{ $todos->count() }} Todos Completed</p>
        <p class=""><a href="/dashboard" class="text-decoration-none" style="color: #6366f1">Uncompleted</a>|<a href="/completed" class="text-decoration-none" style="color: #0d9488">Completed</a></p>
    </div>
    @if ($todos->count())
    <br>
    <table class="table table-responsive-sm table-success table-striped table-bordered mt-5">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Selesai</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        @foreach ($todos as $todo)
        <tbody>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{!! date('j F, Y', strtotime($todo->done_time))!!}</td>
                    <td class="text-break" style="max-width: 400px; ">{{ $todo->description }}</td>
                    <td>{{ $todo->status == 1 ? 'Completed' : 'On-Process' }}</td>
                    <td><form method="post" action="{{ route('delete', $todo->id) }}" class="d-flex justify-content-center gap-1">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger"><span>Delete</span></button>
                        <form action="/update/{{ $todo['id'] }}" method="post" id="create-form" class="w-75">
                            @csrf
                            <a href="{{ route('updateundo', $todo->id) }}" class="btn btn-primary">Undo</a>
                        </form>
                    </td>
                </tr>
        </tbody>
        @endforeach
    </table>
    @else
    <p class="text-center fs-4 mt-5">No Todos Completed</p>
  @endif
</div>

@endsection