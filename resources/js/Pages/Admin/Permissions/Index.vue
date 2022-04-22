<template>
	<app-layout>
		<div class="col-12 mt-2">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title text-dark text-gradient">Lista de Permisos</h6>
					<div class="toolbar">
						<!--        Here you can write extra buttons/actions for the toolbar              -->
					</div>
					<div class="table-responsive">
						<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" ref="vuetable">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Nombre de Muestra</th>
									<th>Creación</th>
									<th>Actualización</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Nombre de Muestra</th>
									<th>Creación</th>
									<th>Actualización</th>
								</tr>
							</tfoot>
						</table>
						<!-- end content-->
					</div>
					<!--  end card  -->
				</div>
				<!-- end col-md-12 -->
			</div>
		</div>
	</app-layout>
</template>
<script>
import AppLayout from '@/Pages/Admin/Layouts/AppLayout'

export default {
	components: {
		AppLayout,
	},

	data() {
		return {
			data: [],
			table: null
		}
	},

	mounted(){
		this.datatables();
	},

	methods: {
		datatables() {
			this.$nextTick(() => {
				const self = this;
				$.fn.dataTable.ext.errMode = 'none';
				self.table = $('#datatables').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/permissions/list",
					"columns": [
					{data : 'id'},
					{data : 'name'},
					{data : 'display_name'},
					{data : 'created_at'},
					{data : 'updated_at'},
					],
					"pagingType": "full_numbers",
					"lengthMenu": [
					[10, 25, 50, 100],
					[10, 25, 50, 100]
					],
					responsive: false,
					"language": {
						"lengthMenu": '_MENU_',
						"sSearch": '',
						"emptyTable": "Ningún dato disponible en esta tabla",
						"processing": "Procesando...",
						"sInfo": "Mostrando _TOTAL_ registros",
						"sSearchPlaceholder": "Buscar...",
						"zeroRecords": "No se encontraron resultados",
						"sInfoEmpty": "Mostrando 0 de 0 registros",
						"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
						"paginate": {
							"first": "Primera Página",
							"next": '<i class="fas fa-chevron-right"></i>',
							"previous": '<i class="fas fa-chevron-left"></i>',
							"last": "Última Página"
						}
					},
					"drawCallback": function( settings ) {
						var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
						var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
							return new bootstrap.Tooltip(tooltipTriggerEl)
						})
				    }
				});
			})
		}
	},
}
</script>