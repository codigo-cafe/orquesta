<template>
	<div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodaledit">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Modificar Promoción</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
							<label for="e_name">Nombre</label>
							<input type="text" class="form-control" id="e_name" placeholder="Nombre del servicio" v-model="form.name" autofocus>
							<div v-if="errors.name">
								<small class="error text-danger">{{ errors.name[0] }}</small>
							</div>
						</div>
						<div class="form-group bmd-form-grou" :class="{ 'has-danger': errors.description }">
							<label for="e_description">Descripción</label>
							<textarea class="form-control" id="e_description" rows="3" v-model="form.description" placeholder="Breve descripción de la promoción...">{{ form.description }}</textarea>
							<div v-if="errors.description">
								<small class="error text-danger">{{ errors.description[0] }}</small>
							</div>
						</div>
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.discount }">
							<label for="c_discount">Descuento [Bs]</label>
							<input type="number" class="form-control" id="c_discount" placeholder="Descuento de la promoción" v-model="form.discount" autofocus>
							<div v-if="errors.discount">
								<small class="error text-danger">{{ errors.discount[0] }}</small>
							</div>
						</div>
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.date_start }">
							<label for="e_date_start">Fechas disponibles</label>
	                        <div class="input-group">
	                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
	                            <flat-pickr
			                    v-model="date"
			                    :config="config"
			                    class="form-control"
			                    placeholder="Seleccione el rango de fechas"
			                    @on-change="onChangeDate"
			                    name="date"/>
	                        </div>
							<div v-if="errors.date_start">
								<small class="error text-danger">{{ errors.date_start[0] }}</small>
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
import flatPickr from 'vue-flatpickr-component';
import {Spanish} from 'flatpickr/dist/l10n/es.js';
import 'flatpickr/dist/flatpickr.css';

export default {
	components: {
		flatPickr
	},

	props: ['data', 'reload', 'showNotification'],

	data() {
		return {
			promotion: [],
			form: {
				name: '',
				description: '',
				discount: '',
				date_start: '',
				date_end: '',
			},
			date: null,
			config: {
                wrap: true,
                altFormat: 'j M, Y',
                altInput: true,
                dateFormat: 'd/m/Y"',
                mode: 'range',
                locale: Spanish,
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
			axios.put(this.route('promotions.update', this.promotion.id), this.form)
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
			this.promotion = this.data;
			this.form.name = this.promotion.name;
			this.form.description = this.promotion.description;
			this.form.discount = this.promotion.discount;
			this.form.date_start = this.promotion.date_start;
			this.form.date_end = this.promotion.date_end;
			this.date = [this.promotion.date_start, this.promotion.date_end];
		},
		clear() {
			this.errors = {};
			this.form.name = '';
			this.form.description = '';
			this.form.discount = '',
			this.form.date_start = '';
			this.form.date_end = '';
			this.date = null;
		},
		closeModal() {
			var ModalEdit = document.getElementById('ModalEdit')
			var modal = bootstrap.Modal.getInstance(ModalEdit)
			modal.hide();
		},
		onChangeDate(selectedDates, dateStr, instance) {
			this.form.date_start = selectedDates[0];
			this.form.date_end = selectedDates[1];
		}
	}
}
</script>