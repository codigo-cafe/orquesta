<template>
	<div class="row mb-2">
		<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8">
							<div class="numbers">
								<p class="text-sm mb-0 text-capitalize font-weight-bold">
									<Inertia-link :href="route('reports.events')">Reporte de Eventos</Inertia-link>
								</p>
								<h5 class="font-weight-bolder mb-0">
									{{ counts.events }}
									<span class="text-secondary text-sm font-weight-bolder"> eventos encontrados</span>
								</h5>
							</div>
						</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
								<i class="fas fa-calendar-day text-white text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8">
							<div class="numbers">
								<p class="text-sm mb-0 text-capitalize font-weight-bold">
									<Inertia-link :href="route('reports.points')">Reporte de Puntos de Venta</Inertia-link>
								</p>
								<h5 class="font-weight-bolder mb-0">
									{{ counts.points }}
									<span class="text-secondary text-sm font-weight-bolder"> puntos de venta encontrados</span>
								</h5>
							</div>
						</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
								<i class="fas fa-map-marker-alt text-white text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8">
							<div class="numbers">
								<p class="text-sm mb-0 text-capitalize font-weight-bold">
									<Inertia-link :href="route('reports.services')">Reporte de Servicios</Inertia-link>
								</p>
								<h5 class="font-weight-bolder mb-0">
									{{ counts.services }}
									<span class="text-secondary text-sm font-weight-bolder"> servicios encontrados</span>
								</h5>
							</div>
						</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
								<i class="fas fa-briefcase text-white text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8">
							<div class="numbers">
								<p class="text-sm mb-0 text-capitalize font-weight-bold">
									<Inertia-link :href="route('reports.promotions')">Reporte de Promociones</Inertia-link>
								</p>
								<h5 class="font-weight-bolder mb-0">
									{{ counts.promotions }}
									<span class="text-secondary text-sm font-weight-bolder"> promociones encontradas</span>
								</h5>
							</div>
						</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
								<i class="fas fa-percent text-white text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row mb-2">
		<div class="col-xl-3 col-sm-6">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8">
							<div class="numbers">
								<p class="text-sm mb-0 text-capitalize font-weight-bold">
									<Inertia-link :href="route('reports.members')">Reporte de Integrantes</Inertia-link>
								</p>
								<h5 class="font-weight-bolder mb-0">
									{{ counts.members }}
									<span class="text-secondary text-sm font-weight-bolder"> integrantes encontrados</span>
								</h5>
							</div>
						</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
								<i class="fas fa-users text-white text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8">
							<div class="numbers">
								<p class="text-sm mb-0 text-capitalize font-weight-bold">
									<Inertia-link :href="route('reports.users')">Reporte de Usuarios</Inertia-link>
								</p>
								<h5 class="font-weight-bolder mb-0">
									{{ counts.users }}
									<span class="text-secondary text-sm font-weight-bolder"> usuarios encontrados</span>
								</h5>
							</div>
						</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
								<i class="fa fa-shield-alt text-white text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	props: ['events', 'counts'],
}
</script>