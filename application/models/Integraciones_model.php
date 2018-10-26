<?php
class Integraciones_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function integraciones()
    {
        $i = 0;
        $json = array();
        $query = $this->db->query("SELECT *, 
        (select distinct CodVendedor from SCGRMS_DOCUMENTOS_DETALLE where NumDoc = SCGRMS_DOCUMENTOS.NumDoc) 'Ruta' 
         from SCGRMS_DOCUMENTOS
        where EstadoIntegra = 'I'");
        foreach ($query->result_array() as $key ) {
          $json["data"][$i]["FechaDoc"] = $key["FechaDoc"];
          $json["data"][$i]["NumRef"] = $key["NumRef"];
          $json["data"][$i]["Ruta"] = $key["Ruta"];
          $json["data"][$i]["CodSN"] = $key["CodSN"];
          $json["data"][$i]["NombreSN"] = $key["NombreSN"];
          $json["data"][$i]["Ruta"] = $key["Ruta"];
          $json["data"][$i]["Details"] = "<a onclick='Detalles(".'"'.$key["NumRef"].'"'.")' href='#modalDetalles' class='btn btn-floating gray modal-trigger'>
          <i class='material-icons'>toc</i></a>";
          $i++;              
        }
        echo json_encode($json);
    }

    public function getFacturasDet($serie)
    {
        $i = 0;
        $json = array();
        $query = $this->db->query("SELECT T0.IdDoc AS 'IdDoc', T0.NumDoc AS 'NumDoc', T0.CodSN AS 'CodSN', T0.NombreSN AS 'NombreSN',
         T0.NumRef AS 'NumRef', T0.FechaDoc AS 'FechaDoc',
        CASE
        T0.EstadoIntegra WHEN 'I' THEN 'Pendiente' else '' end 'Estado',
        T0.CodVendedor AS 'CodVendedor',
        CASE
        T0.CodCondPago WHEN '-1' THEN 'Contado' else 'Credito' end 'Condicion de Pago', 
        T1.CodArticulo AS 'CodArticulo', T1.Cantidad AS 'Cantidad', T1.Precio AS 'Precio', T1.CodImpuesto AS 'CodImpuesto'
        fROM dbo.SCGRMS_DOCUMENTOS T0
        inner join dbo.SCGRMS_DOCUMENTOS_DETALLE T1 on T0.IdDoc =T1.IdDoc
        WHERE T0.EstadoIntegra ='I' and T0.NumRef = "."'".$serie."'"." ");
        foreach($query->result_array() as $key)
        {
            $json["data"][$i]["IdDoc"] = $key["IdDoc"];
            $json["data"][$i]["NumDoc"] = $key["NumDoc"];
            $json["data"][$i]["CodSN"] = $key["CodSN"];
            $json["data"][$i]["NombreSN"] = $key["NombreSN"];
            $json["data"][$i]["NumRef"] = $key["NumRef"];
            $json["data"][$i]["FechaDoc"] = $key["FechaDoc"];
            $json["data"][$i]["Estado"] = $key["Estado"];
            $json["data"][$i]["CodVendedor"] = $key["CodVendedor"];
            $json["data"][$i]["Condicion de Pago"] = $key["Condicion de Pago"];
            $json["data"][$i]["CodArticulo"] = $key["CodArticulo"];
            $json["data"][$i]["Cantidad"] = $key["Cantidad"];
            $json["data"][$i]["Precio"] = $key["Precio"];
            $json["data"][$i]["CodImpuesto"] = $key["CodImpuesto"];
            $i++;
        }
        echo json_encode($json);
        
    }
}
?>