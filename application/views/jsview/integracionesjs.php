<script>
$(document).ready(function () {
    $('.modal').modal();
  var table =  $("#tblfni").DataTable({
        "paging": false,
        "info": false,
        dom: 'Bfrtip',
            buttons: [
                'copy',
                'excel',
                'csv',
                'pdf',
                'print'  
            ],
        "language": {
            "info": "Registro _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Registro 0 a 0 de 0 entradas",
            "zeroRecords": "No se encontro coincidencia",
            "infoFiltered": "(filtrado de _MAX_ registros en total)",
            "emptyTable": "NO HAY DATOS DISPONIBLES",
            "lengthMenu": '_MENU_ ',
            "search": '<i class="material-icons">search</i>',
            "loadingRecords": "<div class='progress'>"+
                                 "<div class='indeterminate'></div>"+
                              "</div>", 
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "scrollY":"500px",
        "scrollCollapse": true,
         responsive: true,
         "ajax": "ShowIntegraciones",
         "destroy": true,
         "columns":[
             {"data":"FechaDoc"},
             {"data":"NumRef"},
             {"data":"Ruta"},
             {"data":"CodSN"},
             {"data":"NombreSN"},
             {"data":"Ruta"},
             {"data": "Details"}
         ],
       "initComplete": function (settings, json) {
            var tabla_init =  $("#tblfni").DataTable();
            $("#totalfni").html(tabla_init.rows().count());
         }  
    });

    setInterval(function(){
        table.ajax.reload();
        $("#totalfni").html(table.rows().count());
    },10000);
});

function Detalles(serie) {
	$("#NumRef").html(serie);
	$("#tblDetallesFact").DataTable({
		"paging": true,
		"info": false,
		/*dom: 'Bfrtip',
		    buttons: [
		        'copy',
		        'excel',
		        'csv',
		        'pdf',
		        'print'  
		    ],*/
		"language": {
			"info": "Registro _START_ a _END_ de _TOTAL_ entradas",
			"infoEmpty": "Registro 0 a 0 de 0 entradas",
			"zeroRecords": "No se encontro coincidencia",
			"infoFiltered": "(filtrado de _MAX_ registros en total)",
			"emptyTable": "NO HAY DATOS DISPONIBLES",
			"lengthMenu": '_MENU_ ',
			"search": '<i class="material-icons">search</i>',
			"loadingRecords": "<div class='progress'>" +
				"<div class='indeterminate'></div>" +
				"</div>",
			"paginate": {
				"first": "Primera",
				"last": "Última ",
				"next": "Siguiente",
				"previous": "Anterior"
			}
		},
		"scrollY": "300px",
		"scrollCollapse": true,
		responsive: true,
		"ajax": "GetFacturasDet/" + serie,
		"destroy": true,
		"columns": [{
				"data": "FechaDoc"
			},
			{
				"data": "CodVendedor"
			},
			{
				"data": "Condicion de Pago"
			},
			{
				"data": "CodArticulo"
			},
			{
				"data": "Cantidad"
			},
			{
				"data": "Precio"
			},
			{
				"data": "CodImpuesto"
			},
			{
				"data": "Estado"
			}
		],
		columnDefs: [{
				targets: 0,
				render: function (d) {
					return moment(d.date).format("DD/MM/YYYY");
				}
			},
			{
				targets: [4,5],
				render: $.fn.dataTable.render.number(',', '.', 2, /*'$'*/ )
			}
		]
	});
}
</script>