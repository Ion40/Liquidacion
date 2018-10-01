<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DetalleFactura_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getFacturas($codalmacen,$f1,$f2)
    {
        $i = 0;
        $json = array();
        $query = $this->sqlsrv->fetchArray(
            "SELECT	FV.FECHA as FECHA, FV.HORA as HORA, FV.NUMSERIE as NUMSERIE, FV.NUMFACTURA as NUMFACTURA, FV.N as N, 
            FV.CODCLIENTE as CODCLIENTE, ISNULL(C.NOMBRECLIENTE, '''') AS NOMBRECLIENTE, ISNULL(C.NIF20,'''') AS NIF20, 
            AL.CODALMACEN AS RUTA, A.CENTROCOSTE as CENTROCOSTE,
            FV.CODVENDEDOR as CODVENDEDOR, V.NOMVENDEDOR as NOMVENDEDOR, FV.TOTALBRUTO as TOTALBRUTO, FV.DTOCOMERCIAL as DTOCOMERCIAL,
            FV.CODMONEDA as CODMONEDA,
            FV.TOTDTOCOMERCIAL as TOTDTOCOMERCIAL, FV.TOTALCARGOSDTOS as TOTALCARGOSDTOS, FV.TOTALIMPUESTOS as TOTALIMPUESTOS,
            FV.TOTALNETO as TOTALNETO,
            T.ESTADO as ESTADO, T.FECHAVENCIMIENTO as FECHAVENCIMIENTO,
            CASE WHEN T.ESTADO = 'P' THEN CAST(1 AS BIT) ELSE CAST(0 AS BIT) END AS CREDITO
            FROM	dbo.FACTURASVENTA FV
            INNER JOIN dbo.FACTURASVENTACAMPOSLIBRES CL ON CL.NUMSERIE = FV.NUMSERIE AND CL.NUMFACTURA = FV.NUMFACTURA AND CL.N = FV.N
            INNER JOIN dbo.CLIENTES C ON C.CODCLIENTE = FV.CODCLIENTE
            INNER JOIN dbo.VENDEDORES V ON V.CODVENDEDOR = FV.CODVENDEDOR
            INNER JOIN dbo.ALBVENTACAB AC ON FV.NUMSERIE = AC.NUMSERIEFAC AND FV.NUMFACTURA = AC.NUMFAC AND FV.N = AC.NFAC
            INNER JOIN dbo.ALBVENTALIN AL ON AL.NUMSERIE = AC.NUMSERIE AND AL.NUMALBARAN = AC.NUMALBARAN AND AL.N = AC.N AND AL.NUMLIN = 1
            INNER JOIN dbo.ALMACEN A ON AL.CODALMACEN = A.CODALMACEN
            INNER JOIN dbo.RUTAS R ON A.NOMBREALMACEN = R.DESCRIPCION
            INNER JOIN dbo.TESORERIA T ON FV.NUMSERIE = T.SERIE AND FV.NUMFACTURA = T.NUMERO AND FV.N = T.N 
            AND T.POSICION = 1 AND T.ORIGEN = 'C' AND T.TIPODOCUMENTO = 'F'
            WHERE   CL.FECEXPORT IS NULL AND FV.N = 'B' AND FV.FECHA BETWEEN '".$f1."' AND '".$f2."' AND A.CODALMACEN = '".$codalmacen."'  
            ORDER BY FV.NUMSERIE, FV.NUMFACTURA,FV.N
            ", SQLSRV_FETCH_ASSOC);
        foreach ($query as $key ) {
            $json["data"][$i]["FECHA"] = $key["FECHA"];
            $json["data"][$i]["HORA"] = $key["HORA"];
            $json["data"][$i]["NUMSERIE"] = $key["NUMSERIE"];
            $json["data"][$i]["NUMFACTURA"] = $key["NUMFACTURA"];
            $json["data"][$i]["N"] = $key["N"];
            $json["data"][$i]["CODCLIENTE"] = $key["CODCLIENTE"];
            $json["data"][$i]["NOMBRECLIENTE"] = $key["NOMBRECLIENTE"];
            $json["data"][$i]["NIF20"] = $key["NIF20"];
            $json["data"][$i]["RUTA"] = $key["RUTA"];
            $json["data"][$i]["CENTROCOSTE"] = $key["CENTROCOSTE"];
            $json["data"][$i]["CODVENDEDOR"] = $key["CODVENDEDOR"];
            $json["data"][$i]["NOMVENDEDOR"] = $key["NOMVENDEDOR"];
            $json["data"][$i]["TOTALBRUTO"] = $key["TOTALBRUTO"];
            $json["data"][$i]["DTOCOMERCIAL"] = $key["DTOCOMERCIAL"];
            $json["data"][$i]["CODMONEDA"] = $key["CODMONEDA"];
            $json["data"][$i]["TOTDTOCOMERCIAL"] = $key["TOTDTOCOMERCIAL"];
            $json["data"][$i]["TOTALCARGOSDTOS"] = $key["TOTALCARGOSDTOS"];
            $json["data"][$i]["TOTALIMPUESTOS"] = $key["TOTALIMPUESTOS"];
            $json["data"][$i]["TOTALNETO"] = $key["TOTALNETO"];
            $json["data"][$i]["ESTADO"] = $key["ESTADO"];
            $json["data"][$i]["FECHAVENCIMIENTO"] = $key["FECHAVENCIMIENTO"];
            $json["data"][$i]["CREDITO"] = $key["CREDITO"];
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
    }
}
?>