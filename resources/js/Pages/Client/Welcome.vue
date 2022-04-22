<template>
    <app-layout :orchestra="orchestra">
        <div class="wrapper">
            <div class="page-header page-header-medium">
                <div class="page-header-image" data-parallax="true" style="background-image: url('/img/welcome.jpg');">
                </div>
                <div class="content-center">
                    <div class="container">
                        <h1 class="title title-ephesis">Orquesta Vivaldi Tarija</h1>
                        <div class="text-center">
                            <a href="https://www.facebook.com/orquestavivalditarija" class="btn btn-danger btn-icon btn-round">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?phone=59172962410&text=Hola...%20%F0%9F%98%8A" class="btn btn-danger btn-icon btn-round">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.youtube.com/channel/UCZ3DlFv2oShyuD5WKrtrCaw" class="btn btn-danger btn-icon btn-round">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-about-us pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title">¿Quienes Somos?</h2>
                            <h5 class="description">La Orquesta Vivaldi constituye una obra social, la instrucción y la práctica colectiva de la música, que contribuye al desarrollo integral y cultural del ser humano en la ciudad de Tarija.</h5>
                        </div>
                    </div>
                    <div class="separator separator-primary"></div>
                    <div class="section-story-overview">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="image-container image-left" style="background-image: url('/img/integrantes-h7.jpg')">
                                    <!-- First image on the left side -->
                                    <p class="blockquote blockquote-primary">"La guitarra es una pequeña orquesta. Cada cuerda es un color diferente, una voz diferente."
                                        <br>
                                        <br>
                                        <small>― Andrés Segovia</small>
                                    </p>
                                </div>
                                <div class="image-container" style="background-image: url('/img/integrantes-h8.jpg')"></div>
                            </div>
                            <div class="col-md-5">
                                <div class="image-container image-right" style="background-image: url('/img/integrantes-h9.jpg')"></div>
                                <h3 class="pt-4">La Orquesta ganó el evento “Música para crecer”</h3>
                                <p>
                                    En la versión 2013, con el mejor puntaje resultaron las Orquestas Sinfónicas Juveniles de Tarija y Urubichá; mientras que en la categoría de cuerdas clasificaron la Orquesta Municipal de Cuerdas San José Patriarca, la Juvenil Paz y Bien de San Ignacio de Velasco.
                                </p>
                                <p>
                                    La final se realizó en Santa Cruz. Allí la Orquesta Juvenil de Tarija (categoría sinfónica) y la Orquesta San José Patriarca de San José de Chiquitos (categoría cuerdas), obtuvieron el primer lugar. Cada una recibió como premio Bs 42 mil.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section section-frequently pb-0">
                <div class="container">
                    <div class="text-center">
                        <h3 class="title">Servicios</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-4 " v-for="(service, index) in services" :key="service.id" :class="{ 'offset-md-2 offset-lg-2': index == 0 || index % 2 == 0 }">
                            <div class="info info-horizontal">
                                <div class="icon icon-success">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">{{ service.name }}</h4>
                                    <p>{{ service.description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section section-team text-center">
                <div class="container">
                    <h2 class="title">Fundador</h2>
                    <div class="team">
                        <div class="row">
                            <div class="col-md-6 mx-auto col-lg-6">
                                <div class="team-player">
                                    <img src="/img/director.png" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                                    <h4 class="title">Franz Javier Condori Leaño</h4>
                                    <p class="category text-primary">Director</p>
                                    <p class="description">
                                        Franz Condori es un potosino que encontró en Tarija su vocación por la música y gracias a su iniciativa y la de otros cultores de este arte, después de muchas vicisitudes, logró crear la Orquesta Sinfónica de Tarija.
                                    </p>
                                    <a href="https://www.facebook.com/orquestavivalditarija" class="btn btn-cafe btn-icon btn-round"><i class="fab fa-facebook-square" target="_blank"></i></a>
                                    <a href="https://api.whatsapp.com/send?phone=59172962410&text=Hola...%20%F0%9F%98%8A" class="btn btn-cafe btn-icon btn-round" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                    <a href="https://www.youtube.com/channel/UCZ3DlFv2oShyuD5WKrtrCaw" class="btn btn-cafe btn-icon btn-round"><i class="fab fa-youtube" target="_blank"></i></a>
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
export default {
    props: [
        'canLogin',
        'canRegister',
        'laravelVersion',
        'phpVersion',
        'orchestra',
        'services',
    ],

    components: {
        AppLayout,
    },

    mounted() {
        this.$nextTick(() => {
            $('.form-control').on("focus", function() {
                $(this).parent('.input-group').addClass("input-group-focus");
            }).on("blur", function() {
                $(this).parent(".input-group").removeClass("input-group-focus");
            });
        });
    },
}
</script>
