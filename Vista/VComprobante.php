<div class="card-body table-responsive p-0">
  <h4 class="table-title"><strong>Lista de Comprobantes</strong></h4>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pedido</th>
                <th>Tipo</th>
                <th>DNI Cliente</th>
                <th>Fecha Emisión</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Entrega</th>
                <th>Total</th>
                <th>IGV</th>
                <th>Pago Final</th>
            </tr>
        </thead>
        <tbody id="TbData"></tbody>
    </table>
</div>
<script>
    window.load=getList('');

  function getList(bus){
    $.ajax({
      url: "Servicio/SComprobante.php",
      data: {tipo: 'list', txtbus: bus},
      type: 'get',
      success: function(e){
        let data=JSON.parse(e);
        let tabla="";
        for (let i = 0; i < data.length; i++) {
            tabla+="<tr>";
            tabla+="<td><span class='badge badge-warning'>"+data[i]['id_comprobante']+'</span></td>';
            tabla+="<td><span class='badge badge-danger'>"+data[i]['id_pedido']+'</span></td>';
            tabla+="<td>"+data[i]['tipo_comprobante']+'</td>';
            tabla+="<td>"+data[i]['dni_cliente']+'</td>';
            tabla+="<td>"+data[i]['fecha_emision']+'</td>';
            tabla+="<td><span class='float-right text-primary'><strong>"+data[i]['subtotal']+'</strong></span></td>';
            tabla+="<td><span class='float-right text-primary'><strong>"+data[i]['descuento']+'</strong></span></td>';
            tabla+="<td><span class='float-right text-primary'><strong>"+data[i]['entrega']+'</strong></span></td>';
            tabla+="<td><span class='float-right text-navy'><strong>"+data[i]['total']+'</strong></span></td>';
            tabla+="<td><span class='float-right text-danger'><strong>"+data[i]['igv']+'</strong></span></td>';
            tabla+="<td><span class='float-right text-success'><strong>"+data[i]['pago_final']+'</strong></span></td>';
            tabla+="</tr>";
        }
        $("#TbData").html(tabla);
      }, error: function(xhr, status){
        console.log("Error 404 no se encontró la web");
      }
    });
  }

</script>