<template>
    <app-layout :orchestra="orchestra">
        <div class="wrapper">
            <div class="page-header page-header-medium">
                <div class="page-header-image" data-parallax="true" style="background-image: url('/img/integrantes.jpg');">
                </div>
                <div class="content-center">
                    <div class="container">
                        <h1 class="title title-ephesis">Conoce nuestra orquesta con los músicos más talentosos del país</h1>
                    </div>
                </div>
            </div>
        </div>
    	<div class="section profile-page">
    		<div class="container">
                <h3 class="title">DIRECTOR</h3>
                <p class="description h4">Franz Condori</p>
    			<h3 class="title">MÚSICOS</h3>
                <div class="three-columns text-center">
                    <template v-for="instrument in instruments">
                        <strong class="text-cafe">{{ instrument.name }}</strong>
                        <template v-for="member in instrument.members">
                            <p class="description">
                                {{ member.person.name }} {{ member.person.surnames }}
                            </p>
                        </template>
                    </template>
                </div>
    			<h5 class="description">An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</h5>
                <div class="row text-center">
                    <div class="col-md-4">
                        <img class="rounded img-raised img img-gallery-v" alt="Raised Image" src="/img/integrantes-v1.jpg">
                    </div>
                    <div class="col-md-4">
                        <img class="rounded img-raised img img-gallery-v" alt="Raised Image" src="/img/integrantes-v3.jpg">
                    </div>
                    <div class="col-md-4">
                        <img class="rounded img-raised img img-gallery-v" alt="Raised Image" src="/img/integrantes-v2.jpg">
                    </div>
                    <div class="col-md-6">
                        <img class="rounded img-raised img img-gallery-h" alt="Raised Image" src="/img/integrantes-h5.jpg">
                    </div>
                    <div class="col-md-6">
                        <img class="rounded img-raised img img-gallery-h" alt="Raised Image" src="/img/integrantes-h6.jpg">
                    </div>

                    <div class="col-md-4">
                        <img class="rounded img-raised img img-gallery-v" alt="Raised Image" src="/img/integrantes-v4.jpg">
                    </div>
                    <div class="col-md-4">
                        <img class="rounded img-raised img img-gallery-v" alt="Raised Image" src="/img/integrantes-v5.jpg">
                    </div>
                    <div class="col-md-4">
                        <img class="rounded img-raised img img-gallery-v" alt="Raised Image" src="/img/integrantes-v6.jpg">
                    </div>
                    <inertia-link :href="route('gallery')" class="btn btn-outline-primary mx-auto">Ver más fotos</inertia-link>
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
        'instruments',
    ],

    components: {
        AppLayout,
    },
};
</script>
