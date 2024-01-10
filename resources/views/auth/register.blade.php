@extends('auth.layouts.css')
@section('contents')

<section id="header">
	<div class="container">
		<main id="main">

			<div class="row">
				<div class="col-md-6" id="sign-img">
					<p>

						<img src="{{asset('assets/img/pos-animation-2.gif')}}" alt="">
					</p>
				</div>
				<div class="col-md-6">
					<div id="form">
						<div>

							<h2 class="text-center">Sign Up</h2>
							<form method="POST" class="needs-validation" novalidate action="{{ route('register') }}">
								@csrf
								<div class="row text-center">

									<div class="form-group mb-3">
										<input id="name" type="text" placeholder="First Name"
											class="form-control @error('name') is-invalid @enderror" name="name"
											value="{{ old('name') }}" required autocomplete="name" autofocus>

										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror

									</div>
									<div class="form-group mb-3">
										<input id="lase-name" type="text" placeholder="Last Name"
											class="form-control @error('last-name') is-invalid @enderror"
											name="lastName" value="{{ old('lase-name') }}" required autocomplete="name"
											autofocus>

										@error('last-name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror

									</div>
									<div class="form-group mb-3">
										<input type="text" onkeyup="chikeUsername(event)"
											class="form-control @error('userName') is-invalid @enderror"
											value="{{ old('userName') }}" name="userName" placeholder="User Name">

										@error('username')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="form-group mb-3" id="usernameMessage">

									</div>


									<div class="form-group">
										<select name="currencies" class="form-control" id="currencies">
											@foreach ($currency as $recored)

											<option value="{{ $recored->id }}">{{ $recored->country }}</option>
											@endforeach

										</select>
									</div>
									<div class="form-group mb-3">
										<input id="email" type="email" placeholder="Email"
											class="form-control @error('email') is-invalid @enderror" name="email"
											value="{{ old('email') }}" required autocomplete="email">

										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group mb-3">
										<input id="password" type="password" placeholder="Password"
											class="form-control @error('password') is-invalid @enderror" name="password"
											required autocomplete="new-password">

										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group mb-3">
										<input id="password-confirm" type="password" placeholder="Password-confirm"
											class="form-control" name="password_confirmation" required
											autocomplete="new-password">

									</div>
									<div class="row">
										<div class="col-12">
											<button type="submit" class="btn btn-default btn-block">Register</button>
										</div>
									</div>
									@if (Route::has('password.request'))
									<a class="btn" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
									@endif
									<br>
									<a href="/login" class="btn">I have already account!</a>
		
									@endsection
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</section>
<!-- [ auth-signup ] end -->



<script>

	function chikeUsername(event) {
		let username = event.target.value;
		$.ajax({
			url: '/checkUsername',
			method: 'GET',
			data: {
				_token: "{{ csrf_token() }}",
				username: username
			},
			success: function (result) {
				if (!result) {
					try {
						worningMessage.remove()
					} catch (e) {
					}

				} else {
					usernameMessage.innerHTML = `<strong style="color:red" id="worningMessage">${username} username is already exist</ strong>`
				}
			}
		})
	}

</script>



</body>

</html>