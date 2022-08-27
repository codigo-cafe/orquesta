<template>
	<div class="modal fade" id="ModalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodal">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Registrar Punto de Venta</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
							<label for="c_name">Nombre</label>
							<input type="text" class="form-control" id="c_name" placeholder="Nombre del punto de venta" v-model="form.name" autofocus>
							<div v-if="errors.name">
								<small class="error text-danger">{{ errors.name[0] }}</small>
							</div>
						</div>
						<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.direction }">
							<label for="c_direction">Dirección</label>
							<input type="text" class="form-control" id="c_direction" placeholder="Dirección del punto de venta" v-model="form.direction">
							<div v-if="errors.direction">
								<small class="error text-danger">{{ errors.direction[0] }}</small>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.latitude }">
									<label for="c_latitude">Latitud</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
										<input type="text" class="form-control" id="c_latitude" placeholder="Nombre de la encargada" v-model="form.latitude">
									</div>
									<div v-if="errors.latitude">
										<small class="error text-danger">{{ errors.latitude }}</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.longitude }">
									<label for="c_longitude">Longitud</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
										<input type="text" class="form-control" id="c_longitude" placeholder="Nombre de la encargada" v-model="form.longitude">
									</div>
									<div v-if="errors.longitude">
										<small class="error text-danger">{{ errors.longitude }}</small>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 mt-2">
								<div id="c_map" class="vh-50"></div>
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
	props: ['reload', 'showNotification'],

	data() {
		return {
			form: {
				name: '',
				direction: '',
				latitude: -21.534587,
				longitude: -64.734228,
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
		var ModalCreateHidden = document.getElementById('ModalCreate');
		ModalCreateHidden.addEventListener('hidden.bs.modal',this.clear);
	},

	methods: {
		async submit() {
			this.disabled = true;
			this.form.latitude = document.getElementById('c_latitude').value;
			this.form.longitude = document.getElementById('c_longitude').value;
			console.log(this.form.latitude)
			console.log(this.form.longitude)
			axios.post(this.route('points.store'), this.form)
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
			this.form.direction = '';
			this.form.latitude = -21.534587;
			this.form.longitude = -64.734228;
			var latlng = new google.maps.LatLng(-21.534587, -64.734228);
    		this.marker.setPosition(latlng);
    		this.mapa.setCenter(latlng);
		},
		closeModal() {
			var ModalCreate = document.getElementById('ModalCreate')
			var modal = bootstrap.Modal.getInstance(ModalCreate)
			modal.hide();
		},
		googlemaps(){
			const loader = new Loader({
				apiKey: "AIzaSyBwb9dRQxZNi710lse5jaLR017gByvnj4Y",
				version: "weekly",
			});
			loader.load().then(() => {
				var lat = parseFloat(this.form.latitude);
				var lng = parseFloat(this.form.longitude);
				var position = { lat: lat, lng: lng };
				const contentString =
				'<div id="content">' +
				'<div id="siteNotice">' +
				"</div>" +
				'<h2 id="firstHeading" class="firstHeading">"' + this.form.name + '"</h2>' +
				'<div id="bodyContent">' +
				"<p><b>"+ this.form.name +"</b>, "+ this.form.direction +".</p>" +
				"</div>" +
				"</div>";
				const infowindow = new google.maps.InfoWindow({
					content: contentString,
				});
				const map = new google.maps.Map(document.getElementById("c_map"), {
					zoom: 16,
					center: position,
				});
				this.mapa = map;
				this.marker = new google.maps.Marker({
					position: position,
					map,
					draggable: true,
					title: this.form.name,
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
					document.getElementById('c_latitude').value = evt.latLng.lat().toFixed(6);
					document.getElementById('c_longitude').value = evt.latLng.lng().toFixed(6);
				});
			});
		},
	}
}
</script>