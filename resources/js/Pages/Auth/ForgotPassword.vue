<template>
    <app-layout>
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div v-if="status" class="alert alert-success alert-dismissible fade show my-4" role="alert">
                <span class="alert-icon"><i class="fas fa-bell pe-1"></i></span>
                <span class="alert-text">{{ status }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-header text-center pt-4">
                    <h5>¿Olvidaste tu Contraseña?</h5>
                </div>
                <div class="row px-xl-5 px-sm-4 px-3">
                    <div class="position-relative text-center">
                        <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                            No hay problema. Simplemente déjenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div>
                            <div class="form-group mb-3" :class="{ 'has-danger': errors.email }">
                            <input type="email" class="form-control" :class="{ 'is-invalid': errors.email }" v-model="form.email" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                <div class="group-error" v-if="errors.email">
                                    <small class="error text-danger">{{ errors.email }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dim w-100 my-2 mb-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Enviar enlace</button>
                            <inertia-link :href="route('login')" class="btn bg-gradient-secondary w-100 mb-2">Volver Atrás</inertia-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Pages/Guest/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },

        props: {
            errors: Object,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>