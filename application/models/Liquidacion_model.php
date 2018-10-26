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
                where av.CODALMACEN = '".$ruta."' and (av.FECHA BETWEEN '".$fecha1."' and '".$fecha2."') --and s.STOCK > '0' 
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
            $json["data"][$i]["TOTALNETO"] = number_format($key["TOTALNETO"],2);
            $json["data"][$i]["Stock"] = "<p id='Stock".$key["CODARTICULO"]."'></p>";
            $json["data"][$i]["DEVOL"] = "<p id='devol".$key["CODARTICULO"]."'></p>";
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();

    }

    public function getStock($codal,$codArt)
    {
        $i = 0;
        $json = array();
        $query = $this->sqlsrv->fetchArray(
            "SELECT CODARTICULO,CODALMACEN, SUM(STOCK) AS STOCK FROM STOCKS
             WHERE CODALMACEN = '".$codal."' AND CODARTICULO = ".$codArt."
             GROUP BY CODARTICULO,CODALMACEN
            ", SQLSRV_FETCH_ASSOC); 
             foreach ($query as $key ) {
                $json[$i]["CODARTICULO"] = $key["CODARTICULO"];
                $json[$i]["CODALMACEN"] = $key["CODALMACEN"];
                $json[$i]["STOCK"] = $key["STOCK"];
                $i++;
            }
            echo json_encode($json);
            $this->sqlsrv->close();
    }

    public function getCredito($ruta,$fecha1,$fecha2)
    {
        $i = 0;
        $json = array();
        $query = $this->sqlsrv->fetchArray(
            "SELECT sum(FV.TOTALBRUTO) AS SUMTOTALBRUTO,
            count(T.ESTADO) AS NUMCLIENTES,
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
            WHERE   CL.FECEXPORT IS NULL AND FV.N = 'B' AND FV.FECHA BETWEEN '".$fecha1."' and '".$fecha2."' AND A.CODALMACEN = '".$ruta."' 
            and T.ESTADO = 'P'
            GROUP BY T.ESTADO
            ", SQLSRV_FETCH_ASSOC); 
                foreach ($query as $key) {
                    $json[$i]["SUMTOTALBRUTO"] = $key["SUMTOTALBRUTO"];
                    $json[$i]["NUMCLIENTES"] = $key["NUMCLIENTES"];
                    $i++;
                }
            
            echo json_encode($json);
            $this->sqlsrv->close();
    }
}

?>