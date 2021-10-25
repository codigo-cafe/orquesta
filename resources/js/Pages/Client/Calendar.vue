<template>
    <app-layout :orchestra="orchestra">
        <div class="section">
            <div class="container">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title text-dark text-gradient">Calendario de Eventos</h6>
                            <button class="btn btn-dim" @click="update()"><i class="fas fa-redo me-1"></i> Actualizar</button>
                            <FullCalendar ref="fullCalendar" :options="calendarOptions"/>

                            <!--  end card  -->
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Pages/Client/Layouts/AppLayout'
import '@fullcalendar/core' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import esLocale from '@fullcalendar/core/locales/es';
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
export default {
    props: [
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'orchestra',
    ],

    components: {
        AppLayout,
        FullCalendar,
    },

    data() {
        return {
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                locales: [ esLocale ],
                initialView: 'dayGridMonth',
                eventDidMount: this.eventDidMount,
                eventClick: this.show,
                eventSources: [
                    {
                        events(info, successCallback, failureCallback) {
                            axios.get('calendar/list').then(response => {
                                successCallback(response.data.events);
                            })
                        },
                        color: '#6B879A',
                        textColor: 'white',
                    }
                ]
            },
        }
    },
    methods: {
        handleDateClick: function(arg) {
            this.selectdate = moment(arg.date).format('DD/MM/YYYY')
            this.openModal()
        },
        eventDidMount(arg){
            //console.log(arg.el)
            //console.log(arg.event.classNames)
            console.log(arg.event);
            this.$nextTick(() => {
                $(arg.el).popover({
                    title: '<strong>' + arg.event.title + '<strong>',
                    html: true,
                    placement:'left',
                    trigger : 'hover',
                    content: '<div class="row">'+
                                '<div class="col-md-6">'+
                                    '<i class="fas fa-clock mr-2"></i>'+
                                    '<span class="my-2">' + arg.event.extendedProps.start_time + ' - ' + arg.event.extendedProps.end_time + '</span><br>'+
                                    '<i class="fas fa-map-marker-alt mr-2"></i>'+
                                    '<span class="my-2">' + arg.event.extendedProps.place + '</span>'+
                                '</div>'+
                                '<div class="col-md-6">'+
                                    '<div class="position-relative">'+
                                        '<a class="d-block blur-shadow-image">'+
                                            '<img src="' + arg.event.extendedProps.cover + '" alt="' + arg.event.title + '" class="img-fluid shadow border-radius-lg">'+
                                        '</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>',
                    container:'body'
                });
            });
        },
        show(arg) {
            this.$nextTick(() => {
                $('.popover').popover('dispose');
            });
            this.$inertia.get(this.route('event.view', {event: arg.event.extendedProps.slug} ))
        },
    }
};
</script>
