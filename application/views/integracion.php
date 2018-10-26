<div class="row">
	<div class="container">
		<div class="col s12 m12 l12" style='margin-top:-5vh;'>
           <p class='right'>
             Cantidad Facturas no integradas: 
              <span data-badge-caption="" class='new badge red' id='totalfni'>0</span>
           </p>
        </div>
        <div class="col s12 m12 l12">
            <div class="container-fluid">
              <table id='tblfni' class="table highlight striped compact">
                  <thead>
                      <tr>
                          <th>Fecha</th>
                          <th>Serie/Numero</th>
                          <th>Ruta</th>
                          <th>Cod. Cliente</th>
                          <th>Cliente</th>
                          <th>Vendedor</th>
                          <th>Detalles</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
            </div>
        </div>
	</div>
</div>

<div id="modalDetalles" class="modal" style='width:1200px; max-height:80% !important;'>
	<div class="modal-content">
        <h4 class="titulosGen center-align" style="color:black;"><strong>Numero referencia: <span id="NumRef"></span></strong></h4>
		<div class="row">
			<div class="col s12 m12 l12">
                <table class='table highlight striped compact' id='tblDetallesFact'>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Ruta</th>
                            <th>Condicion de Pago</th>
                            <th>Cod. Articulo</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Impuesto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
		<div class="row">
			<div class="col s12 m12 l12 center">
				<button class="btn btn-red waves-effect waves-light blue modal-close">Cerrar</button>
			</div>
		</div>
	</div>
</div>
