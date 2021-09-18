<template>
	<div class="modal fade" id="ModalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodal">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Registrar Punto de Venta</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
							<label for="c_name">Nombre</label>
							<input type="text" class="form-control" id="c_name" placeholder="Nombre del punto de venta" v-model="form.name" autofocus>
							<div v-if="errors.name">
								<small class="error text-danger">{{ errors.name[0] }}</small>
							</div>
						</div>
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.direction }">
							<label for="c_direction">Dirección</label>
							<input type="text" class="form-control" id="c_direction" placeholder="Dirección del punto de venta" v-model="form.direction">
							<div v-if="errors.direction">
								<small class="error text-danger">{{ errors.direction[0] }}</small>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-bs-dismiss="modal" :disabled="disabled">Cancelar</button>
						<button type="submit" class="btn btn-cafe bg-gradient-cafe" :disabled="disabled">
							<span v-if="disabled">
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
								Procesando
							</span>
							<span v-else>
								Guardar
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>
<script>
export default {
	props: ['reload', 'showNotification'],

	data() {
		return {
			form: {
				name: '',
				direction: '',
			},
			errors: {},
			mensaje: '',
			disabled: false,
		}
	},

	mounted() {
		var ModalCreateHidden = document.getElementById('ModalCreate')
		ModalCreateHidden.addEventListener('hidden.bs.modal',this.clear);
	},

	methods: {
		async submit() {
			this.disabled = true;
			axios.post(this.route('points.store'), this.form)
			.then(response => {
				this.disabled = false;
				this.closeModal();
				this.reload();
				this.showNotification(response.data.message, response.data.type);
			})
			.catch(error => {
				this.disabled = false;
				if (error.response.data) {
					this.errors = error.response.data.errors;
				}
                if (error.response.status == 403) {
                    this.mensaje = 'Esta acción no está autorizada';
                    this.showNotification(this.mensaje, 'warning');
                    this.mensaje = '';
                }
            })
		},
		clear() {
			this.errors = {};
			this.form.name = '';
			this.form.direction = '';
		},
		closeModal() {
			var ModalCreate = document.getElementById('ModalCreate')
			var modal = bootstrap.Modal.getInstance(ModalCreate)
			modal.hide();
		}
	}
}
</script>