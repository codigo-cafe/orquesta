<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bienvenido</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
	<style>
	html * {
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
	}
	*, :after, :before {
		box-sizing: border-box;
	}
	body {
		font-weight: 400;
		line-height: 1.6;
	}

	body {
		margin: 0;
		font-family: var(--bs-font-sans-serif);
		font-size: 1rem;
		line-height: 1.5;
		color: #67748e;
		background-color: #fff;
		-webkit-text-size-adjust: 100%;
		-webkit-tap-highlight-color: rgba(0,0,0,0);
	}
	@media (min-width: 992px)
	.pt-lg-7 {
		padding-top: 6rem!important;
	}
	@media (min-width: 768px)
	.pb-md-5 {
		padding-bottom: 3rem!important;
	}
	@media (min-width: 768px)
	.pt-md-5 {
		padding-top: 3rem!important;
	}
	.bg-gray-200 {
		background-color: #e9ecef!important;
	}
	@media (min-width: 1400px)
	.container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
		max-width: 1320px;
	}
	@media (min-width: 1200px)
	.container, .container-lg, .container-md, .container-sm, .container-xl {
		max-width: 1140px;
	}
	@media (min-width: 992px)
	.container, .container-lg, .container-md, .container-sm {
		max-width: 960px;
	}
	@media (min-width: 768px)
	.container, .container-md, .container-sm {
		max-width: 720px;
	}
	@media (min-width: 576px)
	.container, .container-sm {
		max-width: 540px;
	}
	.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
		width: 100%;
		padding-right: var(--bs-gutter-x,1.5rem);
		padding-left: var(--bs-gutter-x,1.5rem);
		margin-right: auto;
		margin-left: auto;
	}
	.pb-5 {
		padding-bottom: 3rem!important;
	}
	.mx-auto {
		margin-right: auto!important;
		margin-left: auto!important;
	}
	@media (min-width: 992px)
	.col-lg-8 {
		flex: 0 0 auto;
		width: 66.666667%;
	}
	@media (min-width: 768px)
	.col-md-10 {
		flex: 0 0 auto;
		width: 83.333333%;
	}
	.card {
		box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
	}
	.shadow-lg {
		box-shadow: 0 8px 26px -4px hsla(0,0%,8%,.15),0 8px 9px -5px hsla(0,0%,8%,.06)!important;
	}
	.card {
		position: relative;
		display: flex;
		flex-direction: column;
		min-width: 0;
		word-wrap: break-word;
		background-color: #fff;
		background-clip: border-box;
		border: 0 solid rgba(0,0,0,.125);
		border-radius: 1rem;
	}
	.card .card-header {
		padding: 1.5rem;
	}
	.card-header:first-child {
		border-radius: 1rem 1rem 0 0;
	}
	.bg-gradient-dark {
		background-image: linear-gradient(
			310deg
			,#141727,#3a416f);
	}
	.p-5 {
		padding: 3rem!important;
	}
	.position-relative {
		position: relative!important;
	}
	.card-header {
		padding: .5rem 1rem;
		margin-bottom: 0;
		background-color: #fff;
		border-bottom: 0 solid rgba(0,0,0,.125);
		font-family: Open Sans;
		padding: 1.5rem;
	}
	@media (min-width: 1200px)
	.h3, h3 {
		font-size: 1.875rem;
	}
	.h3, h3 {
		font-size: calc(1.3125rem + .75vw);
	}
	.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
		margin-top: 0;
		margin-bottom: .5rem;
		font-weight: 400;
		line-height: 1.2;
		color: #344767;
	}
	.text-white {
		color: #fff!important;
	}
	.mb-0 {
		margin-bottom: 0!important;
	}
	.h1, .h2, .h3, .h4, h1, h2, h3, h4 {
		letter-spacing: -.05rem;
	}
	.h1, .h2, .h3, h1, h2, h3 {
		font-weight: 700;
	}
	.h3, h3 {
		font-size: 1.875rem;
		line-height: 1.375;
	}
	.opacity-8 {
		opacity: .8!important;
	}
	.text-white {
		color: #fff!important;
	}
	.mb-4 {
		margin-bottom: 1.5rem!important;
	}
	p {
		line-height: 1.625;
		font-weight: 400;
	}
	.p, p {
		font-size: 1rem;
	}
	.lead, .p, p {
		font-weight: 400;
	}
	.p, p {
		line-height: 1.6;
	}
	.z-index-1 {
		z-index: 1!important;
	}
	.ms-n5 {
		margin-left: -3rem!important;
	}
	.w-100 {
		width: 100%!important;
	}
	.bottom-0 {
		bottom: 0!important;
	}
	.position-absolute {
		position: absolute!important;
	}
	.waves {
		position: relative;
		width: 100%;
		height: 16vh;
		margin-bottom: -7px;
		min-height: 100px;
		max-height: 150px;
	}
	.card .card-body {
		font-family: Open Sans;
		padding: 1.5rem;
	}
	.pt-0 {
		padding-top: 0!important;
	}
	.p-5 {
		padding: 3rem!important;
	}
	.card-body {
		flex: 1 1 auto;
		padding: 1rem;
	}
	.mb-3 {
		margin-bottom: 1rem!important;
	}
	.mt-5 {
		margin-top: 3rem!important;
	}
	.h1, .h2, .h3, .h4, h1, h2, h3, h4 {
		letter-spacing: -.05rem;
	}
	.h4, .h5, .h6, h4, h5, h6 {
		font-weight: 600;
	}
	.h4, h4 {
		font-size: 1.5rem;
		line-height: 1.375;
	}
	.text-primary {
		color: #db0008!important;
	}
	a {
		letter-spacing: -.025rem;
		color: #344767;
	}
	a, a:hover {
		text-decoration: none;
	}
	a {
		color: #db0008;
	}
	.btn {
		display: inline-block;
		font-weight: 700;
		line-height: 1.4;
		color: #67748e;
		text-align: center;
		vertical-align: middle;
		cursor: pointer;
		user-select: none;
		background-color: transparent;
		border: 1px solid transparent;
		padding: 0.75rem 1.5rem;
		font-size: 0.75rem;
		border-radius: 0.5rem;
		transition: all 0.15s ease-in;
	}

	@media (prefers-reduced-motion: reduce) {
		.btn {
			transition: none;
		}
	}

	.btn:hover {
		color: #67748e;
	}

	.btn-check:focus+.btn,
	.btn:focus {
		outline: 0;
		box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.09), 0 2px 3px -1px rgba(0, 0, 0, 0.07);
	}

	.btn:disabled,
	.btn.disabled,
	fieldset:disabled .btn {
		pointer-events: none;
		opacity: 0.65;
	}

	.btn-primary {
		color: #fff;
		background-color: #252f40;
		border-color: #252f40;
	}

	.btn-primary:hover {
		color: #fff;
		background-color: #1f2836;
		border-color: #1e2633;
	}

	.btn-check:focus+.btn-primary,
	.btn-primary:focus {
		color: #fff;
		background-color: #1f2836;
		border-color: #1e2633;
		box-shadow: 0 0 0 0.2rem rgba(70, 78, 93, 0.5);
	}

	.btn-check:checked+.btn-primary,
	.btn-check:active+.btn-primary,
	.btn-primary:active,
	.btn-primary.active,
	.show>.btn-primary.dropdown-toggle {
		color: #fff;
		background-color: #1e2633;
		border-color: #1c2330;
	}

	.btn-check:checked+.btn-primary:focus,
	.btn-check:active+.btn-primary:focus,
	.btn-primary:active:focus,
	.btn-primary.active:focus,
	.show>.btn-primary.dropdown-toggle:focus {
		box-shadow: 0 0 0 0.2rem rgba(217, 217, 217, 0.5);
	}

	.btn-primary:disabled,
	.btn-primary.disabled {
		color: #fff;
		background-color: #252f40;
		border-color: #252f40;
	}

</style>
</head>
<body>
	<section class="pt-3 pt-md-5 pb-md-5 pt-lg-7 bg-gray-200">
		<div class="container">
			<div class="col-lg-8 col-md-10 mx-auto pb-5">
				<div class="card shadow-lg">
					<div class="card-header bg-gradient-dark p-5 position-relative">
						<h3 class="text-white mb-0">Hola {{ $user->person->name }} {{ $user->person->surnames }}</h3>
						<p class="text-white opacity-8 mb-4">Ya tienes Acceso al Sistema de la <strong>{{ config('app.name') }}</strong></p>
						<div class="position-absolute w-100 z-index-1 bottom-0 ms-n5">
							<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto" style="height:7vh;min-height:50px;">
								<defs>
									<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
								</defs>
								<g class="moving-waves">
									<use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
									<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
									<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
									<use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
									<use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
									<use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95"></use>
								</g>
							</svg>
						</div>
					</div>
					<div class="card-body p-5 pt-0">
						<h4 class="mt-5 mb-3">Bienvenida</h4>
						Si estas recibiendo este mensaje es porque fuiste asignado(a) como usuario del sistema de la <strong>{{ config('app.name') }}</strong>.
						<br>
						<h4 class="mt-5 mb-3">Credenciales</h4>
						<strong>Usuario</strong><br>
						<span>{{ $user->email }}</span><br><br>
						<strong>Contraseña</strong><br>
						<span>{{ $password }}</span>
						<br><br>
						La contraseña puede ser cambiada desde la página de acceso haciendo click en el enlace <strong>¿Olvidaste tu contraseña?</strong>.
						<br><br>

						<a class="btn btn-primary" href='http://orquesta.test/login'>INGRESAR</a>
						<br><br>

						Saludos, <br>
						<strong>{{ config('app.name') }}</strong>
						<br><br>

						Si tiene problemas para hacer clic en el botón "Ingresar", copie y pegue la siguiente URL en su navegador web: <span class="text-primary">http://orquesta.test/login</span>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>