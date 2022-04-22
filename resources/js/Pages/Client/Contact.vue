<template>
    <app-layout :orchestra="orchestra">
        <div class="section main">
            <div class="contact-content">
                <div class="container">
                    <div class="row justify-content-center mt-4">
                        <div class="col-4">
                            <img :src="orchestra.banner" :alt="orchestra.name" class="rounded-circle img-raised">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <h2 class="title">Envíanos un mensaje</h2>
                            <p class="description">Puede contactarnos con cualquier tema relacionado con nuestros Servicios. Nos pondremos en contacto contigo lo antes posible.<br><br>
                            </p>
                            <div id="map" class="shadow vh-60"></div>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <div class="info info-horizontal pt-3">
                                <div class="icon icon-primary text-danger">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">Encuéntranos</h4>
                                    <p>
                                        {{ orchestra.direction }}<br>
                                        <span class="font-weight-bold text-cafe">Tarija - Bolivia</span>
                                    </p>
                                </div>
                            </div>
                            <div class="info info-horizontal">
                                <div class="icon icon-primary text-danger">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">Danos una llamada</h4>
                                    <p>
                                        <span class="font-weight-normal">Franz Javier Condori Leaño</span><br>
                                        <a href="https://api.whatsapp.com/send?phone=59172962410&text=Hola...%20%F0%9F%98%8A" class="text-cafe" target="_blank">
                                            <i class="fab fa-whatsapp"></i>
                                            {{ orchestra.phone }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="info info-horizontal">
                                <div class="icon icon-primary text-danger">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">Sobre nosotros</h4>
                                    <p>
                                        {{ orchestra.name }}<br>
                                        <span class="text-cafe">{{ orchestra.email }}</span><br><br>
                                        {{ orchestra.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Pages/Client/Layouts/AppLayout'
import { Loader } from "@googlemaps/js-api-loader"
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
    },

    data() {
        return {

        }
    },

    mounted() {
        this.googlemaps();

        this.$nextTick(() => {
            $('.form-control').on("focus", function() {
                $(this).parent('.input-group').addClass("input-group-focus");
            }).on("blur", function() {
                $(this).parent(".input-group").removeClass("input-group-focus");
            });
        });
    },

    methods: {
        googlemaps(){
            const loader = new Loader({
                apiKey: "AIzaSyBwb9dRQxZNi710lse5jaLR017gByvnj4Y",
                version: "weekly",
            });
            loader.load().then(() => {
                var lat = parseFloat(this.orchestra.latitude);
                var lng = parseFloat(this.orchestra.longitude);
                var position = { lat: lat, lng: lng };
                const contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                "</div>" +
                '<h3 id="firstHeading" class="firstHeading">"' + this.orchestra.name + '"</h3>' +
                '<div id="bodyContent">' +
                "<p><b>"+ this.orchestra.name +"</b>, "+ this.orchestra.description +".</p>" +
                "</div>" +
                "</div>";
                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                });
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 16,
                    center: position,
                    scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
                    styles: [{
                        "featureType": "water",
                        "elementType": "geometry",
                    }, {
                        "featureType": "landscape",
                        "elementType": "geometry",
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                    }, {
                        "featureType": "road.local",
                        "elementType": "geometry",
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#f5f5f5"
                        }, {
                            "lightness": 21
                        }]
                    }, {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#dedede"
                        }, {
                            "lightness": 21
                        }]
                    }, {
                        "elementType": "labels.text.stroke",
                        "stylers": [{
                            "visibility": "on"
                        }, {
                            "color": "#ffffff"
                        }, {
                            "lightness": 16
                        }]
                    }, {
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "saturation": 36
                        }, {
                            "color": "#333333"
                        }, {
                            "lightness": 40
                        }]
                    }, {
                        "elementType": "labels.icon",
                        "stylers": [{
                            "visibility": "on"
                        }]
                    }, {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#f2f2f2"
                        }, {
                            "lightness": 19
                        }]
                    }, {
                        "featureType": "administrative",
                        "elementType": "geometry.fill",
                        "stylers": [{
                            "color": "#fefefe"
                        }, {
                            "lightness": 20
                        }]
                    }, {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [{
                            "color": "#fefefe"
                        }, {
                            "lightness": 17
                        }, {
                            "weight": 1.2
                        }]
                    }]
                });
                const marker = new google.maps.Marker({
                    position: position,
                    map,
                    title: this.orchestra.name,
                    animation: google.maps.Animation.DROP,
                });
                marker.addListener("click", () => {
                    infowindow.open({
                        anchor: marker,
                        map,
                        shouldFocus: false,
                    });
                });
            });
        },
    }
};
</script>
