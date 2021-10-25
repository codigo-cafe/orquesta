<template>
    <app-layout :orchestra="orchestra">
        <div class="wrapper">
            <div class="page-header page-header-medium">
                <div class="page-header-image" data-parallax="true" style="background-position: top; background-image: url('/img/conciertos-h2.jpg');">
                </div>
            </div>
        </div>
    	<div class="section profile-page">
    		<div class="container">
    			<h3 class="title">Fotografías</h3>
    			<h5 class="description">An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</h5>
    			<div class="row">
    				<div class="col-md-6 ml-auto mr-auto">
    					<div class="nav-align-center">
    						<ul class="nav nav-pills nav-pills-primary nav-pills-just-icons" role="tablist">
    							<li class="nav-item">
    								<a class="nav-link" data-toggle="tab" href="#profile" role="tablist">
    									<i class="fas fa-camera"></i>
    								</a>
    							</li>
    							<li class="nav-item">
    								<a class="nav-link active" data-toggle="tab" href="#home" role="tablist">
    									<i class="fas fa-images"></i>
    								</a>
    							</li>
    							<li class="nav-item">
    								<a class="nav-link" data-toggle="tab" href="#messages" role="tablist">
    									<i class="fas fa-video"></i>
    								</a>
    							</li>
    						</ul>
    					</div>
    				</div>
    				<div class="tab-content gallery">
    					<div class="tab-pane active" id="home" role="tabpanel">
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
    					<div class="tab-pane" id="profile" role="tabpanel">
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
    					<div class="tab-pane" id="messages" role="tabpanel">
    						<div class="col-md-12 ml-auto mr-auto">
    							<div class="row collections">
    								<div class="col-md-6">
    									<img src="/img/integrantes-h6.jpg" alt="" class="img-raised img-gallery-h">
    									<img src="/img/integrantes-h7.jpg" alt="" class="img-raised img-gallery-h">
    								</div>
    								<div class="col-md-6">
    									<img src="/img/integrantes-h8.jpg" alt="" class="img-raised img-gallery-h">
    									<img src="/img/integrantes-h9.jpg" class="img-raised img-gallery-h">
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
