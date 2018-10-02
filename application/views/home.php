<div class="row">
	<div class="container">
		<div class="col s12 m12 l12">
			<div class="col s12 m12 l3 inline">
				<span class="">
					<i class="material-icons">contacts</i>
					Rutas
				</span>
				<select id="Rutas" class="browser-default chosen-select">
					<option selected disabled value="">selecciona una ruta</option>
					<?php
					   if (!$rutas) {
					   }else{
						   foreach ($rutas as $key) {
							   echo "<option value='".$key['CODALMACEN']."'>Ruta ".$key['CODALMACEN']."</option>";
						   }
					   }
					?>
				</select>
			</div>
			<div class="col s12 m12 l3 input-field inline">
				<label for="lbldesde" id="lbldesde">Desde</label>
				<i class="material-icons prefix">date_range</i>
				<input type="date" class="validate datepicker" name="" placeholder=" " id='fecha1'>
				<span class="helper-text" data-error="formato incorrecto" data-success=""></span>
			</div>
			<div class="col s12 m12 l3 input-field inline">
				<label for="lblhasta" id="lblhasta">Hasta</label>
				<i class="material-icons prefix">date_range</i>
				<input type="date" class="validate datepicker" name="" placeholder=" " id='fecha2'>
				<span class="helper-text" data-error="formato incorrecto" data-success=""></span>
			</div>
			<div class="col s12 m12 l3 ">
				<button id='btnCalcular' class="btn btn-large blue"><i class="material-icons left">search</i> Calcular</button>
			</div>
		</div>
	</div>
</div>
  <div class="row" style='margin-top:-15vh;'>
  <h6 class='col s3 m3 l3 center'>
    <strong>Productos Facturados: <span id='spanCount'>0</span></strong>
  </h6>
  <h6 class='col s3 m3 l3 left'>
    <strong>Total Neto: <span id='spanNeto'>0</span></strong>
  </h6>
  <h6 class='col s3 m3 l3 left'>
    <strong>Clientes Credito: <span id='spanCredito'>0</span></strong>
  </h6>
  <h6 class='col s3 m3 l3 left'>
    <strong>Total Credito: <span id='spanTotalCred'>0</span></strong>
  </h6>
  </div>
<div class="row" style='margin-top:-80px;'>
	<div class="container-fluid">
		<div class="col s12 m12 l12">
			<table id='tblDatos' class='table highlight striped compact'>
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Articulo</th>
						<th>Descripcion Articulo</th>
						<th>Stock</th>
						<th>Ventas</th>
						<th>Precio</th>
						<th>Total</th>
						<th>Libras Vendidas</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
				     <tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
</div>