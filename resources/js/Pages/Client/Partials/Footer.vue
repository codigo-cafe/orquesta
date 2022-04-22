<template>
	<footer class="footer footer-default">
		<div class="container">
			<nav>
				<ul>
					<li>
						<inertia-link :href="route('home')">
							Inicio
						</inertia-link>
					</li>
					<li>
						<inertia-link :href="route('calendar')">
							Calendario
						</inertia-link>
					</li>
					<li>
						<inertia-link :href="route('contact')">
							Contacto
						</inertia-link>
					</li>
				</ul>
			</nav>
			<div class="copyright" id="copyright">
				Copyright © <span v-text="year"></span>, desarrollado con <i class="fas fa-heart"></i> por <a href="https://api.whatsapp.com/send?phone=+59178249694&text=Hola%20😃" class="font-weight-bold text-dark text-gradient" target="_blank">Miguel Ángel Choque Ramírez</a>.
			</div>
		</div>
	</footer>
</template>
<script>
	export default {
		data() {
            return {
                year: new Date().getFullYear(),
            }
        },
	}
</script>