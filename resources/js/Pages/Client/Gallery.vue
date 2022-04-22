<template>
    <app-layout :orchestra="orchestra">
        <div class="wrapper">
            <div class="page-header page-header-medium">
                <div class="page-header-image" data-parallax="true" style="background-position: top; background-image: url('/img/conciertos-h2.jpg');">
                </div>
                <div class="content-center">
                    <div class="container">
                        <h1 class="title title-ephesis">Eventos y Conciertos</h1>
                    </div>
                </div>
            </div>
        </div>
    	<div class="section profile-page">
    		<div class="container">
    			<h3 class="title">Fotografías</h3>
    			<h5 class="description">"La música debe hacer saltar fuego en el corazón del hombre, y lágrimas de los ojos de la mujer."</h5>
    			<div class="row">
    				<div class="col-md-6 ml-auto mr-auto">
    					<div class="nav-align-center">
    						<ul class="nav nav-pills nav-pills-primary nav-pills-just-icons" role="tablist">
    							<li class="nav-item">
    								<a class="nav-link" data-toggle="tab" href="#images-1" role="tablist">
    									<i class="fas fa-camera"></i>
    								</a>
    							</li>
    							<li class="nav-item">
    								<a class="nav-link active" data-toggle="tab" href="#images-2" role="tablist">
    									<i class="fas fa-image"></i>
    								</a>
    							</li>
    							<li class="nav-item">
    								<a class="nav-link" data-toggle="tab" href="#images-3" role="tablist">
    									<i class="fas fa-images"></i>
    								</a>
    							</li>
    						</ul>
    					</div>
    				</div>
    				<div class="tab-content gallery">
    					<div class="tab-pane active" id="images-2" role="tabpanel">
    						<div class="col-md-12 ml-auto mr-auto">
    							<div class="row collections">
    								<div class="col-md-6">
    									<img src="/img/integrantes-h7.jpg" alt="" class="img-raised img-gallery-h">
    									<img src="/img/integrantes-h8.jpg" alt="" class="img-raised img-gallery-h">
    								</div>
    								<div class="col-md-6">
    									<img src="/img/integrantes-h9.jpg" alt="" class="img-raised img-gallery-h">
    									<img src="/img/integrantes-h1.jpg" alt="" class="img-raised img-gallery-h">
    								</div>
    							</div>
    						</div>
    					</div>
    					<div class="tab-pane" id="images-1" role="tabpanel">
    						<div class="col-md-12 ml-auto mr-auto">
    							<div class="row collections">
    								<div class="col-md-6">
    									<img src="/img/integrantes-h2.jpg" class="img-raised img-gallery-h">
    									<img src="/img/integrantes-h3.jpg" alt="" class="img-raised img-gallery-h">
    								</div>
    								<div class="col-md-6">
    									<img src="/img/integrantes-h4.jpg" alt="" class="img-raised img-gallery-h">
    									<img src="/img/integrantes-h5.jpg" alt="" class="img-raised img-gallery-h">
    								</div>
    							</div>
    						</div>
    					</div>
    					<div class="tab-pane" id="images-3" role="tabpanel">
    						<div class="col-md-12 ml-auto mr-auto">
    							<div class="row collections">
    								<div class="col-md-6">
    									<img src="/img/integrantes-h10.jpg" alt="" class="img-raised img-gallery-h">
    									<img src="/img/integrantes-h11.jpg" alt="" class="img-raised img-gallery-h">
    								</div>
    								<div class="col-md-6">
    									<img src="/img/integrantes-h12.jpg" alt="" class="img-raised img-gallery-h">
    									<img src="/img/integrantes-h13.jpg" class="img-raised img-gallery-h">
    								</div>
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
    ],

    components: {
        AppLayout,
    },
}
</script>
