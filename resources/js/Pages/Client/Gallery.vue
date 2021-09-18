<template>
    <app-layout :orchestra="orchestra">
        <div class="wrapper">
            <div class="page-header page-header-medium">
                <div class="page-header-image" data-parallax="true" style="background-image: url('/img/orquesta-wallpaper.jpg');">
                </div>
                <div class="content-center">
                    <div class="container">
                        <h1 class="title">This is our great company.</h1>
                        <div class="text-center">
                            <a href="#pablo" class="btn btn-danger btn-icon btn-round">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                            <a href="#pablo" class="btn btn-danger btn-icon btn-round">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#pablo" class="btn btn-danger btn-icon btn-round">
                                <i class="fab fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    	<div class="section profile-page">
    		<div class="container">
    			<h3 class="title">About me</h3>
    			<h5 class="description">An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</h5>
    			<div class="row">
    				<div class="col-md-6 ml-auto mr-auto">
    					<h4 class="title text-center">My Portfolio</h4>
    					<div class="nav-align-center">
    						<ul class="nav nav-pills nav-pills-primary nav-pills-just-icons" role="tablist">
    							<li class="nav-item">
    								<a class="nav-link" data-toggle="tab" href="#profile" role="tablist">
    									<i class="now-ui-icons design_image"></i>
    								</a>
    							</li>
    							<li class="nav-item">
    								<a class="nav-link active" data-toggle="tab" href="#home" role="tablist">
    									<i class="now-ui-icons location_world"></i>
    								</a>
    							</li>
    							<li class="nav-item">
    								<a class="nav-link" data-toggle="tab" href="#messages" role="tablist">
    									<i class="now-ui-icons sport_user-run"></i>
    								</a>
    							</li>
    						</ul>
    					</div>
    				</div>
    				<div class="tab-content gallery">
    					<div class="tab-pane active" id="home" role="tabpanel">
    						<div class="col-md-10 ml-auto mr-auto">
    							<div class="row collections">
    								<div class="col-md-6">
    									<img src="/img/bg1.jpg" alt="" class="img-raised">
    									<img src="/img/bg3.jpg" alt="" class="img-raised">
    								</div>
    								<div class="col-md-6">
    									<img src="/img/bg8.jpg" alt="" class="img-raised">
    									<img src="/img/bg7.jpg" alt="" class="img-raised">
    								</div>
    							</div>
    						</div>
    					</div>
    					<div class="tab-pane" id="profile" role="tabpanel">
    						<div class="col-md-10 ml-auto mr-auto">
    							<div class="row collections">
    								<div class="col-md-6">
    									<img src="/img/bg6.jpg" class="img-raised">
    									<img src="/img/bg11.jpg" alt="" class="img-raised">
    								</div>
    								<div class="col-md-6">
    									<img src="/img/bg7.jpg" alt="" class="img-raised">
    									<img src="/img/bg8.jpg" alt="" class="img-raised">
    								</div>
    							</div>
    						</div>
    					</div>
    					<div class="tab-pane" id="messages" role="tabpanel">
    						<div class="col-md-10 ml-auto mr-auto">
    							<div class="row collections">
    								<div class="col-md-6">
    									<img src="/img/bg3.jpg" alt="" class="img-raised">
    									<img src="/img/bg8.jpg" alt="" class="img-raised">
    								</div>
    								<div class="col-md-6">
    									<img src="/img/bg7.jpg" alt="" class="img-raised">
    									<img src="/img/bg6.jpg" class="img-raised">
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
