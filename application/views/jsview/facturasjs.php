<script>    
$(document).ready(function(){
    $("#tblFacturas").DataTable({
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

$("#btnCalcular").click(function(){
    var ruta = $("#Rutas option:selected").val(), f1 = $("#fecha1").val(), f2 = $("#fecha2").val();
    $("#tblFacturas").DataTable({
        responsive: true,
        "autoWidth":false,
        dom: 'Bfrtip',
            buttons: [
                'copy',
                'excel',
                'csv',
                'pdf',
                'print' 
            ],
        "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         false,
        "ajax": "GetFacturas/"+ ruta +"/"+ f1 + "/"+ f2,
        "destroy": true,
        "columns":[
            { "data": "FECHA" },
            { "data": "HORA" },
            { "data": "NUMSERIE" },
            { "data": "NUMFACTURA"},
            { "data": "RUTA"},
            { "data": "CODCLIENTE" },
            { "data": "NOMBRECLIENTE" },
            { "data": "CODVENDEDOR" },
            { "data": "TOTALBRUTO" },
            { "data": "DTOCOMERCIAL"},
            { "data": "TOTALCARGOSDTOS"},
            { "data": "TOTALIMPUESTOS"},
            { "data": "TOTALNETO"}
        ],
        columnDefs: [{
            targets: 0,
            render: function (d){
                return moment(d.date).format("DD/MM/YYYY");
            }
          },
          {
            targets: 1,
            render: function (d){
                return moment(d.date).format("HH:mm");
            }
          },
         {
            targets: [8,10,11,12],
            render: $.fn.dataTable.render.number( ',', '.', 2, /*'$'*/)
          }
        ],
        "paging":false,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [5,10,100, -1],
            [5,10,100, "Todo"]
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
        "initComplete": function( settings, json ) {
            var table = $('#tblFacturas').DataTable();
            $("#spanCount").html(table.rows().count());
        },
        "footerCallback": function ( row, data, start, end, display ) {
         var numFormat = $.fn.dataTable.render.number( ',', '.', 2, 'C$').display;   
         total = this.api().column(12).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
          $(this.api().column(12).footer()).html(numFormat(total));
    }
    });
});

</script>