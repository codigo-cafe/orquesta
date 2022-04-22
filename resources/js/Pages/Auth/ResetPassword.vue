<template>
    <app-layout>
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card">
                <div class="card-header text-center pt-4">
                    <h5>¿Restablecer Contraseña?</h5>
                </div>
                <div class="row px-xl-5 px-sm-4 px-3">
                    <div class="position-relative text-center">
                        <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                            Por favor ingresa tu nueva contraseña.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div>
                            <div class="form-group" :class="{ 'has-danger': errors.email }">
                                <input type="email" class="form-control" :class="{ 'is-invalid': errors.email }" v-model="form.email" placeholder="Email" aria-label="Email" aria-describedby="email-addon" required autofocus>
                                <div class="group-error" v-if="errors.email">
                                    <small class="error text-danger">{{ errors.email }}</small>
                                </div>
                            </div>
                            <div class="form-group" :class="{ 'has-danger': errors.password }">
                                <input type="password" class="form-control" :class="{ 'is-invalid': errors.password }" v-model="form.password" placeholder="Contraseña" aria-label="Password" aria-describedby="password-addon" required autocomplete="new-password">
                                <div class="group-error" v-if="errors.password">
                                    <small class="error text-danger">{{ errors.password }}</small>
                                </div>
                            </div>
                            <div class="form-group mb-3" :class="{ 'has-danger': errors.password_confirmation }">
                                <input type="password" class="form-control" :class="{ 'is-invalid': errors.password_confirmation }" v-model="form.password_confirmation" placeholder="Contraseña" aria-label="Password" aria-describedby="password-addon" required autocomplete="new-password">
                                <div class="group-error" v-if="errors.password_confirmation">
                                    <small class="error text-danger">{{ errors.password_confirmation }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dim w-100 my-2 mb-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Restablecer Contraseña</button>
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
            email: String,
            token: String,
            errors: Object,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
