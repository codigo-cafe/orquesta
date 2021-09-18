<template>
	<div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodaledit">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Modificar Instrumento</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
							<label for="e_name">Nombre</label>
							<input type="text" class="form-control" id="e_name" placeholder="Nombre del instrumento" v-model="form.name" autofocus>
							<div v-if="errors.name">
								<small class="error text-danger">{{ errors.name[0] }}</small>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.classification_id }">
									<label for="e_classification_id">Clasificación</label>
									<multiselect v-model="value" :options="classifications" placeholder="Seleccione una clasificación" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangeClassification" @remove="onRemoveClassification"></multiselect>
									<div v-if="errors.classification_id">
										<small class="error text-danger">{{ errors.classification_id[0] }}</small>
									</div>
								</div>
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
import Multiselect from 'vue-multiselect';
export default {
	props: ['data', 'reload', 'showNotification', 'classifications'],

	components: {
		Multiselect,
	},

	data() {
		return {
			instrument: [],
			form: {
				name: '',
				classification_id: '',
			},
			value: '',
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
			axios.put(this.route('instruments.update', this.instrument.id), this.form)
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
			this.instrument = this.data;
			this.form.name = this.instrument.name;
			this.value = this.classifications.find( classification => classification.id === this.instrument.classification_id );
			this.form.classification_id = this.instrument.classification_id;
		},
		clear() {
			this.errors = {};
			this.form.name = '';
			this.value = '';
			this.form.classification_id = '';
		},
		closeModal() {
			var ModalEdit = document.getElementById('ModalEdit')
			var modal = bootstrap.Modal.getInstance(ModalEdit)
			modal.hide();
		},
		onChangeClassification (value) {
			this.form.classification_id = value.id;
		},
		onRemoveClassification (value) {
			this.form.classification_id = '';
		},
	}
}
</script>