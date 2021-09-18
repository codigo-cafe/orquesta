<template>
	<div class="modal fade" id="ModalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodal">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Registrar Servicio</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
							<label for="c_name">Nombre</label>
							<input type="text" class="form-control" id="c_name" placeholder="Nombre del servicio" v-model="form.name" autofocus>
							<div v-if="errors.name">
								<small class="error text-danger">{{ errors.name[0] }}</small>
							</div>
						</div>
						<div class="form-group bmd-form-grou" :class="{ 'has-danger': errors.description }">
							<label for="c_description">Descripción</label>
							<textarea class="form-control" id="c_description" rows="3" v-model="form.description" placeholder="Breve descripción del servicio...">{{ form.description }}</textarea>
							<div v-if="errors.description">
								<small class="error text-danger">{{ errors.description[0] }}</small>
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
				description: '',
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
			axios.post(this.route('services.store'), this.form)
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
			this.form.description = '';
		},
		closeModal() {
			var ModalCreate = document.getElementById('ModalCreate')
			var modal = bootstrap.Modal.getInstance(ModalCreate)
			modal.hide();
		}
	}
}
</script>