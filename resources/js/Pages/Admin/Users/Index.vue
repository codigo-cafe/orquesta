<template>
	<app-layout>
		<div class="col-12 mt-2">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title text-dark text-gradient">Lista de Usuarios del Sistema</h6>
					<div class="d-flex justify-content-end" v-if="hasAnyPermission(['create_users'])">
						<div class="dropdown">
							<a href="javascript:;" class="btn btn-dim dropdown-toggle " data-bs-toggle="dropdown" id="menuUser">
								<i class="fas fa-plus"></i> Registrar Usuario
							</a>
							<ul class="dropdown-menu" aria-labelledby="menuUser">
								<li>
									<span class="dropdown-item" @click="openModal('auto')">
										Contraseña autogenerada
									</span>
								</li>
								<li>
									<span class="dropdown-item" @click="openModal('manual')">
										Contraseña manual
									</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="toolbar">
						<!--        Here you can write extra buttons/actions for the toolbar              -->
					</div>
					<div class="table-responsive">
						<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" ref="vuetable">
							<thead>
								<tr>
									<th>#</th>
									<th>Foto</th>
									<th>Nombre</th>
									<th>Apellidos</th>
									<th>Email</th>
									<th>Rol</th>
									<th>Estado</th>
									<th>Creación</th>
									<th>Actualización</th>
									<th class="disabled-sorting text-right">Acciones</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Foto</th>
									<th>Nombre</th>
									<th>Apellidos</th>
									<th>Email</th>
									<th>Rol</th>
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
		<modal-create-auto :people="people" :roles="roles" :reload="reload" :showNotification="showNotification"></modal-create-auto>
		<modal-create-manual :people="people" :roles="roles" :reload="reload" :showNotification="showNotification"></modal-create-manual>
		<modal-edit :people="people" :roles="roles" :data="data" :reload="reload" :showNotification="showNotification"></modal-edit>
		<modal-confirm :data="data" :options="options" :reload="reload" :showNotification="showNotification"></modal-confirm>
	</app-layout>
</template>
<script>
import AppLayout from '@/Pages/Admin/Layouts/AppLayout'
import ModalCreateAuto from '@/Pages/Admin/Users/CreateAuto'
import ModalCreateManual from '@/Pages/Admin/Users/CreateManual'
import ModalEdit from '@/Pages/Admin/Users/Edit'
import ModalConfirm from '@/Pages/Admin/Partials/Confirm'

export default {
	components: {
		AppLayout,
		ModalCreateAuto,
		ModalCreateManual,
		ModalEdit,
		ModalConfirm,
	},

	props: ['roles'],

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
			people: [],
			table: null,
			options: {
				url: '',
				message: '',
				btnText: '',
				btnClass: '',
				iconClass: '',
			},
		}
	},

	mounted(){
		this.datatables();
	},

	methods: {
		reload() {
			this.table.ajax.reload( null, false );
		},

		openModal(mode) {
			if (this.hasAnyPermission(['create_users'])) {
				axios.get(this.route('users.create'))
				.then(response => {
					this.people = response.data;
				})
				.catch(function (error) {
				    console.log(error);
				})
				.then(function () {
					if (mode === 'auto') {
						var myModalAuto = new bootstrap.Modal(document.getElementById('ModalCreateAuto'), {
							keyboard: false
						});
						myModalAuto.show();
					} else if(mode === 'manual'){
						var myModalManual = new bootstrap.Modal(document.getElementById('ModalCreateManual'), {
							keyboard: false
						});
						myModalManual.show();
					}
				});
			}
		},

		edit(data) {
			var mensaje = '';
			if (this.hasAnyPermission(['edit_users'])) {
				axios.get(this.route('users.edit', data.id))
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
			if (this.hasAnyPermission(['restore_users']) && data.roles[0].name != 'Super Admin') {
				this.data = data;
				this.options.url = 'users.restore';
				this.options.message = 'Está seguro de habilitar al usuario: ';
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
			if (this.hasAnyPermission(['delete_users']) && data.roles[0].name != 'Super Admin') {
				this.data = data;
				this.options.url = 'users.destroy';
				this.options.message = 'Está seguro de inhabilitar al usuario: ';
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
					"ajax": "users/list",
					"columns": [
					{data : 'id'},
					{data : null, orderable: false, searchable: false},
					{data : 'person.name'},
					{data : 'person.surnames'},
					{data : 'email'},
					{data : 'roles[, ].name', orderable: false, searchable: false},
					{data : 'status'},
					{data : 'created_at'},
					{data : 'updated_at'},
					],
					"columnDefs": [
					{
						"searchable": false,
						"orderable": false,
						"targets": [1],
						"data": null,
						"render": function(data,type,full){
							if (data.person.profile_photo_path) {
								return '<img class="avatar avatar-sm rounded-circle shadow" src="'+data.person.profile_photo_path+'" alt="off_white">';
							} else {
								return '<img class="avatar avatar-sm rounded-circle shadow" src="/img/profile.png" alt="off_white">';
							}
						}
					},
					{
						"targets": [6],
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
						"targets": [9],
						"className": "text-right",
						"data": null,
						"render": function(data,type,full){
							var botones = '';
							if (data.can.edit_users && data.id != 1) {
								botones = botones+'<button type="button" class="btn btn-icon-sm btn-gray bg-gradient-gray btn-icon-only rounded-circle mb-0 me-1 ms-1 edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">'+
								'<span class="btn-inner--icon"><i class="fas fa-pen"></i></span>'+
								'</button>';
							}
							if (data.status == 1 && data.can.delete_users && data.roles[0].name != 'Super Admin') {
								botones = botones+'<button type="button" class="btn btn-icon-sm btn-danger bg-gradient-danger btn-icon-only rounded-circle mb-0 delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Inhabilitar">'+
								'<span class="btn-inner--icon"><i class="fas fa-ban"></i></span>'+
								'</button>';
							}
							if (data.status == 0 && data.can.restore_users) {
								botones = botones+'<button type="button" class="btn btn-icon-sm btn-success bg-gradient-success btn-icon-only rounded-circle mb-0 restore" data-bs-toggle="tooltip" data-bs-placement="top" title="Habilitar">'+
								'<span class="btn-inner--icon"><i class="fas fa-check"></i></span>'+
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

				$('#datatables').on('click', '.message, .edit, .delete, .restore', function (e) {
					e.preventDefault();
					var data = self.table.row($(this).parents('tr')).data();

					if($(this).hasClass('edit') == true){
						self.edit(data);
					} else if($(this).hasClass('restore') == true){
						self.restore(data);
					} else if($(this).hasClass('delete') == true){
						self.destroy(data);
					}
				});
			})
		}
	},
}
</script>