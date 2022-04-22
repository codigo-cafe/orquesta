<template>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                    Copyright © <span v-text="year"></span>, desarrollado con <i class="fas fa-heart"></i> por <a href="https://api.whatsapp.com/send?phone=+59178249694&text=Hola%20😃" class="font-weight-bold text-dark text-gradient" target="_blank">Miguel Ángel Choque Ramírez</a>.
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                year: new Date().getFullYear(),
            }
        },
    }
</script>