<template>
	<div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodaledit">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Modificar Usuario</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="text-center col-md-4">
								<div class="m-2">
									<img :src="photoPreview" alt="Perfil Integrante" class="m-auto d-flex avatar avatar-xxl rounded-circle shadow-lg">
								</div>
							</div>
							<transition name="fade">
								<div class="col-md-8 mx-auto">
									<ul class="list-group">
										<li class="list-group-item border-0 ps-0 pt-0 text-sm">
											<strong class="text-dark">Nombre y Apellidos:</strong> &nbsp; {{ name }} {{ surnames }}
										</li>
										<li class="list-group-item border-0 ps-0 text-sm">
											<strong class="text-dark">Número de contacto:</strong> &nbsp; {{ phone }}
										</li>
										<li class="list-group-item border-0 ps-0 text-sm">
											<strong class="text-dark">Barrio:</strong> &nbsp; {{ neighborhood }}
										</li>
										<li class="list-group-item border-0 ps-0 text-sm">
											<strong class="text-dark">Calles:</strong> &nbsp; {{ streets }}
										</li>
										<li class="list-group-item border-0 ps-0 pb-0">
											<strong class="text-dark text-sm">Número de domicilio:</strong> &nbsp; {{ number }}
										</li>
									</ul>
								</div>
							</transition>
						</div>
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.email }">
							<label for="e_email">Email</label>
							<div class="input-group">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
								<input type="text" class="form-control" id="e_email" placeholder="Correo Electrónico" v-model="form.email">
							</div>
							<div v-if="errors.email">
								<small class="error text-danger">{{ errors.email[0] }}</small>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.role_id }">
									<label for="e_rol">Rol</label>
									<multiselect v-model="valueRole" :options="roles" placeholder="Seleccione un rol" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangeRole" @remove="onRemoveRole"></multiselect>
									<div v-if="errors.role_id">
										<small class="error text-danger">{{ errors.role_id[0] }}</small>
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
	components: {
		Multiselect,
	},

	props: ['roles', 'data', 'reload', 'showNotification'],

	data() {
		return {
			user: [],
			form: {
				email: '',
				role_id: '',
			},
			errors: {},
			valueRole: '',
			img: '',
			slide: false,
			errors: {},
			name: '',
			surnames: '',
			phone: '',
			neighborhood: '',
			streets: '',
			number: '',
			photoPreview: '',
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
			axios.put(this.route('users.update', this.user.id), this.form)
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
			this.user = this.data;
			this.name = this.user.person.name;
			this.surnames = this.user.person.surnames;
			this.phone = this.user.person.phones[0].number;
			this.neighborhood = this.user.person.address.neighborhood;
			this.streets = this.user.person.address.streets;
			this.number = this.user.person.address.number;
			if (this.user.person.profile_photo_path) {
				this.photoPreview = this.user.person.profile_photo_path;
				this.img = this.user.person.profile_photo_path;
			} else {
				//this.photoPreview = this.user.person.profile_photo_url;
				//this.img = this.user.person.profile_photo_url;
				this.photoPreview = '/img/profile.png';
				this.img = '/img/profile.png';
			}

			this.form.email = this.user.email;
			this.valueRole = this.roles.find( role => role.id === this.user.roles[0].id );
			this.form.role_id = this.user.roles[0].id;
		},
		clear() {
			this.errors = {};
			this.form.person_id = '';
			this.name = '';
			this.surnames = '';
			this.phone = '';
			this.neighborhood = '';
			this.streets = '';
			this.number = '';
			this.valueRole = '';
			this.photoPreview = '/img/profile.png';
		},
		closeModal() {
			var ModalEdit = document.getElementById('ModalEdit')
			var modal = bootstrap.Modal.getInstance(ModalEdit)
			modal.hide();
		},
		onChange(){
			var i_name = this.form.name.charAt(0);
			var i_surnames = this.form.surnames.charAt(0);
			//this.photo = 'https://ui-avatars.com/api/?name=' + i_name + ' ' + i_surnames + '&color=7F9CF5&background=EBF4FF';
			this.photo = '/img/profile.png';
		},
		onChangeRole (value) {
			this.form.role_id = value.id;
		},
		onRemoveRole (value) {
			this.form.role_id = '';
		},
	}
}
</script>