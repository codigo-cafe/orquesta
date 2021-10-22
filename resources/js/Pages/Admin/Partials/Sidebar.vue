<template>
    <aside class="sidenav bg-cover navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-left ms-3 shadow-md" id="sidenav-main" style="background-image: url('/img/sidebar-16.jpg'); background-position: center;">
        <span class="mask bg-gradient-dark" style="z-index: -1;"></span>
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <inertia-link class="navbar-brand m-0" :href="route('orchestra.index')">
                <logo/>
            </inertia-link>
        </div>
        <hr class="horizontal dark mt-4">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mt-3 ">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-7 text-white">Contenido</h6>
                </li>
                <li class="nav-item" v-if="hasAnyPermission(['view_orchestra'])">
                    <inertia-link :href="route('orchestra.index')" class="nav-link" :class="{ 'active' : route().current('orchestra.*') }">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-music fa-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Perfil de la Orquesta</span>
                    </inertia-link>
                </li>
                <li class="nav-item" v-if="hasAnyPermission(['view_categories', 'view_events'])">
                    <a data-bs-toggle="collapse" href="#pagesCalendar" class="nav-link" :class="{ 'active' : calendar }" aria-controls="pagesCalendar" role="button" :aria-expanded="calendar">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-calendar-day fa-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Calendario</span>
                    </a>
                    <div class="collapse" id="pagesCalendar" :class="{ 'show' : calendar }">
                        <ul class="nav ms-4 ps-3 pt-1 pb-1">
                            <li class="nav-item" :class="{ 'active' : route().current('categories.*') }" v-if="hasAnyPermission(['view_categories'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('categories.*') }" :href="route('categories.index')">
                                    <span class="sidenav-normal"> Categorías </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" v-if="hasAnyPermission(['view_events'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('events.*') }" :href="route('events.index')">
                                    <span class="sidenav-normal"> Eventos </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" v-if="hasAnyPermission(['view_points'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('points.*') }" :href="route('points.index')">
                                    <span class="sidenav-normal"> Puntos de Venta </span>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="hasAnyPermission(['view_classifications', 'view_instruments', 'view_services', 'view_promotions'])">
                    <a data-bs-toggle="collapse" href="#pagesOrganization" class="nav-link" :class="{ 'active' : organization }" aria-controls="pagesOrganization" role="button" :aria-expanded="organization">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-sitemap fa-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Organización</span>
                    </a>
                    <div class="collapse" id="pagesOrganization" :class="{ 'show' : organization }">
                        <ul class="nav ms-4 ps-3 pt-1 pb-1">
                            <li class="nav-item" :class="{ 'active' : route().current('classifications.*') }" v-if="hasAnyPermission(['view_classifications'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('classifications.*') }" :href="route('classifications.index')">
                                    <span class="sidenav-normal"> Clasificaciones </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" :class="{ 'active' : route().current('instruments.*') }" v-if="hasAnyPermission(['view_instruments'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('instruments.*') }" :href="route('instruments.index')">
                                    <span class="sidenav-normal"> Instrumentos </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" v-if="hasAnyPermission(['view_services'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('services.*') }" :href="route('services.index')">
                                    <span class="sidenav-normal"> Servicios </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" v-if="hasAnyPermission(['view_promotions'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('promotions.*') }" :href="route('promotions.index')">
                                    <span class="sidenav-normal"> Promociones </span>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="hasAnyPermission(['view_types', 'view_people', 'view_members', 'view_users'])">
                    <a data-bs-toggle="collapse" href="#pagesPeople" class="nav-link" :class="{ 'active' : people }" aria-controls="pagesPeople" role="button" :aria-expanded="people">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Personas</span>
                    </a>
                    <div class="collapse" id="pagesPeople" :class="{ 'show' : people }">
                        <ul class="nav ms-4 ps-3 pt-1 pb-1">
                            <li class="nav-item" :class="{ 'active' : route().current('types.*') }" v-if="hasAnyPermission(['view_types'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('types.*') }" :href="route('types.index')">
                                    <span class="sidenav-normal"> Tipos de Personas </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" v-if="hasAnyPermission(['view_people'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('people.*') }" :href="route('people.index')">
                                    <span class="sidenav-normal"> Personas </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" v-if="hasAnyPermission(['view_members'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('members.*') }" :href="route('members.index')">
                                    <span class="sidenav-normal"> Integrantes </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" v-if="hasAnyPermission(['view_users'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('users.*') }" :href="route('users.index')">
                                    <span class="sidenav-normal"> Usuarios </span>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="hasAnyPermission(['view_roles', 'view_permissions'])">
                    <a data-bs-toggle="collapse" href="#pagesAccess" class="nav-link" :class="{ 'active' : access }" aria-controls="pagesAccess" role="button" :aria-expanded="access">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-shield-alt fa-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Acceso</span>
                    </a>
                    <div class="collapse" :class="{ 'show' : access }" id="pagesAccess">
                        <ul class="nav ms-4 ps-3 pt-1 pb-1">
                            <li class="nav-item" :class="{ 'active' : route().current('roles.*') }" v-if="hasAnyPermission(['view_roles'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('roles.*') }" :href="route('roles.index')">
                                    <span class="sidenav-normal"> Roles </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item" :class="{ 'active' : route().current('permissions.*') }" v-if="hasAnyPermission(['view_permissions'])">
                                <inertia-link class="nav-link" :class="{ 'active' : route().current('permissions.*') }" :href="route('permissions.index')">
                                    <span class="sidenav-normal"> Permisos </span>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
</template>
<script>
import Logo from '@/Pages/Admin/Partials/Logo'
export default {
    components: {
        Logo,
    },

    data() {
        return {
            calendar: false,
            profile: false,
            organization: false,
            people: false,
            access: false,
        }
    },

    mounted() {
        //console.log(route());
        console.log(route().current());
        switch (route().current()) {
            case 'categories.index':
            case 'events.index':
            case 'points.index':
                this.calendar = true;
            break;

            case 'classifications.index':
            case 'instruments.index':
            case 'services.index':
            case 'promotions.index':
                this.organization = true;
            break;

            case 'types.index':
            case 'people.index':
            case 'members.index':
            case 'users.index':
                this.people = true;
            break;

            case 'roles.index':
            case 'permissions.index':
                this.access = true;
            break;
        }
    },
}
</script>