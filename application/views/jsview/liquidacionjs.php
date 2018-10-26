<script>
$(document).ready(function(){
    $("#tblDatos").DataTable({
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
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});


$("#btnCalcular").click(function () {
	var ruta = $("#Rutas option:selected").val(),
		f1 = $("#fecha1").val(),
		f2 = $("#fecha2").val();
	if (ruta == "") {
        var toastHTML = '<span>Seleccione una ruta!</span>';
        M.toast({html: toastHTML, classes:'orange-text rounded'});
	} else if(f1 == "" || f2 == "") {
        var toastHTML = '<span>Debe ingresar ambas fechas para efectuar el calculo</span>';
        M.toast({html: toastHTML, classes:'red-text rounded'});
    }else{
		$("#tblDatos").DataTable({
			responsive: true,
			"autoWidth": false,
			dom: 'Bfrtip',
			buttons: [
				'copy',
				'excel',
				'csv',
				'pdf',
				'print'
			],
			"scrollY": "300px",
			"scrollCollapse": true,
			"paging": false,
			"ajax": "index.php/IncomigData/" + ruta + "/" + f1 + "/" + f2,
			"destroy": true,
			"columns": [
                {"data": "FECHA"},
				{"data": "CODARTICULO"},
				{"data": "DESCRIPCION"},
				{"data": "Stock"},
				{"data": "UNID1"},
				{"data": "PRECIO"},
				{"data": "TOTAL"},
				{"data": "LIBRASVENDIDAS"}
			],
			columnDefs: [{
					targets: 0,
					render: function (d) {
						return moment(d.date).format("DD/MM/YYYY");
					}
				},
				{
					targets: [5, 6],
					render: $.fn.dataTable.render.number(',', '.', 2, /*'$'*/ )
				}
			],
			"paging": false,
			"pagingType": "full_numbers",
			"lengthMenu": [
				[5, 10, 100, -1],
				[5, 10, 100, "Todo"]
			],
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
			"initComplete": function (settings, json) {
				var table = $('#tblDatos').DataTable();
				$("#spanCount").html(table.rows().count());
				recorrer(ruta, f1, f2);
				GetStocks(ruta);
				getCredito(ruta, f1, f2)
			},
			"footerCallback": function (row, data, start, end, display) {
				var numFormat = $.fn.dataTable.render.number(',', '.', 2, /*'C$'*/ ).display;
				/*total = this.api().column(6).data().reduce(function (a, b) {
				        return parseFloat(a) + parseFloat(b);
				    }, 0 );
				$(this.api().column(6).footer()).html(numFormat(total));*/

				lib = this.api().column(7).data().reduce(function (a, b) {
					return parseFloat(a) + parseFloat(b);
				}, 0);
				$(this.api().column(7).footer()).html(numFormat(lib));
			}
		});
	}
});


function recorrer(ruta,f1,f2)
    {
        $.ajax({
            url: "index.php/IncomigData/"+ ruta +"/"+ f1 + "/"+ f2,
            type: "GET",
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(datos)
            {
                if (true)
                {
                    $.each( datos, function( key, value ) {
                        $("#spanNeto").html(value[0].TOTALNETO);
                    });
                }
            }
        });
    }

function GetStocks(ruta)
{
    var i = 0;
    var it= 0;
    var i2= 0;
    var unidades = new Array();
    var array = new Array();
    var t = $("#tblDatos").DataTable();
    t.rows().eq(0).each(function (index) {
    	var row = t.row(index);
    	var data = row.data();
    	array[i] = data.CODARTICULO;
        unidades[i] = data.UNID1;
        i++;
    });
    $.each(array, function (key , value) {
        $.ajax({
            url: "index.php/GetStock/"+ ruta + "/" + value,
            type: "GET",
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(datos)
            {
                if (true)
                {
                    $.each( datos, function( key, value ) {
                            $("#Stock"+value.CODARTICULO).text(value.STOCK);
                            /*$("#devol"+value.CODARTICULO).text(value.STOCK - unidades[i2]);
                            i2++;*/
                        });
                }
            }
        });
        it++;
    }); 
}

function getCredito(ruta,f1,f2)
{
    $.ajax({
            url: "index.php/GetCredito/"+ ruta + "/" + f1 + "/" + f2,
            type: "GET",
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(datos)
            {
                if (datos != "")
                {
                    $.each( datos, function( key, value ) {
                            $("#spanCredito").text(value.NUMCLIENTES);
                            $("#spanTotalCred").text(value.SUMTOTALBRUTO);
                });
            }else{
                $("#spanCredito").text("0");
                $("#spanTotalCred").text("0");
            }
        }
     });
}

</script>