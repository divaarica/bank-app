<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('Admin/img/icons/icon-48x48.png') }}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In | AdminKit Demo</title>

	<link href="{{ asset('Admin/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<!-- <a href="#"  style="text-decoration: none;">&larr; Retour vers l'acceuil</a>
						<br>
						<br> -->

						<div class="text-center mt-4">
							<h1 class="h2">Bienvenue!</h1>
							<p class="lead">
								Connectez vous a voute compte pour continuer
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								@if($errors->has('error'))
								<div class="text-danger">
									{{ $errors->first('error') }}
								</div>
								<br>
								@endif
								<div class="m-sm-3">
									<form action="{{ route('auth.login') }}" method="POST">
										@csrf
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value="{{ old('email') }} " />
											@error('email')
											<p class="alert alert-danger">{{ $message }}</p>
											@enderror
										</div>
										<!-- <div class="mb-3">
											<label class="form-label">Numero Client</label>
											<input class="form-control form-control-lg" type="numero" name="numero" value="{{ old('numero') }} "/>
											@error('numero')
											<p class="alert alert-danger">{{ $message }}</p>
											@enderror
										</div> -->
										<div class="mb-3">
											<label class="form-label">Mot de passe</label>
											<input class="form-control form-control-lg" type="password" name="password" />
											@error('password')
											<p class="alert alert-danger">{{ $message }}</p>
											@enderror
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Se connecter</button>
										</div>
									</form>
								</div>
								<br>
								<div class="text-center mb-3">

								<a class="float-end" href="{{ route('auth.forgotPasswordForm') }}">Mot de passe oublie ?</a>

							</div>
							</div>
							
						</div>
						<div class="text-center mb-3">
							<a href="{{ route('accueil.index') }}">&larr; Retour vers l'acceuil</a>

						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{ asset('Admin/js/app.js') }}"></script>

</body>

</html>