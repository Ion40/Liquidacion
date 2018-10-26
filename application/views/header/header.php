<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <link rel="shortcut icon" href="<?PHP echo base_url();?>assets/img/LOGOS_DELMOR.png">
	<title>Liquidación de Productos</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/materialize.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap-select.min.css">	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/chosen.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/fuente.css">
    <link href="<?php echo base_url()?>assets/css/buttons.dataTables.min.css" rel="stylesheet"/>

</head>
<body>
	<nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">
      	<img src="<?php echo base_url()?>assets/img/cashier.png" width="60">
         <span class="right">
         	<?php echo $this->uri->segment("1")?>
         </span>
      </a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="hide-on-med-and-down right" style="margin-right:5em;">
        <li><a href="<?php echo base_url()?>">Liquidación por unidades</a></li>
        <li><a href="<?php echo base_url('index.php/Facturas')?>">Facturas</a></li>
        <li><a href="<?php echo base_url('index.php/Integraciones')?>">Facturas no integradas</a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
      <li><a href="<?php echo base_url()?>">Liquidación por unidades</a></li>
      <li><a href="<?php echo base_url('index.php/Facturas')?>">Facturas</a></li>
  </ul>
  <br><br>