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
							<h2 class="text-center text-white">Login</h2>
							<form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="row text-center">

									<div class="form-group">

										<input id="username" placeholder="Email" value="admin" type="text"
											class="form-control @error('username') is-invalid @enderror" name="username"
											value="{{ old('email') }}" required autocomplete="email" autofocus>

										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="form-group">

										<input id="password" placeholder="Password" value="12345678" type="password"
											class="form-control @error('password') is-invalid @enderror" name="password"
											required autocomplete="current-password">

										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="form-group">
										<div class="form-check text-left">
											<input class="form-check-input" type="checkbox" name="remember"
												id="remember" {{ old('remember') ? 'checked' : '' }}>

											<label class="form-check-label" for="remember">
												{{ __('Remember Me') }}
											</label>
										</div>
									</div>

									<div class="form-group ">
										<button type="submit" class="btn btn-default col-md-12">
											{{ __('Login') }}
										</button>

									</div>
									@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
									@endif
									<br>
									@if (Route::has('register'))
									<a href="{{ route('register') }}" class="btn btn-link">Create account!</a>
									@endif
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</section>


@endsection

</body>

</html>