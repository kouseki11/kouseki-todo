@extends('layouts.crud')

@section('container')
	
	<div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="{{ asset('images/img-01.png') }}" alt="IMG">
			</div>

			<form action="/update/{{ $todo['id'] }}" method="post" class="contact1-form validate-form">
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

				<span class="contact1-form-title">
					Edit Todo
				</span>

				<div class="wrap-input1 validate-input">
					<input class="input1" type="text" name="title" placeholder="Title" value="{{ $todo['title'] }}">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input">
					<input class="input1" type="date" name="date" placeholder="Date" value="{{ $todo['date'] }}">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Message is required">
					<textarea class="input1" name="description" placeholder="Type your descriptions here..." tabindex="5">{{ $todo['description'] }}</textarea>
					<span class="shadow-input1"></span>
				</div>

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn">
						<span>
							Update Todo
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>
	
	@endsection