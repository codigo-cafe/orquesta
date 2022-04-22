<template>
	<app-layout>
		<Counts :counts="counts"/>
		<div class="row">
			<div class="col-12 mt-2">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title text-dark text-gradient">Lista de Usuarios</h6>
						<div class="toolbar">
							<div class="row">
			                    <div class="col-sm-auto">
			                        <label class="control-label">Buscar registros</label>
	                        		<div class="input-group mb-4">
	                        			<span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
	                        			<input class="form-control" id="Filter" placeholder="Buscar Usuario" type="text" >
	                        		</div>
			                    </div>
			                    <div class="col-sm-auto">
			                    	<label class="control-label ms-4">Estado</label><br>
			                    	<div class="form-check form-check-radio form-check-inline">
			                    		<div class="form-check">
				                    		<input class="form-check-input" type="radio" name="searchEstado" id="inlineRadio1" value="Todos" checked>
				                    		<label class="form-check-label" for="inlineRadio1">
				                    			Todos
				                    		</label>
				                    	</div>
			                    	</div>
			                    	<div class="form-check form-check-radio form-check-inline">
			                    		<div class="form-check">
				                    		<input class="form-check-input" type="radio" name="searchEstado" id="inlineRadio2" value="Activo">
				                    		<label class="form-check-label" for="inlineRadio2">
				                    			Activos
				                    		</label>
				                    	</div>
			                    	</div>
			                    	<div class="form-check form-check-radio form-check-inline">
			                    		<div class="form-check">
				                    		<input class="form-check-input" type="radio" name="searchEstado" id="inlineRadio3" value="Inactivo">
				                    		<label class="form-check-label" for="inlineRadio3">
				                    			Inactivos
				                    		</label>
				                    	</div>
			                    	</div>
			                    </div>
			                </div>
						</div>
						<div class="table-responsive">
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" ref="vuetable">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Apellidos</th>
										<th>Email</th>
										<th>Rol</th>
										<th>Estado</th>
										<th>Creación</th>
										<th>Actualización</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Apellidos</th>
										<th>Email</th>
										<th>Rol</th>
										<th>Estado</th>
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
		</div>
	</app-layout>
</template>
<script>
import AppLayout from '@/Pages/Admin/Layouts/AppLayout'
import Counts from '@/Pages/Admin/Partials/Counts'
import moment from 'moment';
import imgbase64 from '@/Pages/Admin/Reports/imgbase64';

export default {
	components: {
		AppLayout,
		Counts,
	},

	props: ['orchestra', 'events', 'points', 'services', 'promotions', 'members', 'users'],

	data() {
		return {
			data: [],
			counts: {
				events: this.events,
				points: this.points,
				services: this.services,
				promotions: this.promotions,
				members: this.members,
				users: this.users,
			},
			banner: imgbase64,
			table: null
		}
	},

	mounted() {
		this.datatables();
	},

	methods: {
		reload() {
			this.table.ajax.reload( null, false );
		},

		datatables() {
			this.$nextTick(() => {
				const self = this;
				$.fn.dataTable.ext.errMode = 'none';
		        var titulo = "Reporte de Usuarios";
		        var anchos = ['5%', '15%', '15%', '10%', '15%', '10%', '15%', '15%'];
				self.table = $('#datatables').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/users/list",
					"columns": [
					{data : 'id'},
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
						"targets": [5],
						"data": "status",
						"render": function(data,type,full){
							if (data == 1) {
								return '<span class="badge badge-success">Activo</span>';
							} else {
								return '<span class="badge badge-danger">Inactivo</span>';
							}
						}
					},
					],

		            buttons: [{
		                extend: 'pdf',
		                text: '<i class="fas fa-print"></i> Generar Reporte',
		                download: 'open',
		                className: 'btn-cafe margin-right',
		                messageTop: null,
		                //messageBottom: 'Bottom',
		                title: function () { return titulo; },
		                exportOptions: {
		                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
		                },
		                pageSize: 'LETTER',
		                orientation: 'landscape',
		                customize: function (doc) {
		                    doc.content[1].table.widths = anchos;

		                    var rowCount = doc.content [1] .table.body.length;
		                    for (var i = 0; i <rowCount; i ++) {
		                        doc.content [1].table.body [i] [0].alignment = 'center';
		                        doc.content [1].table.body [i] [1].alignment = 'left';
		                        doc.content [1].table.body [i] [2].alignment = 'left';
		                        doc.content [1].table.body [i] [3].alignment = 'left';
		                        doc.content [1].table.body [i] [4].alignment = 'left';
		                        doc.content [1].table.body [i] [5].alignment = 'left';
		                        doc.content [1].table.body [i] [6].alignment = 'left';
		                        doc.content [1].table.body [i] [7].alignment = 'left';
		                    }

		                    doc.pageMargins = [40, 130, 40, 40];
		                    doc.styles.title = {
		                        color: '#1B3043',
		                        fontSize: '14',
		                        background: 'white',
		                        alignment: 'left',
		                        bold: true
		                    };
		                    // Create a header object with 3 columns
		                    doc['header']=(function() {
		                        return {
		                            columns: [
		                                {
		                                    alignment: 'left',
		                                    image: self.banner,
		                                    //fit: [80, 80],
		                                    width: 180,
		                                    height: 87
		                                },
		                                {
		                                    alignment: 'right',
		                                    text: 'Persona: ' + self.$page.props.user.person.name + " " + self.$page.props.user.person.surnames + '\n'+ 'Usuario: ' + self.$page.props.user.email,
		                                    fontSize: 10
		                                }
		                            ],
		                            margin: [40, 40]
		                        }
		                    });
		                    var fecha = moment().format("DD/MM/YYYY  HH:mm:ss");
		                    // Create a footer
		                    doc['footer']=(function(page, pages) {
		                        return {
		                            columns: [
		                                {
		                                    alignment: 'left',
		                                    text:'Fecha: '+ fecha,
		                                    fontSize: 10
		                                },
		                                {
		                                    alignment: 'right',
		                                    text: ['Pág. ', { text: page.toString() },  ' de ', { text: pages.toString() }]
		                                }
		                            ],
		                            margin: [40, 0]
		                        }
		                    });
		                },
		            }],
					"pagingType": "full_numbers",
					"lengthMenu": [
					[10, 25, 50, 100],
					[10, 25, 50, 100]
					],
					responsive: false,
					"dom": 'Brtip',
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
				$('#Filter').on('keyup', function(){
					self.table.search(this.value).draw();
				});
				$('input[type=radio][name=searchEstado]').change(function() {
					if (this.value == 'Todos'){
						self.table.columns(5).search('').draw()
					}else if (this.value == 'Activo') {
						self.table.columns(5).search(1).draw();
					}else if (this.value == 'Inactivo') {
						self.table.columns(5).search(0).draw();
					}
				});
			})
		}
	},
}
</script>