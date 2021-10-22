<template>
	<div class="modal fade" id="ModalShow" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodalshow">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Información del Evento</h6>
						<button type="button" class="btn btn-icon-sm btn-outline-secondary btn-icon-only rounded-circle mb-0 ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Modificar" @click="closeModal()">
							<span class="btn-inner--icon"><i class="fas fa-pen"></i></span>
						</button>
						<button type="button" class="btn btn-icon-sm btn-outline-danger btn-icon-only rounded-circle mb-0 ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Inhabilitar" v-if="event.status" @click="destroy(event)">
							<span class="btn-inner--icon"><i class="fas fa-ban"></i></span>
						</button>
						<button type="button" class="btn btn-icon-sm btn-outline-success btn-icon-only rounded-circle mb-0 ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Habilitar" v-else @click="restore(event)">
							<span class="btn-inner--icon"><i class="fas fa-check"></i></span>
						</button>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<i class="fas fa-info-circle me-3"></i>
								<span class="text-gradient text-primary text-uppercase text-xs font-weight-bold">
									{{ event.name }}
								</span>
								<p class="card-description mb-4">
									{{ event.description }}
								</p>
								<i class="fas fa-calendar-day me-3"></i>
								<span class="text-xs font-weight-bold my-2">{{ event.date }} | {{ event.start_time }} - {{ event.end_time }}</span>
							</div>
							<div class="col-md-6">
								<div class="position-relative">
									<a class="d-block blur-shadow-image">
										<img :src="event.cover" :alt="event.title" class="img-fluid shadow border-radius-lg move-on-hover">
									</a>
								</div>
							</div>
						</div>
						<hr>
						<div class="author align-items-center">
							<img :src="profile_photo_path" alt="Usuario responsable" class="avatar shadow">
							<div class="name ps-3">
								<span>{{ name }} {{ surnames }}</span>
								<div class="stats">
									<small>Registrado el {{ event.created_at }}</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>
<script>
export default {
	props: ['data', 'edit', 'show', 'restore', 'destroy'],

	data() {
		return {
			event: [],
			name: '',
			surnames: '',
			profile_photo_path: '',
			mensaje: '',
			disabled: false,
		}
	},

	mounted() {
		var ModalShowHidden = document.getElementById('ModalShow')
		ModalShowHidden.addEventListener('show.bs.modal',this.fill);
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	},

	methods: {
		fill() {
			this.event = this.data;
			this.name = this.event.user.person.name;
			this.surnames = this.event.user.person.surnames;
			if (this.event.user.person.profile_photo_path) {
				this.profile_photo_path = this.event.user.person.profile_photo_path;
			} else {
				this.profile_photo_path = this.event.user.person.profile_photo_url;
			}
		},
		closeModal() {
			var ModalShow = document.getElementById('ModalShow')
			var modal = bootstrap.Modal.getInstance(ModalShow)
			modal.hide();
			this.edit(this.event);
		},
	}
}
</script>