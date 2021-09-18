<template>
	<footer class="footer footer-default">
		<div class="container">
			<nav>
				<ul>
					<li>
						<a href="https://www.creative-tim.com">
							Creative Tim
						</a>
					</li>
					<li>
						<a href="http://presentation.creative-tim.com">
							About Us
						</a>
					</li>
					<li>
						<a href="http://blog.creative-tim.com">
							Blog
						</a>
					</li>
				</ul>
			</nav>
			<div class="copyright" id="copyright">
				Copyright © <span v-text="year"></span>, desarrollado con <i class="fas fa-heart"></i> por <a href="https://api.whatsapp.com/send?phone=+59178249694&text=Hola,%20vengo%20desde%20la%20página%20de%20la%20*Orquesta%20Vivaldi%20Tarija*%20😃" class="font-weight-bold text-dark text-gradient" target="_blank">Miguel Ángel Choque Ramírez</a>.
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