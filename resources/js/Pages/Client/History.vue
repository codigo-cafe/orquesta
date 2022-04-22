<template>
    <app-layout :orchestra="orchestra">
        <div class="wrapper">
            <div class="page-header page-header-medium">
                <div class="page-header-image" data-parallax="true" style="background-position: top; background-image: url('/img/integrantes-h9.jpg');">
                </div>
                <div class="content-center">
                    <div class="container">
                        <h1 class="title title-ephesis">Conoce nuestra orquesta</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="section section-blog col-md-10 ml-auto mr-auto">
            <div class="container">
                <div class="section-story-overview">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image-container image-left" style="background-image: url('/img/integrantes-h6.jpg')">
                                <p class="blockquote blockquote-primary">"Fomentar al máximo el desarrollo y enriquecimiento de la música y el arte escénico-musical en Tarija"
                                    <br>
                                    <br>
                                    <small>-Orquesta Vivaldi Tarija</small>
                                </p>
                            </div>
                            <div class="image-container image-left-bottom" style="background-image: url('/img/integrantes-h5.jpg')">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-container image-right" style="background-image: url('/img/integrantes-h3.jpg')">
                            </div>
                            <h3>Génesis de la orquesta tarijeña</h3>
                            <p>
                                La Orquesta Vivaldi es un elenco musical que nació el 4 de marzo del 2010 bajo la dirección de los profesores: Franz Javier Condori Leaño y Solange Fidel Cárdenas con el propósito de iniciar a niños y jóvenes a la práctica colectiva de los instrumentos de cuerda como el violín, viola, violoncelo y contrabajo.
                            </p>
                            <p>
                                Este grupo de músicos fueron el alma de lo que sería después la Sinfónica Departamental de Tarija, que ganaron el Primer Concurso Nacional de Orquestas Juveniles en 2013 y ocuparon el segundo lugar en el mismo certamen al año siguiente y que se denominó “Música para Crecer”, organizado por el Banco de Desarrollo de América Latina.
                            </p>
                            <p>
                                La orquesta Vivaldi es una oportunidad para el desarrollo personal en lo intelectual, espiritual, social y profesional de los jóvenes estudiantes, como una experiencia colectiva que implica la búsqueda constante de excelencia y, sobre todo, “perseverar hasta hacer realidad los sueños”.
                            </p>
                            <p>
                                Cuenta con 36 integrantes en las siguientes secciones: Cuerdas, seis primeros violines, seis segundos violines, cuatro violas, cuatro violoncellos y contrabajo; vientos de madera: un piccolo, dos flautas traversas, un oboe, dos clarinetes y un saxo alto; vientos de metal: dos cornos franceses, dos trompetas y tres trombones, además de dos instrumentos de percusión y un piano.
                            </p>
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
    ],

    components: {
        AppLayout,
    },
};
</script>
