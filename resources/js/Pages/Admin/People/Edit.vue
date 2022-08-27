<template>
	<div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodaledit">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Modificar Persona</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="text-center" :class="{ 'col-md-12': img == '', 'col-md-4-animate': img != '' }">
								<input type="file" class="hidden"
								ref="photo"
								accept="image/png, image/bmp, image/jpg, image/jpeg"
								@change="updatePhotoPreview">
								<div class="m-2" v-show="! photoPreview">
									<img src="/img/profile.png" alt="Perfil Persona" class="m-auto d-flex avatar avatar-xxl rounded-circle shadow-lg">
								</div>
								<div class="m-2" v-show="photoPreview">
									<span class="m-auto d-flex avatar avatar-xxl rounded-circle shadow-lg" :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
									</span>
								</div>
								<button class="btn btn-secondary btn-round" type="button" @click.prevent="selectNewPhoto">Seleccionar</button>
								<div v-if="errors.profile_photo_path">
									<small class="error text-danger">{{ errors.profile_photo_path[0] }}</small>
								</div>
							</div>
							<transition name="fade">
								<div class="col-md-8 mx-auto" v-if="slide">
									<div class="form-group bmd-form-group shadow-lg">
										<cropper
										class="cropper"
										ref="cropper"
										:src="img"
										:stencil-props="{
											aspectRatio: 10/10
										}"
										@change="onChange"
										></cropper>
									</div>
								</div>
							</transition>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
									<label for="e_name">Nombre</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-user-edit"></i></span>
										<input type="text" class="form-control" id="e_name" placeholder="Nombre del integrante" v-model="form.name" @input="onChangeName">
									</div>
									<div v-if="errors.name">
										<small class="error text-danger">{{ errors.name[0] }}</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.surnames }">
									<label for="e_surnames">Apellidos</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-feather-alt"></i></span>
										<input type="text" class="form-control" id="e_surnames" placeholder="Apellidos del integrante" v-model="form.surnames" @input="onChangeName">
									</div>
									<div v-if="errors.surnames">
										<small class="error text-danger">{{ errors.surnames[0] }}</small>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.phone }">
									<label for="e_phone">Número de contacto</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-phone"></i></span>
										<input type="text" class="form-control" id="e_phone" placeholder="Número de contacto" v-model="form.phone">
									</div>
									<div v-if="errors.phone">
										<small class="error text-danger">{{ errors.phone[0] }}</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.neighborhood }">
									<label for="c_neighborhood">Barrio</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
										<input type="text" class="form-control" id="c_neighborhood" placeholder="Nombre del barrio" v-model="form.neighborhood">
									</div>
									<div v-if="errors.neighborhood">
										<small class="error text-danger">{{ errors.neighborhood[0] }}</small>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.streets }">
									<label for="c_streets">Calles</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-road"></i></span>
										<input type="text" class="form-control" id="c_streets" placeholder="Nombre de las calles" v-model="form.streets">
									</div>
									<div v-if="errors.streets">
										<small class="error text-danger">{{ errors.streets[0] }}</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.number }">
									<label for="c_number">Número del domicilio</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-door-closed"></i></span>
										<input type="number" class="form-control" id="c_number" placeholder="Número del domicilio" v-model="form.number">
									</div>
									<div v-if="errors.number">
										<small class="error text-danger">{{ errors.number[0] }}</small>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.type_id }">
									<label for="e_type_id">Tipo de Persona</label>
									<multiselect v-model="value" :options="types" placeholder="Seleccione un tipo de persona" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangeType" @remove="onRemoveType"></multiselect>
									<div v-if="errors.type_id">
										<small class="error text-danger">{{ errors.type_id[0] }}</small>
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
import { Cropper } from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';

export default {
	components: {
		Multiselect,
		Cropper,
	},

	props: ['types', 'data', 'reload', 'showNotification'],

	data() {
		return {
			person: [],
			form: {
				name: '',
				surnames: '',
				phone: '',
				neighborhood: '',
				streets: '',
				number: '',
				type_id: '',
				profile_photo_path: '',
			},
			value: '',
			img: '',
			slide: false,
			errors: {},
			photoPreview: null,
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
			axios.put(this.route('people.update', this.person.id), this.form)
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
			this.person = this.data;
			this.form.name = this.person.name;
			this.form.surnames = this.person.surnames;
			this.form.phone = this.person.phones[0].number;
			this.form.neighborhood = this.person.address.neighborhood;
			this.form.streets = this.person.address.streets;
			this.form.number = this.person.address.number;
			this.value = this.types.find( type => type.id === this.person.type_id );
			this.form.type_id = this.person.type_id;
			if (this.person.profile_photo_path) {
				this.photoPreview = this.person.profile_photo_path;
			} else {
				//this.photoPreview = this.person.profile_photo_url;
				this.photoPreview = '/img/profile.png';
			}
		},
		clear() {
			this.errors = {};
			this.form.name = '';
			this.form.surnames = '';
			this.form.phone = '';
			this.form.neighborhood = '';
			this.form.streets = '';
			this.form.number = '';
			this.value = '';
			this.form.type_id = '';
			this.photoPreview = null;
			this.img = '';
			this.slide = false;
			if (this.$refs.photo?.value) {
				this.$refs.photo.value = null;
				this.form.profile_photo_path = '';
			}
		},
		closeModal() {
			var ModalEdit = document.getElementById('ModalEdit')
			var modal = bootstrap.Modal.getInstance(ModalEdit)
			modal.hide();
		},
		onChangeName(){
			var i_name = this.form.name.charAt(0);
			var i_surnames = this.form.surnames.charAt(0);
			if (i_name == '' && i_surnames == '') {
				this.photoPreview = '/img/profile.png'
			} else if(this.img == '') {
				//this.photoPreview = 'https://ui-avatars.com/api/?name=' + i_name + ' ' + i_surnames + '&color=7F9CF5&background=EBF4FF';
				this.photoPreview = '/img/profile.png'
			}
		},
		selectNewPhoto() {
			this.$refs.photo.click();
		},
		updatePhotoPreview() {
			const reader = new FileReader();

			reader.onload = (e) => {
				//this.photoPreview = e.target.result;
				this.img = e.target.result;
				setTimeout(() => this.slide = true, 100);
			};

			reader.readAsDataURL(this.$refs.photo.files[0]);
		},
		onChangeType (value) {
			this.form.type_id = value.id;
		},
		onRemoveType (value) {
			this.form.type_id = '';
		},
		onChange({ coordinates, canvas, }) {
			this.photoPreview = canvas.toDataURL();
			this.form.profile_photo_path = canvas.toDataURL();
		},
	}
}
</script>