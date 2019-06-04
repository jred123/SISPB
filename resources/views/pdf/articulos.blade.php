<table>
    <thead>
    <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Código</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Sucursal</th>
            <th>Stock</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Estado</th> 
        
    </tr>
    </thead>
    <tbody>
    @foreach($articulos as $a)
        <tr>
                <td>{{$a->nombre_marca}}</td>
                <td>{{$a->nombre}}</td>
                <td>{{$a->codigo}}</td>
                <td>{{$a->precio_compra}}</td>
                <td>{{$a->precio_venta}}</td>       
                <td>{{$a->nombre_sucursal}}</td>
                <td>{{$a->stock}}</td>
                <td>{{$a->created_at}}</td>
                <td>{{$a->nomp}}</td>
                <td><?php If ($a->condicion == "1")
                    {
                    ?>Activo<?php } else {
                         If ($a->condicion == "4"){?> Ocasional<?php

                         }
                    } ?></td>
            
        </tr>
    @endforeach
    </tbody>
</table>