<template>
    <Nav :orchestra="orchestra"></Nav>
    <slot></slot>
    <footer class="footer py-5">
        <Footer :orchestra="orchestra"></Footer>
    </footer>
</template>
<script>
import Nav from '@/Pages/Client/Partials/Nav'
import Footer from '@/Pages/Client/Partials/Footer'
export default {
    props: ['orchestra'],
    components: {
        Nav,
        Footer,
    }
}
</script>
