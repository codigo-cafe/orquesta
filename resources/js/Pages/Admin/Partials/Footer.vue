<template>
	<footer class="footer pt-3 pb-5">
		<div class="container-fluid">
			<div class="row align-items-center justify-content-lg-end">
				<div class="col-lg-12 mb-lg-0 mb-4">
					<div class="copyright text-center text-sm text-muted text-lg-left">
						© <span v-text="year"></span>
						desarrollado con <i class="fa fa-heart"></i> por
						<a href="https://api.whatsapp.com/send?phone=+59178249694&text=Hola%20😃" class="font-weight-bold text-dark text-gradient" target="_blank">Miguel Ángel Choque Ramírez</a>.
					</div>
				</div>
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