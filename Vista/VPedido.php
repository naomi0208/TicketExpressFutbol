<div class="card-body table-responsive p-0">
<h4 class="table-title"><strong>Lista de Pedidos</strong></h4>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Nombre Evento</th>
                <th>Zona</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Entrega</th>
                <th>Tipo Entrega</th>
                <th>Sede</th>
            </tr>
        </thead>
        <tbody id="TbData"></tbody>
    </table>
</div>
<script>
    window.load=getList('');

  function getList(bus){
    $.ajax({
      url: "Servicio/SPedido.php",
      data: {tipo: 'list', txtbus: bus},
      type: 'get',
      success: function(e){
        let data=JSON.parse(e);
        let tabla="";
        for (let i = 0; i < data.length; i++) {
            tabla+="<tr>";
            tabla+="<td><span class='badge badge-danger'>"+data[i]['id_pedido']+'</span></td>';
            tabla+="<td>"+data[i]['nombre_evento']+'</td>';
            tabla+="<td><span class='badge badge-success'>"+data[i]['zona']+'</span></td>';
            tabla+="<td>"+data[i]['cantidad']+'</td>';
            tabla+="<td>"+data[i]['precio']+'</td>';
            tabla+="<td>"+data[i]['entrega']+'</td>';
            tabla+="<td>"+data[i]['tipo_entrega']+'</td>';
            tabla+="<td>"+data[i]['sede']+'</td>';
            tabla+="</tr>";
        }
        $("#TbData").html(tabla);
      }, error: function(xhr, status){
        console.log("Error 404 no se encontró la web");
      }
    });
  }

</script>