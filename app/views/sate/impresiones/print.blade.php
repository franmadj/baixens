<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formula de laboratorio valorada</title>
        <style type="text/css">
            body{
                font-family:Verdana, Geneva, sans-serif;
                font-size:10px;
            }
            h1{
                font-size:14px;	
            }
            .contenedor{
                width:100%;
                position:absolute;
                z-index:1;
                margin-top:180px;
            }
            table tr td{
                border: thin solid rgba(182,182,182,1.00);
                border-collapse: collapse;
                padding:3px;
            }
            table tr{
                width:100%;
            }
            table{
                width:700px;
                border-collapse:collapse;
                margin-left:5%; 
                margin-right:5%; 
                position:relative;
            }
            img{
                vertical-align: middle;
                padding-left: 10px;
            }
            img.body{
                vertical-align:top;
                padding-left: 0px;
            }
            .right{
                text-align:right !important;
                padding-right:10px;
                position:relative;
            }
            .left{
                text-align:left !important;
                padding-left:20px;
                position:relative;
            }
            .center{
                text-align:center !important;
            }
            strong{
                font-size:12px;
            }
            span.texto{
                font-size:10px;
            }
            small{
                font-size:10px;
                font-weight:600;
                color:#1865ab;
            }
        </style>
    </head>

    <body>

        <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0; z-index:0;">
            <img class="body" src="img/print/laboratorio_fondo.jpg" style="width: 210mm; height: 297mm; margin: 0;" />
        </div>

        <div class="contenedor">
            <table>
                <thead>
                    <tr>
                        <td style="text-align:center;" colspan="2"><h1>Formula SATE</h1></td> 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><small>Nombre:</small> <span class="texto">{{$formula->nombre}}</span>	</td>
                        <td><small>Sección:</small> <span class="texto">{{$formula->SeccionesFormula->seccion}}</span></td>
                    </tr>
                    <tr>
                        <td><small>Código fórmula:</small> <span class="texto">{{$formula->codigo}}</span>	</td>
                        <td><small>Número fórmula:</small> <span class="texto">{{$formula->numero_sate}}</span></td>
                    </tr>

                </tbody>

            </table>

            <table style="margin-top:20px; text-align:center;">
                <thead>
                    <tr>
                        <td><strong>CÓDIGO</strong>	</td>
                        <td><strong>PRODUCTO</strong>	</td>
                        <td><strong>CANTIDAD</strong>	</td>
                        <td><strong>COSTE</strong>	</td>
                        <td><strong>IMPORTE</strong>	</td>
                        <td><strong>PORCENTAJE</strong>	</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $numComp = $pesoTotal = $precioXkg = $totCoste = 0; ?>
                    @foreach($formula->FormulasDetalle as $formDet)
                    <?php
                    $numComp++;
                    $pesoTotal+=$formDet->cantidad;
                    $totCoste+=$formDet->Producto->coste * $formDet->cantidad;
                    ?>
                    @endforeach
                    <?php
                    $precioXkg = $totCoste / $pesoTotal;
                    ?>
                    @foreach($formula->FormulasDetalle as $formDet)
                    <tr>
                        <td class="right"><span class="texto">{{$formDet->Producto->codigo}}</span></td>
                        <td class="left"><span class="texto">{{$formDet->Producto->nombreProducto}}</span></td>
                        <td class="right"><span class="texto">{{ number_format($formDet->cantidad,3) }}</span></td>
                        <td class="right"><span class="texto">{{ isset($formDet->Producto->coste)?$formDet->Producto->coste:'sin precio' }}</span></td>
                        <td class="right"><input type="hidden" class="densidad" value="{{$formDet->Producto->densidad}}"><span class="texto">{{ number_format($formDet->Producto->coste * $formDet->cantidad, 3) }}</span></td>
                        <td class="right"><span class="texto">
                                {{ AppHelper::calcularPorcentaje($formDet->cantidad, $pesoTotal) }}</span>%</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>




        </div>


        <div style="clear:both;"></div>
    </div>



</body>

</html>
