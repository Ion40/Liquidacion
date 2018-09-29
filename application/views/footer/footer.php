
<script type="text/javascript" src="<?PHP echo base_url();?>assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/js/extensions/dataTables.colVis.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/js/extensions/dataTables.tableTools.min.js"></script>

<script src="<?PHP echo base_url();?>assets/js/sum().js"></script>
<script src="<?PHP echo base_url();?>assets/js/materialize.min.js"></script>
<script src="<?PHP echo base_url();?>assets/js/materialize.js"></script>

<script src="<?PHP echo base_url(); ?>assets/js/sweetalert2.min.js"></script>
<script src="<?PHP echo base_url(); ?>assets/js/extensions/jquery.numeric.min.js"></script>

<script src="<?PHP echo base_url();?>assets/js/bootstrap.js"></script>
<script src="<?PHP echo base_url();?>assets/js/chosen.jquery.js"></script>
<script type="text/javascript">
	$('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        showWeekdaysFull: true,
        showClearBtn: true,
        i18n:{
            cancel: 'Cancelar',
            clear: 'Limpiar',
            done: 'Ok',
            months:[
                      'Enero',
                      'Febrero',
                      'Marzo',
                      'Abril',
                      'Mayo',
                      'Junio',
                      'Julio',
                      'Agosto',
                      'Septiembre',
                      'Octubre',
                      'Noviembre',
                      'Diciembre'
                    ],
            monthsShort:[
                          'En',
                          'Feb',
                          'Mar',
                          'Abr',
                          'May',
                          'Jun',
                          'Jul',
                          'Ago',
                          'Sep',
                          'Oct',
                          'Nov',
                          'Dic'
                        ],
             weekdays:[
                          'Domingo',
                          'Lunes',
                          'Martes',
                          'Miércoles',
                          'Jueves',
                          'Viernes',
                          'Sábado'
                        ],
             weekdaysShort:[
                              'Dom',
                              'Lun',
                              'Mar',
                              'Mie',
                              'Jue',
                              'Vie',
                              'Sab'
                            ],
              weekdaysAbbrev: ['D','L','M','T','J','V','S']                                    
        }
    });

    var config = {
        '.chosen-select': {

        }
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    $(document).ready(function(){
       $('.sidenav').sidenav();
    });
      
</script>
</body>
</html>