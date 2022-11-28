<template>
	<div class="modal fade" id="ModalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodal">
		<div class="modal-dialog modal-lg" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Registrar Evento</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
									<label for="c_name">Nombre</label>
									<input type="text" class="form-control" id="c_name" placeholder="Nombre del evento" v-model="form.name" autofocus>
									<div v-if="errors.name">
										<small class="error text-danger">{{ errors.name[0] }}</small>
									</div>
								</div>
								<div class="form-group bmd-form-grou" :class="{ 'has-danger': errors.description }">
									<label for="c_description">Descripción</label>
									<textarea class="form-control" id="c_description" rows="5" placeholder="Breve descripción del evento..." v-model="form.description">{{ form.description }}</textarea>
									<div v-if="errors.description">
										<small class="error text-danger">{{ errors.description[0] }}</small>
									</div>
								</div>
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.cover }">
									<label for="e_cover">Imagen de Portada</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-image"></i></span>
										<input type="file" ref="cover" class="form-control" @input="form.cover = $event.target.files[0]">
									</div>
									<div v-if="errors.cover">
										<small class="error text-danger">{{ errors.cover[0] }}</small>
									</div>
								</div>
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.price }">
									<label for="c_price">Precio</label>
									<div class="input-group">
										<span class="input-group-text">Bs</span>
										<input type="number" min="0" class="form-control" id="c_price" placeholder="Precio de la entrada" v-model="form.price">
									</div>
									<div v-if="errors.price">
										<small class="error text-danger">{{ errors.price[0] }}</small>
									</div>
								</div>
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.place }">
									<label for="c_place">Lugar</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
										<input type="text" class="form-control" id="c_place" placeholder="Lugar del evento" v-model="form.place">
									</div>
									<div v-if="errors.place">
										<small class="error text-danger">{{ errors.place[0] }}</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.date }">
									<label for="c_date">Fecha</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-calendar"></i></span>
										<flat-pickr
										v-model="selectdate"
										:config="configDate"
										class="form-control"
										placeholder="Seleccione una fecha"
										@on-change="onChangeDate"
										name="date"/>
									</div>
									<div v-if="errors.date">
										<small class="error text-danger">{{ errors.date[0] }}</small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" :class="{ 'has-danger': errors.start_time }">
											<label for="c_start_time" class="form-control-label">Hora de Inicio</label>
											<input class="form-control" type="time" id="c_start_time" v-model="form.start_time">
											<div v-if="errors.start_time">
												<small class="error text-danger">{{ errors.start_time[0] }}</small>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" :class="{ 'has-danger': errors.end_time }">
											<label for="c_end_time" class="form-control-label">Hora de Finalización</label>
											<input class="form-control" type="time" id="c_end_time" v-model="form.end_time">
											<div v-if="errors.end_time">
												<small class="error text-danger">{{ errors.end_time[0] }}</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.category_id }">
									<label for="c_category">Categoría</label>
									<multiselect v-model="valueCategory" :options="categories" placeholder="Seleccione una categoría" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangeCategory" @remove="onRemoveCategory"></multiselect>
									<div v-if="errors.category_id">
										<small class="error text-danger">{{ errors.category_id[0] }}</small>
									</div>
								</div>
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.promotion_id }">
									<label for="c_promotion">Promoción</label>
									<multiselect v-model="valuePromotion" :options="promotions" placeholder="Seleccione una promoción" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangePromotion" @remove="onRemovePromotion" :custom-label="nameAndDiscount"></multiselect>
									<div v-if="errors.promotion_id">
										<small class="error text-danger">{{ errors.promotion_id[0] }}</small>
									</div>
								</div>
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.people }">
									<label for="c_people">Contactos</label>
									<multiselect v-model="valuePerson" :options="people" placeholder="Seleccione los contactos" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangePeople" @remove="onRemovePeople" :custom-label="nameAndSurnames" :multiple="true" :hideSelected="true" :close-on-select="false" :clearOnSelect="false">
									</multiselect>
									<div v-if="errors.people">
										<small class="error text-danger">{{ errors.people[0] }}</small>
									</div>
								</div>
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.points }">
									<label for="c_points">Puntos de Venta</label>
									<multiselect v-model="valuePoint" :options="points" placeholder="Seleccione los puntos de ventas" selectLabel="Presione para seleccionar" deselectLabel="Presione para deseleccionar" selectedLabel="Seleccionado" label="name" track-by="id" @select="onChangePoints" @remove="onRemovePoints" :multiple="true" :hideSelected="true" :close-on-select="false" :clearOnSelect="false">
									</multiselect>
									<div v-if="errors.points">
										<small class="error text-danger">{{ errors.points[0] }}</small>
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
							<span>
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
import flatPickr from 'vue-flatpickr-component';
import {Spanish} from 'flatpickr/dist/l10n/es.js';
import 'flatpickr/dist/flatpickr.css';
import Multiselect from 'vue-multiselect';
import moment from 'moment';

export default {
	props: ['categories', 'promotions', 'points', 'people', 'selectdate', 'reload', 'showNotification'],

	components: {
		flatPickr,
		Multiselect,
	},

	data() {
		return {
			form: {
				name: '',
				description: '',
            	cover: null,
            	price: '',
				date: '',
            	start_time: '',
            	end_time: '',
            	place: '',
            	category_id: '',
            	promotion_id: '',
            	people: [],
            	points: [],
			},
			configDate: {
                wrap: true,
                altFormat: 'j M, Y',
                altInput: true,
                dateFormat: 'd/m/Y',
                locale: Spanish,
            },
            valueCategory: '',
            valuePromotion: '',
            valuePerson: [],
            valuePoint: [],
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
			let data = new FormData;
			if (this.form.cover) {
				data.append('cover', this.form.cover);
			}
			data.append('name', this.form.name);
			data.append('description', this.form.description);
			data.append('price', this.form.price);
			console.log('fecha = ' + this.form.date)
			if (typeof this.form.date !== "undefined") {
				data.append('date', moment(this.form.date).format('DD/MM/YYYY'));
			} else {
				data.append('date', '');
			}
			data.append('start_time', this.form.start_time);
			data.append('end_time', this.form.end_time);
			data.append('place', this.form.place);
			data.append('category_id', this.form.category_id);
			data.append('promotion_id', this.form.promotion_id);
			data.append('people', this.form.people);
			data.append('points', this.form.points);
			//console.log(moment(this.form.date).format('DD/MM/YYYY'))

			axios.post(this.route('events.store'), data)
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
		nameAndSurnames ({ name, surnames, phones }) {
			return `${name}  ${surnames} ${phones[0].number}`
		},
		nameAndDiscount ({ name, discount }) {
			return `${name} -${discount} Bs`
		},
		clear() {
			this.errors = {};
			this.form.name = '';
			this.form.description = '';
            this.form.cover = null;
            this.form.price = '';
            this.form.start_time = '';
            this.form.end_time = '';
            this.form.place = '';
            this.form.category_id = '';
            this.form.promotion_id = '';
            this.form.people = [];
            this.form.points = [];
			this.valueCategory = '';
            this.valuePromotion = '';
            this.valuePerson = [];
            this.valuePoint = [];
            this.$refs.cover.value = null;
		},
		closeModal() {
			var ModalCreate = document.getElementById('ModalCreate')
			var modal = bootstrap.Modal.getInstance(ModalCreate)
			modal.hide();
		},
		onChangeDate(selectedDates, dateStr, instance) {
			this.form.date = selectedDates[0];
		},
		onChangeCategory (value) {
			this.form.category_id = value.id;
		},
		onRemoveCategory (value) {
			this.form.category_id = '';
		},
		onChangePromotion (value) {
			this.form.promotion_id = value.id;
		},
		onRemovePromotion (value) {
			this.form.promotion_id = '';
		},
		onChangePeople (value) {
			if (Array.isArray(value)) {
				value.forEach(element => this.form.people.push(element.id));
			} else {
				this.form.people.push(value.id);
			}
		},
		onRemovePeople (value) {
			if (Array.isArray(value)) {
				value.forEach(element => {
					var index = this.form.people.indexOf(element.id);
					if (index > -1) {
						this.form.people.splice(index, 1);
					}
				});
			} else {
				var index = this.form.people.indexOf(value.id);
				if (index > -1) {
					this.form.people.splice(index, 1);
				}
			}
		},
		onChangePoints (value) {
			if (Array.isArray(value)) {
				value.forEach(element => this.form.points.push(element.id));
			} else {
				this.form.points.push(value.id);
			}
		},
		onRemovePoints (value) {
			if (Array.isArray(value)) {
				value.forEach(element => {
					var index = this.form.points.indexOf(element.id);
					if (index > -1) {
						this.form.points.splice(index, 1);
					}
				});
			} else {
				var index = this.form.points.indexOf(value.id);
				if (index > -1) {
					this.form.points.splice(index, 1);
				}
			}
		},
	}
}
</script>