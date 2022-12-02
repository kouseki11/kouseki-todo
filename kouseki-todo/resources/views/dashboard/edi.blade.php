@extends('layouts.main')

@section('container')

<div class=" content d-flex justify-content-center" >  
    <form action="/update/{{ $todo['id'] }}" method="post" id="create-form" class="w-75">
        @csrf
        @method('PATCH')
        
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

      <h3>Edit Todo</h3>
      <fieldset>
          <label for="">Title</label>
          <input name="title" placeholder="title of todo" type="text" value="{{ $todo['title'] }}">
      </fieldset>
      <fieldset>
          <label for="">Target Date</label>
          <input name="date" placeholder="Target Date" type="date" value="{{ $todo['date'] }}">
      </fieldset>
      <fieldset>
          <label for="">Description</label>
          <textarea name="description" placeholder="Type your descriptions here..." tabindex="5">{{ $todo['description'] }}</textarea>
      </fieldset>
      <fieldset>
          <button type="submit" id="contactus-submit">Submit</button>
      </fieldset>
      <fieldset>
          <a href="/dashboard" class="btn-cancel btn-lg btn">Cancel</a>
      </fieldset>
    </form>
  </div>

@endsection