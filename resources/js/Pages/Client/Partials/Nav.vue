<template>
	<nav class="navbar navbar-expand-lg bg-primary fixed-top">
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
							<inertia-link class="dropdown-item" :href="route('history')">Historia</inertia-link>
							<inertia-link class="dropdown-item" :href="route('members')">Integrantes</inertia-link>
							<inertia-link class="dropdown-item" :href="route('director')">Director</inertia-link>
							<inertia-link :href="route('gallery')" class="dropdown-item">
								Galería de fotos
							</inertia-link>
						</div>
					</li>
					<li class="nav-item">
						<inertia-link class="nav-link" :href="route('calendar')">Calendario</inertia-link>
					</li>
					<li class="nav-item">
						<inertia-link class="nav-link" :href="route('contact')">Contacto</inertia-link>
					</li>
					<!--
					<li class="nav-item">
						<a class="nav-link" rel="tooltip" title="Síguenos en Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
							<i class="fab fa-twitter"></i>
							<p class="d-lg-none d-xl-none">Twitter</p>
						</a>
					</li>
				-->
					<li class="nav-item">
						<a class="nav-link" rel="tooltip" title="Danos like en Facebook" data-placement="bottom" href="https://www.facebook.com/orquestavivalditarija/" target="_blank">
							<i class="fab fa-facebook-square"></i>
							<p class="d-lg-none d-xl-none">Facebook</p>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" rel="tooltip" title="Escríbenos al WhatsApp" data-placement="bottom" href="https://api.whatsapp.com/send?phone=59172962410&text=Hola...%20%F0%9F%98%8A" target="_blank">
							<i class="fab fa-whatsapp"></i>
							<p class="d-lg-none d-xl-none">WhatsApp</p>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-cafe" rel="tooltip" title="Solo para Administradores" data-placement="bottom" href="/login">
							<p><i class="fas fa-user"></i> Ingresar</p>
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