<template>
	<div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodaledit">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Modificar Rol</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
							<label for="e_name">Nombre</label>
							<input type="text" class="form-control" id="e_name" placeholder="Nombre de la categoría" v-model="form.name" autofocus>
							<div v-if="errors.name">
								<small class="error text-danger">{{ errors.name[0] }}</small>
							</div>
						</div>
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.permissions }">
							<label for="e_permissions">Permisos</label>
							<multiselect v-model="value" :options="permissions" placeholder="Seleccione los permisos" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="display_name" track-by="id" @select="onChangePermissions" @remove="onRemovePermissions" :multiple="true" :hideSelected="true" :close-on-select="false" :clearOnSelect="false"></multiselect>
							<div v-if="errors.permissions">
								<small class="error text-danger">{{ errors.permissions[0] }}</small>
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
	components: { Multiselect },

	props: ['permissions', 'data', 'reload', 'showNotification'],

	data() {
		return {
			role: [],
			form: {
				name: '',
				permissions: [],
			},
			errors: {},
			value: '',
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
			axios.put(this.route('roles.update', this.role.id), this.form)
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
			this.role = this.data;
			this.form.name = this.role.name;
			this.role.permissions.forEach(element => {
				this.form.permissions.push(element.id);
			});
			this.value = this.role.permissions;
		},
		clear() {
			this.errors = {};
			this.form.name = '';
			this.form.permissions = [];
			this.value = '';
		},
		closeModal() {
			var ModalEdit = document.getElementById('ModalEdit')
			var modal = bootstrap.Modal.getInstance(ModalEdit)
			modal.hide();
		},
		onChangePermissions (value) {
			if (Array.isArray(value)) {
				value.forEach(element => this.form.permissions.push(element.id));
			} else {
				this.form.permissions.push(value.id);
			}
		},
		onRemovePermissions (value) {
			if (Array.isArray(value)) {
				value.forEach(element => {
					var index = this.form.permissions.indexOf(element.id);
					if (index > -1) {
						this.form.permissions.splice(index, 1);
					}
				});
			} else {
				var index = this.form.permissions.indexOf(value.id);
				if (index > -1) {
					this.form.permissions.splice(index, 1);
				}
			}
		},
	}
}
</script>