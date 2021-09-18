<template>
	<div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodaledit">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Modificar Tipo de Persona</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
							<label for="e_name">Nombre</label>
							<input type="text" class="form-control" id="e_name" placeholder="Nombre del tipo de persona" v-model="form.name" autofocus>
							<div v-if="errors.name">
								<small class="error text-danger">{{ errors.name[0] }}</small>
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
	props: ['data', 'reload', 'showNotification'],

	data() {
		return {
			type: [],
			form: {
				name: ''
			},
			errors: {},
			mensaje: '',
			disabled: false,
		}
	},

	mounted() {
		var ModalEditHidden = document.getElementById('ModalEdit')
		ModalEditHidden.addEventListener('hidden.bs.modal',this.clear);
		ModalEditHidden.addEventListener('show.bs.modal',this.fill);
	},

	methods: {
		async submit() {
			this.disabled = true;
			axios.put(this.route('types.update', this.type.id), this.form)
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
		fill() {
			this.type = this.data;
			this.form.name = this.type.name;
		},
		clear() {
			this.errors = {};
			this.form.name = '';
		},
		closeModal() {
			var ModalEdit = document.getElementById('ModalEdit')
			var modal = bootstrap.Modal.getInstance(ModalEdit)
			modal.hide();
		}
	}
}
</script>