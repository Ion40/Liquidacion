<script>
$(document).ready(function(){
    $("#tblDatos").DataTable({
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
    $("#tblDatos").DataTable({
        responsive: true,
        "autoWidth":false,
        "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         false,
        "ajax": "index.php/IncomigData/"+ ruta +"/"+ f1 + "/"+ f2,
        "destroy": true,
        "columns":[
            { "data": "FECHA" },
            { "data": "CODARTICULO" },
            { "data": "DESCRIPCION" },
            { "data": "UNID1" },
            { "data": "PRECIO" },
            { "data": "TOTAL" },
            { "data": "LIBRASVENDIDAS" }
        ],
        columnDefs: [{
            targets: 0,
            render: function (d){
                return moment(d.date).format("DD/MM/YYYY");
            }
          },
          {
            targets: 5,
            render: $.fn.dataTable.render.number( ',', '.', 2, /*'$'*/ )
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
            var table = $('#tblDatos').DataTable();
            $("#spanCount").html(table.rows().count());
        },
        "footerCallback": function ( row, data, start, end, display ) {
        uni = this.api().column(3).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
        $(this.api().column(3).footer()).html(uni.toFixed(2));

        total = this.api().column(5).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
        $(this.api().column(5).footer()).html(total.toFixed(2));
        
        lib = this.api().column(6).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
        $(this.api().column(6).footer()).html(lib.toFixed(2));
    }
    });
});  
</script>