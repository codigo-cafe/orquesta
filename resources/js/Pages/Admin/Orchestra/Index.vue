<template>
	<app-layout>
		<div class="col-12 mt-2">
			<div class="card">
				<div class="card-title">
					<div class="page-header vh-30" :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + bannerPreview + '\'); border-top-right-radius: 1rem; border-top-left-radius: 1rem;border-bottom-right-radius: 30%; border-bottom-left-radius: 30%;'">
						<span class="mask bg-gradient-dark"></span>
						<div class="container">
							<div class="row">
								<div class="col-lg-8 mx-auto text-white text-center">
									<h2 class="text-white">{{ form.name }}</h2>
									<p class="lead d-none d-md-block">{{ form.description }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<form @submit.prevent="submit" enctype="multipart/form-data">
					<div class="card-body p-xs-0 mt-xs-8">
						<div class="container p-xs-0">
							<div class="bg-white shadow-lg mt--n5 border-radius-md pb-4 p-3 mx-sm-0 mx-1 position-relative">
								<h6 class="card-title text-dark text-gradient">Información de la Orquesta</h6>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.name }">
											<label for="e_name">Nombre</label>
											<div class="input-group">
												<span class="input-group-text"><i class="fas fa-music"></i></span>
												<input type="text" class="form-control" id="e_name" placeholder="Nombre de la boutique" v-model="form.name">
											</div>
											<div v-if="errors.name">
												<small class="error text-danger">{{ errors.name }}</small>
											</div>
										</div>
										<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.banner }">
											<label for="e_banner">Imagen del Banner</label>
											<div class="input-group">
												<span class="input-group-text"><i class="fas fa-image"></i></span>
												<input type="file" ref="photo" @change="updatePhotoPreview" class="form-control">
											</div>
											<div v-if="errors.banner">
												<small class="error text-danger">{{ errors.banner }}</small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.email }">
													<label for="e_email">Email</label>
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-envelope"></i></span>
														<input type="text" class="form-control" id="e_email" placeholder="Correo electrónico" v-model="form.email">
													</div>
													<div v-if="errors.email">
														<small class="error text-danger">{{ errors.email }}</small>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.phone }">
													<label for="e_phone">Número de contacto</label>
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-phone"></i></span>
														<input type="text" class="form-control" id="e_phone" placeholder="Número de contacto" v-model="form.phone">
													</div>
													<div v-if="errors.phone">
														<small class="error text-danger">{{ errors.phone }}</small>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group bmd-form-grou" :class="{ 'has-danger': errors.description }">
											<label for="e_description">Descripción</label>
											<textarea class="form-control" id="e_description" rows="3" v-model="form.description">{{ form.description }}</textarea>
											<div v-if="errors.description">
												<small class="error text-danger">{{ errors.description }}</small>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group bmd-form-grou" :class="{ 'has-danger': errors.mission }">
													<label for="e_mission">Misión</label>
													<textarea class="form-control" id="e_mission" rows="3" v-model="form.mission">{{ form.mission }}</textarea>
													<div v-if="errors.mission">
														<small class="error text-danger">{{ errors.mission }}</small>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group bmd-form-grou" :class="{ 'has-danger': errors.vission }">
													<label for="e_vission">Visión</label>
													<textarea class="form-control" id="e_vission" rows="3" v-model="form.vission">{{ form.vission }}</textarea>
													<div v-if="errors.vission">
														<small class="error text-danger">{{ errors.vission }}</small>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.iframe }">
											<label for="e_iframe">Video embebido (iframe)</label>
											<div class="input-group">
												<span class="input-group-text"><i class="fas fa-video"></i></span>
												<input type="text" class="form-control" id="e_iframe" placeholder="Iframe del video Promocional" v-model="form.iframe">
											</div>
											<div v-if="errors.iframe">
												<small class="error text-danger">{{ errors.iframe }}</small>
											</div>
										</div>
										<div class="form-group bmd-form-group" :class="{ 'has-danger': errors.direction }">
											<label for="e_direction">Dirección</label>
											<div class="input-group">
												<span class="input-group-text"><i class="fas fa-thumbtack"></i></span>
												<input type="text" class="form-control" id="e_direction" placeholder="Nombre de la boutique" v-model="form.direction">
											</div>
											<div v-if="errors.direction">
												<small class="error text-danger">{{ errors.direction }}</small>
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
									</div>
								</div>
								<div class="row">
									<div class="col-12 mt-2">
										<div id="map" class="vh-50"></div>
									</div>
								</div>
								<div class="col-lg-3 mt-4 d-block mx-auto" v-if="hasAnyPermission(['edit_orchestra'])">
									<button type="submit" class="btn bg-gradient-cafe w-100 mb-0" :disabled="disabled">
										<span v-if="disabled">
											<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
											Procesando
										</span>
										<span v-else>
											Actualizar
										</span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<!-- end col-md-12 -->
				</form>
			</div>
		</div>
	</app-layout>
</template>
<script>
import AppLayout from '@/Pages/Admin/Layouts/AppLayout'
import { Loader } from "@googlemaps/js-api-loader"

export default {
	components: {
		AppLayout,
	},

	props: ['orchestra', 'errors'],

	data() {
		return {
			form: this.$inertia.form({
				'_method': 'PUT',
				name: this.orchestra.name,
				email: this.orchestra.email,
				phone: this.orchestra.phone,
				description: this.orchestra.description,
				mission: this.orchestra.mission,
				vission: this.orchestra.vission,
				direction: this.orchestra.direction,
				banner: this.orchestra.banner,
				latitude: this.orchestra.latitude,
				longitude: this.orchestra.longitude,
				iframe: this.orchestra.iframe,
			}),
			bannerPreview: this.orchestra.banner,
			disabled: false,
		}
	},

	mounted() {
		this.googlemaps();
	},

	methods: {
		submit() {
			if (this.hasAnyPermission(['edit_orchestra'])) {
				this.disabled = true;
				if (this.$refs.photo) {
					this.form.banner = this.$refs.photo.files[0]
				}
				this.$refs.photo.value = null;
				this.form.latitude = document.getElementById('e_latitude').value;
				this.form.longitude = document.getElementById('e_longitude').value;
				this.$inertia.post(this.route('orchestra.update', this.orchestra.id), this.form, {
					onSuccess: () => {
						this.disabled = false;
						this.showNotification('Perfil de la orquesta actualizado correctamente', 'success')
					},
				});
			}
		},
		showNotification: function(message, type) {
			$.notify({
				icon: "fas fa-check",
				message: message
			}, {
				type: type,
				timer: 3000,
				placement: {
					from: 'top',
					align: 'right',
				},
				onShow: function() {
					this.css({'width':'450px','height':'auto'});
				},
			});
			this.change()
		},
		updatePhotoPreview() {
			const reader = new FileReader();

			reader.onload = (e) => {
				this.form.banner = e.target.result;
				this.bannerPreview = e.target.result;
			};

			reader.readAsDataURL(this.$refs.photo.files[0]);
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
				"<p><b>"+ this.form.name +"</b>, "+ this.form.description +".</p>" +
				"</div>" +
				"</div>";
				const infowindow = new google.maps.InfoWindow({
					content: contentString,
				});
				const map = new google.maps.Map(document.getElementById("map"), {
					zoom: 16,
					center: position,
				});
				const marker = new google.maps.Marker({
					position: position,
					map,
					draggable: true,
					title: this.form.name,
					animation: google.maps.Animation.DROP,
				});
				marker.addListener("click", () => {
					infowindow.open({
						anchor: marker,
						map,
						shouldFocus: false,
					});
				});
				google.maps.event.addListener(marker, 'dragend', function (evt) {
					document.getElementById('e_latitude').value = evt.latLng.lat().toFixed(6);
					document.getElementById('e_longitude').value = evt.latLng.lng().toFixed(6);
				});
			});
		},
		change() {
			this.bannerPreview = this.orchestra.banner;
			this.googlemaps();
		}
	},
}
</script>