<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Liquidacion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function GetRutas()
    {
        $query = $this->sqlsrv->fetchArray(
        "SELECT CODALMACEN FROM AA_AGRUPACION_VENTA
         GROUP BY CODALMACEN 
         ORDER BY CODALMACEN ASC", SQLSRV_FETCH_ASSOC
         );

         if ($query) {
             return $query;
         }
         $this->sqlsrv->close();
    }

    public function getData($ruta,$fecha1,$fecha2)
    {
        $i = 0;
        $json = array();
        $query = $this->sqlsrv->fetchArray(
            "SELECT DISTINCT av.FECHA as FECHA,av.CODARTICULO as CODARTICULO ,av.REFERENCIA as REFERENCIA, 
                av.DESCRIPCION as DESCRIPCION, SUM(av.UNID1) AS UNID1,av.PRECIO as PRECIO, av.DTO as DTO,
                av.IVA as IVA,av.CARGO1 as CARGO1, av.CODVENDEDOR as CODVENDEDOR, av.CODALMACEN as CODALMACEN
                ,SUM(av.TOTAL) as TOTAL, al.PESOGRAMOS as PESOGRAMOS ,ROUND(sum(av.UNID1) * al.PESOGRAMOS / 454, 2) AS LIBRASVENDIDAS,
                (select SUM(TOTALNETO) from dbo.FACTURASVENTA
                where CODVENDEDOR = av.CODVENDEDOR and FECHA = av.FECHA) as TOTALNETO
                from AA_AGRUPACION_VENTA AS av
                LEFT OUTER JOIN ARTICULOSCAMPOSLIBRES AS al ON av.CODARTICULO = al.CODARTICULO
                inner join STOCKS s on av.CODARTICULO = s.CODARTICULO
                where av.CODALMACEN = '".$ruta."' and (av.FECHA BETWEEN '".$fecha1."' and '".$fecha2."') and s.STOCK > '0' 
                and s.CODALMACEN = av.CODALMACEN
                GROUP BY av.FECHA, av.CODARTICULO, av.REFERENCIA, av.DESCRIPCION, av.PRECIO, av.DTO, av.IVA,
                av.CARGO1, av.CODVENDEDOR, av.CODALMACEN,al.PESOGRAMOS, s.STOCK,av.FECHA
            ", SQLSRV_FETCH_ASSOC);
        foreach ($query as $key ) {
            $json["data"][$i]["FECHA"] = $key["FECHA"];
            $json["data"][$i]["CODARTICULO"] = $key["CODARTICULO"];
            $json["data"][$i]["REFERENCIA"] = $key["REFERENCIA"];
            $json["data"][$i]["DESCRIPCION"] = $key["DESCRIPCION"];
            $json["data"][$i]["UNID1"] = $key["UNID1"];
            $json["data"][$i]["PRECIO"] = $key["PRECIO"];
            $json["data"][$i]["DTO"] = $key["DTO"];
            $json["data"][$i]["IVA"] = $key["IVA"];
            $json["data"][$i]["CARGO1"] = $key["CARGO1"];
            $json["data"][$i]["CODVENDEDOR"] = $key["CODVENDEDOR"];
            $json["data"][$i]["CODALMACEN"] = $key["CODALMACEN"];
            $json["data"][$i]["TOTAL"] = $key["TOTAL"];
            $json["data"][$i]["PESOGRAMOS"] = $key["PESOGRAMOS"];
            $json["data"][$i]["LIBRASVENDIDAS"] = $key["LIBRASVENDIDAS"];
            $json["data"][$i]["TOTALNETO"] = $key["TOTALNETO"];
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();

    }
}

?>