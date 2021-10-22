<template>
	<app-layout>
		<div class="col-md-10 offset-md-1 mt-2">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title text-dark text-gradient">Calendario de Eventos</h6>
					<button class="btn btn-dim" @click="reload()">Actualizar</button>
					<FullCalendar ref="fullCalendar" :options="calendarOptions"/>

					<!--  end card  -->
				</div>
				<!-- end col-md-12 -->
			</div>
		</div>
		<!-- Modal Create -->
		<modal-create :categories="categories" :promotions="promotions" :points="points" :people="people" :selectdate="selectdate" :reload="reload" :showNotification="showNotification"></modal-create>
		<modal-edit :data="data" :categories="categories" :promotions="promotions" :points="points" :people="people" :selectdate="selectdate" :reload="reload" :showNotification="showNotification"></modal-edit>
		<modal-show :data="data" :edit="edit" :show="show" :restore="restore" :destroy="destroy"></modal-show>
		<modal-confirm :data="data" :options="options" :reload="reload" :showNotification="showNotification"></modal-confirm>
	</app-layout>
</template>
<script>
import '@fullcalendar/core' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import esLocale from '@fullcalendar/core/locales/es';
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import moment from 'moment';

import AppLayout from '@/Pages/Admin/Layouts/AppLayout'
import ModalCreate from '@/Pages/Admin/Events/Create'
import ModalEdit from '@/Pages/Admin/Events/Edit'
import ModalShow from '@/Pages/Admin/Events/Show'
import ModalConfirm from '@/Pages/Admin/Partials/Confirm'

export default {
	components: {
		AppLayout,
		ModalCreate,
		ModalEdit,
		ModalShow,
		ModalConfirm,
		FullCalendar,
	},

	props: ['categories', 'promotions', 'points', 'people'],

	data() {
		return {
			data: [],
			options: {
				url: '',
				message: '',
				btnText: '',
				btnClass: '',
				iconClass: '',
			},
			calendarOptions: {
				plugins: [ dayGridPlugin, interactionPlugin ],
				locales: [ esLocale ],
				initialView: 'dayGridMonth',
				editable: true,
				dateClick: this.handleDateClick,
				eventDragStart: this.eventDragStart,
				eventDragStop: this.eventDragStop,
				eventDidMount: this.eventDidMount,
				eventClick: this.show,
				eventSources: [
					{
						events(info, successCallback, failureCallback) {
							axios.get('events/list').then(response => {
								successCallback(response.data.events);
							})
						},
						color: '#6B879A',
						textColor: 'white',
					}
				]
			},
			selectdate: '',
		}
	},

	mounted(){
	},

	methods: {
		handleDateClick: function(arg) {
			this.selectdate = moment(arg.date).format('DD/MM/YYYY')
	    	this.openModal()
	    },
	    eventDidMount(arg){
	    	//console.log(arg.el)
	    	console.log(arg.event.classNames)
	    	let icon = document.createElement("i");
	    	if (arg.event.extendedProps.status) {
    			icon.setAttribute('class', 'fas fa-check text-success ms-2');
	    		arg.el.querySelector('.fc-event-title').append(icon);
		    } else{
		    	icon.setAttribute('class', 'fas fa-ban text-danger ms-2');
	    		arg.el.querySelector('.fc-event-title').append(icon);
		    }
	    },
	    eventDragStart(info) {
	    	console.log(info.event.id);
	    },
	    eventDragStop(info) {
	    	console.log(info.event.id)
	    },
	    show(info) {
	    	var mensaje = '';
	    	if (this.hasAnyPermission(['view_events'])) {
				axios.get(this.route('events.show', info.event.id))
				.then(response => {
					this.data = response.data;
				})
				.catch(error => {
                    if (error.response.status == 403) {
                        mensaje = 'Esta acción no está autorizada';
                    }
                })
				.then(response => {
					if (mensaje != '') {
	                    this.showNotification(mensaje, 'warning');
	                } else {
						var myModal = new bootstrap.Modal(document.getElementById('ModalShow'), {
							keyboard: false
						});
						myModal.show();
	                }
				});
			}
	    },
	    edit(event) {
	    	console.log(event)
	    	var mensaje = '';
	    	if (this.hasAnyPermission(['edit_events'])) {
				axios.get(this.route('events.edit', event.id))
				.then(response => {
					this.data = response.data;
				})
				.catch(error => {
                    if (error.response.status == 403) {
                        mensaje = 'Esta acción no está autorizada';
                    }
                })
				.then(response => {
					if (mensaje != '') {
	                    this.showNotification(mensaje, 'warning');
	                } else {
						var myModal = new bootstrap.Modal(document.getElementById('ModalEdit'), {
							keyboard: false
						});
						myModal.show();
	                }
				});
			}
	    },
	    restore(data) {
			if (this.hasAnyPermission(['restore_events'])) {
				this.data = data;
				this.options.url = 'events.restore';
				this.options.message = 'Está seguro de habilitar el evento: ';
				this.options.btnText = 'Habilitar';
				this.options.btnClass = 'btn-success bg-gradient-success';
				this.options.iconClass = 'fa-check text-success';

				var ModalShow = document.getElementById('ModalShow')
                var modal = bootstrap.Modal.getInstance(ModalShow)
                modal.hide();

				var myModal = new bootstrap.Modal(document.getElementById('ModalConfirm'), {
					keyboard: false
				});
				myModal.show();
			}
		},

		destroy(data) {
			if (this.hasAnyPermission(['delete_events'])) {
				this.data = data;
				this.options.url = 'events.destroy';
				this.options.message = 'Está seguro de inhabilitar el evento: ';
				this.options.btnText = 'Inhabilitar';
				this.options.btnClass = 'btn-danger bg-gradient-danger';
				this.options.iconClass = 'fa-ban text-danger';

				var ModalShow = document.getElementById('ModalShow')
                var modal = bootstrap.Modal.getInstance(ModalShow)
                modal.hide();

				var myModal = new bootstrap.Modal(document.getElementById('ModalConfirm'), {
					keyboard: false
				});
				myModal.show();
			}
		},
	    openModal() {
			if (this.hasAnyPermission(['create_events'])) {
				var myModal = new bootstrap.Modal(document.getElementById('ModalCreate'), {
					keyboard: false
				});
				myModal.show();
			}
		},
		reload() {
	    	let calendarApi = this.$refs.fullCalendar.getApi()
			calendarApi.refetchEvents()
		},
		showNotification: function(message, type, event) {
			this.data = event;
			console.log(this.data)
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
					this.css({'width':'400px','height':'auto'});
				},
		    });
		},
	},
}
</script>