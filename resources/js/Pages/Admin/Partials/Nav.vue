<template>
	<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 py-3 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
		<div class="container-fluid py-1 px-3">
			<nav aria-label="breadcrumb">
				<h6 class="font-weight-bolder mb-0">Panel de Control</h6>
			</nav>
			<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
				<ul class="navbar-nav ms-md-auto justify-content-end">
					<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
						<a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
							<div class="sidenav-toggler-inner">
								<i class="sidenav-toggler-line"></i>
								<i class="sidenav-toggler-line"></i>
								<i class="sidenav-toggler-line"></i>
							</div>
						</a>
					</li>
					<li class="nav-item dropdown pe-2 d-flex align-items-center">
						<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
							<span class="text-secondary font-weight-bold d-xl-inline d-none">{{ $page.props.user.person.name }} {{ $page.props.user.person.surnames }}</span>
							<i class="fa fa-user cursor-pointer ps-2"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-end px-2 py-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
							<li class="mb-2">
								<a class="dropdown-item border-radius-md" href="javascript:;">
									<div class="d-flex py-1">
										<div class="my-auto">
											<img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.person.name+' '+$page.props.user.person.surnames" class="avatar avatar-sm  me-3 ">
										</div>
										<div class="d-flex flex-column justify-content-center">
											<h6 class="text-sm font-weight-normal mb-1">
												<span class="font-weight-bold">{{ $page.props.user.person.name }} {{ $page.props.user.person.surnames }}</span>
											</h6>
											<p class="text-xs text-secondary mb-0">
												<i class="fa fa-shield-alt me-1"></i>
												Admin
											</p>
										</div>
									</div>
								</a>
							</li>
							<li class="mb-0">
								<form @submit.prevent="logout">
	                                <inertia-link class="dropdown-item border-radius-md" href="#" v-on:click="logout">
	                                    <div class="d-flex py-1">
											<div class="my-auto">
												<i class="fas fa-power-off fa-lg avatar avatar-sm  me-3 text-danger "></i>
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="text-sm font-weight-normal mb-0">
													<span class="font-weight-bold">Cerrar Sesión</span>
												</h6>
											</div>
										</div>
	                                </inertia-link>
	                            </form>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>
<script>
    export default {
    	data(){
    		return {
    			scrollTop: null,
    		}
    	},
        mounted(){
        	this.getYPosition()
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
            this.sideNav();
        },
        methods: {
        	navbarFixed(state) {
        		// Set Navbar Fixed
				let classes = ['position-sticky', 'blur', 'shadow-blur', 'mt-4', 'left-auto', 'top-1', 'z-index-sticky'];
				const navbar = document.getElementById('navbarBlur');
				if (state) {
					navbar.classList.add(...classes);
					navbar.setAttribute('navbar-scroll', 'true');
					navbarBlurOnScroll('navbarBlur');
				} else {
					navbar.classList.remove(...classes);
				    navbar.setAttribute('navbar-scroll', 'false');
				    navbarBlurOnScroll('navbarBlur');
				}
        	},
        	getYPosition() {
        		const self = this;
			  	window.addEventListener('scroll', function() {
					this.scrollTop = document.documentElement.scrollTop;
					if (this.scrollTop > 10) {
						self.navbarFixed(true);
					} else {
						self.navbarFixed(false);
					}
				});
        	},
        	sideNav(){
				// Toggle Sidenav
	            const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
	            const iconSidenav = document.getElementById('iconSidenav');
	            const sidenav = document.getElementById('sidenav-main');
	            let body = document.getElementsByTagName('body')[0];
	            let className = 'g-sidenav-pinned';

	            if (iconNavbarSidenav) {
	            	iconNavbarSidenav.addEventListener("click", toggleSidenav);
	            }

	            if (iconSidenav) {
	            	iconSidenav.addEventListener("click", toggleSidenav);
	            }

	            function toggleSidenav() {
	            	if (body.classList.contains(className)) {
	            		body.classList.remove(className);
	            		setTimeout(function() {
	            			sidenav.classList.remove('bg-white');
	            		}, 100);
	            		sidenav.classList.remove('bg-transparent');

	            	} else {
	            		body.classList.add(className);
	            		sidenav.classList.add('bg-white');
	            		sidenav.classList.remove('bg-transparent');
	            		iconSidenav.classList.remove('d-none');
	            	}
	            }
        	},
        	logout() {
	            this.$inertia.post(route('logout'));
	        },
        }
    }
</script>