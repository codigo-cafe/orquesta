<template>
	<div class="modal fade" id="ModalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodal">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Registrar Integrante</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="text-center" :class="{ 'col-md-12-animate': img == '', 'col-md-4-animate': img != '' }">
								<input type="file" class="hidden"
								ref="photo"
								accept="image/png, image/bmp, image/jpg, image/jpeg"
								@change="updatePhotoPreview">
								<div class="m-2" v-show="! photoPreview">
									<img src="/img/profile.png" alt="Perfil Integrante" class="m-auto d-flex avatar avatar-xxl rounded-circle shadow-lg">
								</div>
								<div class="m-2" v-show="photoPreview">
									<span class="m-auto d-flex avatar avatar-xxl rounded-circle shadow-lg" :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
									</span>
								</div>
							</div>
							<transition name="fade">
								<div class="col-md-8 mx-auto" v-if="slide">
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
						<div class="row">
							<div class="col-md-12">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.person_id }">
									<label for="c_person_id">Persona</label>
									<multiselect v-model="valuePerson" :options="people" placeholder="Seleccione una persona" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangePerson" @remove="onRemovePerson" :custom-label="nameAndSurnames">
									</multiselect>
									<div v-if="errors.person_id">
										<small class="error text-danger">{{ errors.person_id[0] }}</small>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.instrument_id }">
									<label for="c_instrument_id">Instrumento</label>
									<multiselect v-model="valueInstrument" :options="instruments" placeholder="Seleccione un instrumento" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangeInstrument" @remove="onRemoveInstrument">
									</multiselect>
									<div v-if="errors.instrument_id">
										<small class="error text-danger">{{ errors.instrument_id[0] }}</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-bs-dismiss="modal" :disabled="disabled">Cancelar</button>
						<button type="submit" class="btn bg-gradient-cafe" :disabled="disabled">
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

	props: ['people', 'instruments', 'reload', 'showNotification'],

	data() {
		return {
			form: {
				person_id: '',
				instrument_id: '',
			},
			valuePerson: '',
			valueInstrument: '',
			img: '',
			slide: false,
			errors: {},
			name: '',
			surnames: '',
			phone: '',
			neighborhood: '',
			streets: '',
			number: '',
			photoPreview: null,
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
			axios.post(this.route('members.store'), this.form)
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
		nameAndSurnames ({ name, surnames }) {
			return `${name} ${surnames}`
		},
		clear() {
			this.errors = {};
			this.valuePerson = '';
			this.valueInstrument = '';
			this.form.person_id = '';
			this.form.instrument_id = '';
			this.photoPreview = null;
			this.img = '';
			this.slide = false;
			if (this.$refs.photo?.value) {
				this.$refs.photo.value = null;
				this.form.profile_photo_path = '';
			}
		},
		closeModal() {
			var ModalCreate = document.getElementById('ModalCreate')
			var modal = bootstrap.Modal.getInstance(ModalCreate)
			modal.hide();
		},
		onChangePerson (value) {
			this.form.person_id = value.id;
			this.name = value.name;
			this.surnames = value.surnames;
			this.phone = value.phones[0].number;
			this.neighborhood = value.address.neighborhood;
			this.streets = value.address.streets;
			this.number = value.address.number;
			if (value.profile_photo_path) {
				this.photoPreview = value.profile_photo_path;
				this.img = value.profile_photo_path;
			} else {
				//this.photoPreview = value.profile_photo_url;
				//this.img = value.profile_photo_url;
				this.photoPreview = '/img/profile.png';
				this.img = '/img/profile.png';
			}
			setTimeout(() => {
				this.slide = true;
			}, 500);
		},
		onRemovePerson (value) {
			this.form.person_id = '';
			this.name = '';
			this.surnames = '';
			this.phone = '';
			this.neighborhood = '';
			this.streets = '';
			this.number = '';
			setTimeout(() => {
				this.img = '';
			}, 500);
			this.slide = false;
			this.photoPreview = '/img/profile.png';
		},
		onChangeInstrument (value) {
			this.form.instrument_id = value.id;
		},
		onRemoveInstrument (value) {
			this.form.instrument_id = '';
		},
	}
};
</script>