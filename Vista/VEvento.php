<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID Evento</th>
                <th>Nombre Evento</th>
                <th>Artista</th>
                <th>Categoria</th>
                <th>Ciudad</th>
                <th>Publico</th>
            </tr>
        </thead>
        <tbody id="TbData"></tbody>
    </table>
</div>
<script>
    window.load=getList('');

  function getList(bus){
    $.ajax({
      url: "Servicio/SEvento.php",
      data: {tipo: 'list', txtbus: bus},
      type: 'get',
      success: function(e){
        let data=JSON.parse(e);
        let tabla="";
        for (let i = 0; i < data.length; i++) {
            tabla+="<tr>";
            tabla+="<td><span class='badge badge-warning'>"+data[i]['id_evento']+'</span></td>';
            tabla+="<td>"+data[i]['nombre_evento']+'</td>';
            tabla+="<td>"+data[i]['artista']+'</td>';
            tabla+="<td>"+data[i]['categoria']+'</td>';
            tabla+="<td>"+data[i]['ciudad']+'</td>';
            tabla+="<td>"+data[i]['ciudad']+'</td>';
            tabla+="</tr>";
        }
        $("#TbData").html(tabla);
      }, error: function(xhr, status){
        console.log("Error 404 no se encontró la web");
      }
    });
  }

</script>