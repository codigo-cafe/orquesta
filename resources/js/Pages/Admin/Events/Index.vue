<template>
	<app-layout>
		<div class="col-md-10 offset-md-1 mt-2">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title text-dark text-gradient">Calendario de Eventos</h6>
					<FullCalendar :options="calendarOptions"/>

					<!--  end card  -->
				</div>
				<!-- end col-md-12 -->
			</div>
		</div>
		<!-- Modal Create -->
		<modal-create :categories="categories" :promotions="promotions" :points="points" :people="people" :selectdate="selectdate" :reload="reload" :showNotification="showNotification"></modal-create>
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
import ModalConfirm from '@/Pages/Admin/Partials/Confirm'

export default {
	components: {
		AppLayout,
		ModalCreate,
		ModalEdit,
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
				eventSources: [
					{
						events(info, successCallback, failureCallback) {
							axios.get('events/list').then(response => {
								successCallback(response.data.events)
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
		//this.datatables();
	},

	methods: {
		handleDateClick: function(arg) {
			this.selectdate = moment(arg.date).format('DD/MM/YYYY')
	    	this.openModal()
	    },
	    eventDidMount(arg){
	    	console.log(arg.el)
	    	if (arg.event.extendedProps.imageurl) {
	    		let img = document.createElement("IMG");
	    		img.setAttribute("src", arg.event.extendedProps.imageurl);
				img.setAttribute("loading", "lazy");
				img.setAttribute("width", "100%");
				img.setAttribute("height", "100%");
				img.setAttribute("alt", arg.event.title);
		        arg.el.prepend(img);
		    }
	    },
	    eventDragStart(info) {
	    	console.log(info.event.id);
	    },
	    eventDragStop(info) {
	    	console.log(info.event.id)
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
					this.css({'width':'400px','height':'auto'});
				},
		    });
		},
	},
}
</script>