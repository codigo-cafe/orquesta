<template>
	<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="250">
		<div class="container">
			<div class="navbar-translate">
				<inertia-link class="navbar-brand" :href="route('home')" rel="tooltip" title="Orquesta Vivaldi Tarija" data-placement="bottom" target="_blank">
					Orquesta Vivaldi Tarija
				</inertia-link>
				<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-bar top-bar"></span>
					<span class="navbar-toggler-bar middle-bar"></span>
					<span class="navbar-toggler-bar bottom-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="/img/blurred-image-1.jpg">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Tu Sinfónica
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="#">Historia</a>
							<a class="dropdown-item" href="#">Integrantes</a>
							<a class="dropdown-item" href="#">Director</a>
							<inertia-link :href="route('gallery')" class="dropdown-item">
								Galería de fotos
							</inertia-link>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../index.html">Calendario</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://github.com/creativetimofficial/now-ui-kit/issues">Programas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://github.com/creativetimofficial/now-ui-kit/issues">Contacto</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
							<i class="fab fa-twitter"></i>
							<p class="d-lg-none d-xl-none">Twitter</p>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
							<i class="fab fa-facebook-square"></i>
							<p class="d-lg-none d-xl-none">Facebook</p>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
							<i class="fab fa-instagram"></i>
							<p class="d-lg-none d-xl-none">Instagram</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>
<script>
	export default {

	}
</script>