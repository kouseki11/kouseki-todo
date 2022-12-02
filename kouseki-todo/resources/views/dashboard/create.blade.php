@extends('layouts.crud')

@section('container')
	
	<div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="{{ asset('images/img-01.png') }}" alt="IMG">
			</div>

			<form action="/create/store" method="post" class="contact1-form validate-form">
				@csrf

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
					Create Todo
				</span>

				<div class="wrap-input1 validate-input">
					<input class="input1" type="text" name="title" placeholder="Title">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input">
					<input class="input1" type="date" name="date" placeholder="Date">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Message is required">
					<textarea class="input1" name="description" placeholder="Type your descriptions here..." tabindex="5"></textarea>
					<span class="shadow-input1"></span>
				</div>

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn">
						<span>
							Create Todo
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>
	
	@endsection