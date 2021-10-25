<template>
    <app-layout :orchestra="orchestra">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title mb-0">{{ event.name }}</h2><span class="badge badge-danger mb-4">{{ event.category.name }}</span>
                        <h6 class="category text-cafe mt-1">{{ event.date }} | {{ event.start_time }} - {{ event.end_time }}</h6>
                        <h5 class="description">{{ event.description }}</h5>
                        <div class="badge badge-success" v-if="event.promotion">
                            {{ event.promotion.name }}
                        </div>
                        <div class="mb-2" v-if="event.promotion">
                            <span class="text-secondary h5 mb-2 mr-2"><del>{{ event.price }} Bs</del></span>
                            <span class="text-dark h3 mb-2 mr-2 opacity-8">{{ event.price - event.promotion.discount }} Bs</span>
                        </div>
                        <div class="mb-2" v-if="event.price == 0">
                            <span class="text-success h3 mb-2 mr-2 opacity-8">¡¡ENTRADA LIBRE DE COSTO!!</span>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center text-center">
                    <div class="col-md-8">
                        <div class="card card-plain card-blog">
                            <div class="text-center">
                                <h6 class="text-dark">Compartir:</h6>
                                <a :href="'https://www.facebook.com/sharer.php?u='+currentUrl" target="_blank" class="btn btn-facebook btn-icon btn-round">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                                <a :href="'https://twitter.com/intent/tweet?url='+currentUrl+'&text='+event.name+'&hashtags=OrquestaVivaldiTarija'" target="_blank" class="btn btn-twitter btn-icon btn-round">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a :href="'whatsapp://send/?text='+event.name+'%20'+currentUrl" target="_blank" class="btn btn-whatsapp btn-icon btn-round">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                            <div class="card-image">
                                <img class="card-img img-fluid img-raised rounded" :src="event.cover">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="info info-hover">
                            <div class="icon icon-success icon-circle">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h4 class="info-title">Contactos</h4>
                            <p class="description" v-for="contact in event.people">
                                {{ contact.name }} {{ contact.surnames }} <br>
                                <a href="#" class="text-success" @click.prevent="submit(contact.phones[0].number)">
                                    <i class="fab fa-whatsapp"></i> {{ contact.phones[0].number }}
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info info-hover">
                            <div class="icon icon-info icon-circle">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <h4 class="info-title">Horario</h4>
                            <p class="description">{{ event.date }}</p>
                            <p class="description">{{ event.start_time }} - {{ event.end_time}}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info info-hover">
                            <div class="icon icon-primary icon-circle">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                            <h4 class="info-title">Puntos de Venta</h4>
                            <p class="description" v-for="point in event.points">
                                {{ point.name }}<br>
                                <span class="text-orange">
                                    {{ point.direction }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-6 text-left">
                        <inertia-link :href="route('event.view', anterior.slug)" class="text-cafe" v-if="anterior">
                            <div class="d-flex align-items-center float-left">
                                <i class="fas fa-arrow-left fa-lg pr-4"></i>
                                Evento anterior: {{ anterior.date }} <br>
                                {{ anterior.name }}
                            </div>
                        </inertia-link>
                    </div>
                    <div class="col-6 text-right">
                        <inertia-link :href="route('event.view', posterior.slug)" class="text-cafe" v-if="posterior">
                            <div class="d-flex align-items-center float-right">
                                Evento posterior: {{ posterior.date }} <br>
                                {{ posterior.name }}
                                <i class="fas fa-arrow-right fa-lg pl-4"></i>
                            </div>
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Pages/Client/Layouts/AppLayout'
export default {
    props: [
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'orchestra',
    'event',
    'anterior',
    'posterior',
    ],

    components: {
        AppLayout,
    },

    data() {
        return {
            currentUrl: '',
        }
    },

    created: function(){
        this.currentUrl = window.location.href;
    },

    methods: {
        submit(phone) {
            var textevento = "✅%20" + encodeURIComponent(this.event.name) + "%0A" + encodeURIComponent(this.currentUrl) + "%0A";

            var today = new Date();
            var month_format = ((today.getMonth() + 1) < 10 ? '0' : '') + (today.getMonth() + 1);
            var day_format = (today.getDate() < 10 ? '0' : '') + today.getDate();

            var mes = day_format + '/' + month_format + '/' + today.getFullYear();
            var time = today.getHours() + ":" + (today.getMinutes() < 10 ? '0' : '') + today.getMinutes();
            var dateTime = encodeURIComponent("Solicitud enviada el " + mes + " a las " + time);

            var titulo = "*Adquisición%20de%20entradas%20-%20Orquesta%20Vivaldi%20Tarija*%0A";
            var subtitulo = "%0A*Hola,%20me%20gustaria%20adquirir%20entradas%20para%20el%20evento%3A*%0A";
            textevento = textevento + "%0A";
            var fecha = "🕒%20_" + dateTime + "_";
            var mensaje = titulo + subtitulo + textevento + fecha;
            var URL = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + mensaje;
            window.open(URL, "_blank");
        }
    }
};
</script>
