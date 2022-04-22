<template>
	<app-layout>
		<div class="col-12 mt-2">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title text-dark text-gradient">Lista de Roles</h6>
					<div class="d-flex justify-content-end" v-if="hasAnyPermission(['create_roles'])">
						<button type="button" class="btn btn-dim" @click="openModal">
							<i class="fas fa-plus"></i> Registrar Rol
						</button>
					</div>
					<div class="toolbar">
						<!--        Here you can write extra buttons/actions for the toolbar              -->
					</div>
					<div class="table-responsive">
						<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" ref="vuetable">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Estado</th>
									<th>Creación</th>
									<th>Actualización</th>
									<th class="disabled-sorting text-right">Acciones</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Estado</th>
									<th>Creación</th>
									<th>Actualización</th>
									<th class="text-right">Acciones</th>
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
		<!-- Modal Create -->
		<modal-create :permissions="permissions" :reload="reload" :showNotification="showNotification"></modal-create>
		<modal-edit :permissions="permissions" :data="data" :reload="reload" :showNotification="showNotification"></modal-edit>
		<modal-confirm :data="data" :options="options" :reload="reload" :showNotification="showNotification"></modal-confirm>
	</app-layout>
</template>
<script>
import AppLayout from '@/Pages/Admin/Layouts/AppLayout'
import ModalCreate from '@/Pages/Admin/Roles/Create'
import ModalEdit from '@/Pages/Admin/Roles/Edit'
import ModalConfirm from '@/Pages/Admin/Partials/Confirm'

export default {
	components: {
		AppLayout,
		ModalCreate,
		ModalEdit,
		ModalConfirm
	},

	props: ['permissions'],

	data() {
		return {
			data: [],
			options: {
				url: '',
				message: '',
				btnText: '',
				btnClass: '',
				iconClass: '',
			},
			table: null
		}
	},

	mounted(){
		this.datatables();
	},

	methods: {
		reload() {
			this.table.ajax.reload( null, false );
		},

		openModal() {
			if (this.hasAnyPermission(['create_roles'])) {
				var myModal = new bootstrap.Modal(document.getElementById('ModalCreate'), {
					keyboard: false
				});
				myModal.show();
			}
		},

		edit(data) {
			var mensaje = '';
			if (this.hasAnyPermission(['edit_roles'])) {
				axios.get(this.route('roles.edit', data.id))
				.then(response => {
					this.data = response.data;
				})
				.catch(error => {
                    if (error.response.status == 403) {
                        mensaje = 'Esta acción no está autorizada';
                    }
                })
				.then(response => {
					if (mensaje != '') {
	                    this.showNotification(mensaje, 'warning');
	                } else {
						var myModal = new bootstrap.Modal(document.getElementById('ModalEdit'), {
							keyboard: false
						});
						myModal.show();
	                }
				});
			}
		},

		restore(data) {
			if (this.hasAnyPermission(['restore_roles'])) {
				this.data = data;
				this.options.url = 'roles.restore';
				this.options.message = 'Está seguro de habilitar el rol: ';
				this.options.btnText = 'Habilitar';
				this.options.btnClass = 'btn-success bg-gradient-success';
				this.options.iconClass = 'fa-check text-success';
				var myModal = new bootstrap.Modal(document.getElementById('ModalConfirm'), {
					keyboard: false
				});
				myModal.show();
			}
		},

		destroy(data) {
			if (this.hasAnyPermission(['delete_roles'])) {
				this.data = data;
				this.options.url = 'roles.destroy';
				this.options.message = 'Está seguro de inhabilitar el rol: ';
				this.options.btnText = 'Inhabilitar';
				this.options.btnClass = 'btn-danger bg-gradient-danger';
				this.options.iconClass = 'fa-ban text-danger';
				var myModal = new bootstrap.Modal(document.getElementById('ModalConfirm'), {
					keyboard: false
				});
				myModal.show();
			}
		},

		showNotification: function(message, type) {
			$.notify({
				icon: "fas fa-check",
				message: message
			}, {
				type: type,
				timer: 3000,
				mouse_over: 'pause',
				placement: {
					from: 'top',
					align: 'right',
				},
				onShow: function() {
					this.css({'width':'400px','height':'auto'});
				},
		    });
		},

		datatables() {
			this.$nextTick(() => {
				const self = this;
				$.fn.dataTable.ext.errMode = 'none';
				self.table = $('#datatables').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/roles/list",
					"columns": [
					{data : 'id'},
					{data : 'name'},
					{data : 'status'},
					{data : 'created_at'},
					{data : 'updated_at'},
					],
					"columnDefs": [
					{
						"targets": [2],
						"data": "status",
						"render": function(data,type,full){
							if (data == 1) {
								return '<span class="badge badge-success">Activo</span>';
							} else {
								return '<span class="badge badge-danger">Inactivo</span>';
							}
						}
					},
					{
						"searchable": false,
						"orderable": false,
						"targets": [5],
						"className": "text-right",
						"data": null,
						"render": function(data,type,full){
							var botones = '';
							if (data.can.edit_roles && data.name != 'Super Admin') {
								botones = botones+'<button type="button" class="btn btn-icon-sm btn-gray bg-gradient-gray btn-icon-only rounded-circle mb-0 me-1 ms-1 edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">'+
							'<span class="btn-inner--icon"><i class="fas fa-pen"></i></span>'+
							'</button>';
							}
							if (data.status == 0 && data.can.restore_roles) {
								botones = botones+'<button type="button" class="btn btn-icon-sm btn-success bg-gradient-success btn-icon-only rounded-circle mb-0 restore" data-bs-toggle="tooltip" data-bs-placement="top" title="Habilitar">'+
							'<span class="btn-inner--icon"><i class="fas fa-check"></i></span>'+
							'</button>';
							}
							if (data.status == 1 && data.can.delete_roles && data.name != 'Super Admin') {
								botones = botones+'<button type="button" class="btn btn-icon-sm btn-danger bg-gradient-danger btn-icon-only rounded-circle mb-0 delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Inhabilitar">'+
							'<span class="btn-inner--icon"><i class="fas fa-ban"></i></span>'+
							'</button>';
							}
							return botones;
						}
					}
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

				$('#datatables').on('click', '.edit, .restore, .delete', function (e) {
					e.preventDefault();
		            var data = self.table.row($(this).parents('tr')).data();

					if ($(this).hasClass('edit') == true) {
						self.edit(data);
		            } else if($(this).hasClass('restore') == true){
		            	self.restore(data);
		            } else {
		            	self.destroy(data);
		            }
		        });
			})
		}
	},
}
</script>