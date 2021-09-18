<template>
	<Sidebar></Sidebar>
	<main class="main-content mt-1 border-radius-lg">
		<Nav></Nav>
		<transition name="slide-fade">
			<div class="container-fluid py-4" v-if="show">
				<slot></slot>
			</div>
		</transition>
		<div class="container-fluid">
			<Footer/>
		</div>
	</main>
</template>
<script>
import Nav from '@/Pages/Admin/Partials/Nav'
import Footer from '@/Pages/Admin/Partials/Footer'
import Sidebar from '@/Pages/Admin/Partials/Sidebar'
export default {
	components: {
		Nav,
		Footer,
		Sidebar
	},

	data() {
		return {
			show: false,
		}
	},

	mounted(){
		this.show = true;
	}
};
</script>

<style>
    /* Enter and leave animations can use different */
	/* durations and timing functions.              */
	.slide-fade-enter-active {
	  transition: all 0.3s ease-out;
	}

	.slide-fade-leave-active {
	  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
	}

	.slide-fade-enter-from,
	.slide-fade-leave-to {
	  transform: translateX(20px);
	  opacity: 0;
	}
</style>
