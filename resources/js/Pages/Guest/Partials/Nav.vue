<template>
	<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
        <div class="container">
            <inertia-link class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" :href="route('login')">
                Orquesta Vivaldi Tarija
            </inertia-link>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="/">
                            <i class="fas fa-guitar opacity-7 me-1"></i>
                            Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <inertia-link class="nav-link me-2" :href="route('login')">
                            <i class="fas fa-key opacity-7 me-1"></i>
                            Login
                        </inertia-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>