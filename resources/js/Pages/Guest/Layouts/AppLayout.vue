<template>
    <div>
        <Nav></Nav>
        <!-- Page Content -->
        <section>
            <div class="page-header align-items-start section-height-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('img/login-md-3.jpg');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">Bienvenido!</h1>
                            <p class="text-lead text-white">Por favor ingresa tus datos de acceso para iniciar sesión.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <slot></slot>
                </div>
                <footer class="footer py-5">
                    <Footer></Footer>
                </footer>
            </div>
        </section>
    </div>
</template>
<script>
    import Nav from '@/Pages/Guest/Partials/Nav'
    import Footer from '@/Pages/Guest/Partials/Footer'
    export default {
        components: {
            Nav,
            Footer
        }
    }
</script>
