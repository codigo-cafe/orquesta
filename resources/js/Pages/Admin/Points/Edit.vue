<template>
	<div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodaledit">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Modificar Punto de Venta</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
							<label for="e_name">Nombre</label>
							<input type="text" class="form-control" id="e_name" placeholder="Nombre del punto de venta" v-model="form.name" autofocus>
							<div v-if="errors.name">
								<small class="error text-danger">{{ errors.name[0] }}</small>
							</div>
						</div>
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.direction }">
							<label for="e_direction">Dirección</label>
							<input type="text" class="form-control" id="e_direction" placeholder="Dirección del punto de venta" v-model="form.direction">
							<div v-if="errors.direction">
								<small class="error text-danger">{{ errors.direction[0] }}</small>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.latitude }">
									<label for="e_latitude">Latitud</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
										<input type="text" class="form-control" id="e_latitude" placeholder="Nombre de la encargada" v-model="form.latitude">
									</div>
									<div v-if="errors.latitude">
										<small class="error text-danger">{{ errors.latitude }}</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.longitude }">
									<label for="e_longitude">Longitud</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
										<input type="text" class="form-control" id="e_longitude" placeholder="Nombre de la encargada" v-model="form.longitude">
									</div>
									<div v-if="errors.longitude">
										<small class="error text-danger">{{ errors.longitude }}</small>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 mt-2">
								<div id="e_map" class="vh-50"></div>
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
import { Loader } from "@googlemaps/js-api-loader"

export default {
	props: ['data', 'reload', 'showNotification'],

	data() {
		return {
			point: [],
			form: {
				name: '',
				direction: '',
				latitude: '',
				longitude: '',
			},
			mapa: '',
			marker: '',
			errors: {},
			mensaje: '',
			disabled: false,
		}
	},

	mounted() {
		this.googlemaps();
		var ModalEditHidden = document.getElementById('ModalEdit')
		ModalEditHidden.addEventListener('hidden.bs.modal',this.clear);
		ModalEditHidden.addEventListener('show.bs.modal',this.fill);
	},

	methods: {
		async submit() {
			this.disabled = true;
			this.form.latitude = document.getElementById('e_latitude').value;
			this.form.longitude = document.getElementById('e_longitude').value;
			axios.put(this.route('points.update', this.point.id), this.form)
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
			this.point = this.data;
			this.form.name = this.point.name;
			this.form.direction = this.point.direction;
			this.form.latitude = this.point.latitude;
			this.form.longitude = this.point.longitude;
			var latlng = new google.maps.LatLng(this.point.latitude, this.point.longitude);
			this.marker.setPosition(latlng);
    		this.mapa.setCenter(latlng);
		},
		clear() {
			this.errors = {};
			this.form.name = '';
			this.form.direction = '';
			this.form.latitude = '';
			this.form.longitude = '';
		},
		closeModal() {
			var ModalEdit = document.getElementById('ModalEdit')
			var modal = bootstrap.Modal.getInstance(ModalEdit)
			modal.hide();
		},
		googlemaps(){
			const loader = new Loader({
				apiKey: "AIzaSyBwb9dRQxZNi710lse5jaLR017gByvnj4Y",
				version: "weekly",
			});
			loader.load().then(() => {
				var lat = parseFloat(this.point.latitude);
				var lng = parseFloat(this.point.longitude);
				var position = { lat: lat, lng: lng };
				const map = new google.maps.Map(document.getElementById("e_map"), {
					zoom: 16,
					center: position,
				});
				this.mapa = map;
				this.marker = new google.maps.Marker({
					position: position,
					map,
					draggable: true,
					title: this.point.name,
					animation: google.maps.Animation.DROP,
				});
				this.marker.addListener("click", () => {
					infowindow.open({
						anchor: this.marker,
						map,
						shouldFocus: false,
					});
				});
				google.maps.event.addListener(this.marker, 'dragend', function (evt) {
					document.getElementById('e_latitude').value = evt.latLng.lat().toFixed(6);
					document.getElementById('e_longitude').value = evt.latLng.lng().toFixed(6);
				});
			});
		},
	}
}
</script>