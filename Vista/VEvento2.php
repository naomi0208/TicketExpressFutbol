<div class="card-body table-responsive p-0">
<style>
    .table {
      table-layout: fixed;
      width: 100%;
    }
    .table th, .table td {
      width: 110px; /* Ajusta el ancho según tus necesidades */
      white-space: normal; /* Permite el ajuste de línea */
      word-wrap: break-word; /* Ajusta el texto en la celda */
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .table th:nth-child(1), .table td:nth-child(1) {
      width: 80px;
    }
    .table th:nth-child(7), .table td:nth-child(7) {
      width: 130px;
    }
    .table th:nth-child(8), .table td:nth-child(8) {
      width: 130px;
    }
    .table th:nth-child(9), .table td:nth-child(9) {
      width: 130px;
    }
    .table th:nth-child(11), .table td:nth-child(11) {
      width: 125px;
    }
    .btn-warning {
      margin-right: 5px;
    }
    .btn-warning img {
      height: 15px;
      width: auto:
    }
    .btn-danger img {
      height: 15px;
      width: auto;
    }
  </style>
  <h4 class="table-title"><strong>Lista de Eventos</strong></h4>
  <div class="d-flex justify-content-end mb-2">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEventoModal">
      Añadir Evento
    </button>
  </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
              <th>ID</th>
              <th>Evento</th>
              <th>Artista</th>
              <th>Categoria</th>
              <th>Ciudad</th>
              <th>Publico</th>
              <th>Imagen</th>
              <th>Video</th>
              <th>Mapa</th>
              <th>Spotify</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="TbData"></tbody>
    </table>
</div>

<!-- Modal para editar evento -->
<div class="modal fade" id="editEventoModal" tabindex="-1" role="dialog" aria-labelledby="editEventoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEventoModalLabel">Editar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editEventoForm">
          <input type="hidden" id="editEventoId">
          <div class="form-group">
            <label for="editEventoNombre">Nombre del Evento</label>
            <input type="text" class="form-control" id="editEventoNombre" required>
          </div>
          <div class="form-group">
            <label for="editEventoArtista">Artista</label>
            <input type="text" class="form-control" id="editEventoArtista" required>
          </div>
          <div class="form-group">
            <label for="editEventoCategoriaId">Categoria</label>
            <select class="form-control" id="editEventoCategoriaId" required>
              <option value="C001">Concierto</option>
              <option value="C002">Teatro</option>
              <option value="C003">Deportes</option>
              <option value="C004">Entretenimiento</option>
              <option value="C005">Teatro Infantil</option>
            </select>
          </div>
          <div class="form-group">
            <label for="editEventoCiudad">Ciudad</label>
            <input type="text" class="form-control" id="editEventoCiudad" required>
          </div>
          <div class="form-group">
            <label for="editEventoPublicoId">Publico</label>
            <select class="form-control" id="editEventoPublicoId" required>
              <option value="PB01">Apto para adolescentes</option>
              <option value="PB02">Para toda la familia</option>
              <option value="PB03">Solo para adultos</option>
              <option value="PB04">Para niños</option>
            </select>
          </div>
          <div class="form-group">
            <label for="editEventoImagen">Imagen</label>
            <input type="text" class="form-control" id="editEventoImagen" required>
          </div>
          <div class="form-group">
            <label for="editEventoVideo">Video</label>
            <input type="text" class="form-control" id="editEventoVideo" required>
          </div>
          <div class="form-group">
            <label for="editEventoMapa">Mapa</label>
            <input type="text" class="form-control" id="editEventoMapa" required>
          </div>
          <div class="form-group">
            <label for="editEventoSpotify">Spotify</label>
            <input type="text" class="form-control" id="editEventoSpotify" required>
          </div>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para añadir evento -->
<div class="modal fade" id="addEventoModal" tabindex="-1" role="dialog" aria-labelledby="addEventoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEventoModalLabel">Añadir Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addEventoForm">
          <div class="form-group">
            <label for="addEventoId">ID</label>
            <input type="text" class="form-control" id="addEventoId" required>
          </div>
          <div class="form-group">
            <label for="addEventoNombre">Nombre</label>
            <input type="text" class="form-control" id="addEventoNombre" required>
          </div>
          <div class="form-group">
            <label for="addEventoArtista">Artista</label>
            <input type="text" class="form-control" id="addEventoArtista" required>
          </div>
          <div class="form-group">
            <label for="addEventoCategoriaId">Categoria</label>
            <select class="form-control" id="addEventoCategoriaId" required>
              <option value="C001">Concierto</option>  
              <option value="C002">Teatro</option>
              <option value="C003">Deportes</option>
              <option value="C004">Entretenimiento</option>
              <option value="C005">Teatro Infantil</option>
            </select>
          </div>
          <div class="form-group">
            <label for="addEventoCiudad">Ciudad</label>
            <input type="text" class="form-control" id="addEventoCiudad" required>
          </div>
          <div class="form-group">
            <label for="addEventoPublicoId">Publico</label>
            <select class="form-control" id="addEventoPublicoId" required>
              <option value="PB01">Apto para adolescentes</option>
              <option value="PB02">Para toda la familia</option>
              <option value="PB03">Solo para adultos</option>
              <option value="PB04">Para niños</option>
            </select>
          </div>
          <div class="form-group">
            <label for="addEventoImagen">Imagen</label>
            <input type="file" class="form-control" id="addEventoImagen" required>
          </div>
          <div class="form-group">
            <label for="addEventoVideo">Video</label>
            <input type="file" class="form-control" id="addEventoVideo" required>
          </div>
          <div class="form-group">
            <label for="addEventoMapa">Mapa</label>
            <input type="file" class="form-control" id="addEventoMapa" required>
          </div>
          <div class="form-group">
            <label for="addEventoSpotify">Spotify</label>
            <input type="text" class="form-control" id="addEventoSpotify" required>
          </div>
          <button type="submit" class="btn btn-primary">Añadir Evento</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = getList('');

  function getList(bus) {
    $.ajax({
      url: "Servicio/SEvento2.php",
      data: { tipo: 'list', txtbus: bus },
      type: 'get',
      success: function(e) {
        let data = JSON.parse(e);
        let tabla = "";
        for (let i = 0; i < data.length; i++) {
          tabla += "<tr>";
          tabla += "<td><span class='badge badge-warning'>" + data[i]['id_evento'] + "</span></td>";
          tabla += "<td><span class='float-left text-navy'><strong>" + data[i]['nombre_evento'] + "</strong></span></td>";
          tabla += "<td>" + data[i]['artista'] + "</td>";
          tabla += "<td><span class='badge badge-primary'>" + data[i]['categoria'] + "</span></td>";
          tabla += "<td>" + data[i]['ciudad'] + "</td>";
          tabla += "<td><span class='badge badge-primary'>" + data[i]['publico'] + "</span></td>";
          tabla += "<td><img src='" + data[i]['imagen'] + "' alt='Imagen' style='width: 100px; height: auto;'></td>";
          tabla += "<td><video width='100' height='auto' controls='controls'><source src='" + data[i]['video'] + "' type='video/mp4'></video></td>";
          tabla += "<td><img src='" + data[i]['mapa'] + "' alt='Mapa' style='width: 100px; height: auto;'></td>";
          tabla += "<td><iframe src='" + data[i]['spotify'] + "' width='100' height='100' frameborder='0' allowtransparency='true' allow='encrypted-media'></iframe></td>";
          tabla += "<td>";
          tabla += "<button class='btn btn-warning' onclick='editEvento(\"" + data[i]['id_evento'] + "\", \"" + data[i]['nombre_evento'] + "\", \"" + data[i]['artista'] + "\", \"" + data[i]['categoria'] + "\", \"" + data[i]['ciudad'] + "\", \"" + data[i]['publico'] + "\", \"" + data[i]['imagen'] + "\", \"" + data[i]['video'] + "\", \"" + data[i]['mapa'] + "\", \"" + data[i]['spotify'] + "\")'><img src='images/pencil.svg'></button>";
          tabla += "<button class='btn btn-danger' onclick='deleteEvento(\"" + data[i]['id_evento'] + "\")'><img src='images/trash.svg'></button>";
          tabla += "</td>";
          tabla += "</tr>";
        }
        $("#TbData").html(tabla);
      },
      error: function(xhr, status) {
        console.log("Error 404 no se encontró la web");
      }
    });
  }

  function editEvento(id_evento, nombre_evento, artista, id_categoria, ciudad, id_publico, imagen, video, mapa, spotify) {
    $('#editEventoId').val(id_evento);
    $('#editEventoNombre').val(nombre_evento);
    $('#editEventoArtista').val(artista);
    $('#editEventoCategoriaId').val(id_categoria);
    $('#editEventoCiudad').val(ciudad);
    $('#editEventoPublicoId').val(id_publico);
    $('#editEventoImagen').val(imagen);
    $('#editEventoVideo').val(video);
    $('#editEventoMapa').val(mapa);
    $('#editEventoSpotify').val(spotify);
    $('#editEventoModal').modal('show');
  }

  $('#editEventoForm').submit(function(event) {
    event.preventDefault();
    const id_evento = $('#editEventoId').val();
    const nombre_evento = $('#editEventoNombre').val();
    const artista = $('#editEventoArtista').val();
    const id_categoria = $('#editEventoCategoriaId').val();
    const ciudad = $('#editEventoCiudad').val();
    const id_publico = $('#editEventoPublicoId').val();
    const imagen = $('#editEventoImagen').val();
    const video = $('#editEventoVideo').val();
    const mapa = $('#editEventoMapa').val();
    const spotify = $('#editEventoSpotify').val();

    $.ajax({
      url: "Servicio/SEvento2.php",
      data: { tipo: 'update', id_evento: id_evento, nombre_evento: nombre_evento, artista: artista, id_categoria: id_categoria, ciudad: ciudad, id_publico: id_publico, imagen: imagen, video: video, mapa: mapa, spotify: spotify },
      type: 'post',
      success: function(response) {
        $('#editEventoModal').modal('hide');
        getList('');
        alert('Evento actualizado correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al actualizar el evento');
      }
    });
  });

  function deleteEvento(id_evento) {
    $.ajax({
      url: "Servicio/SEvento2.php",
      data: { tipo: 'delete', id_evento: id_evento },
      type: 'post',
      success: function(response) {
        alert('Evento eliminado correctamente');
        getList(''); // Actualiza la lista después de eliminar
      },
      error: function(xhr, status) {
        console.log("Error al eliminar el evento");
      }
    });
  }

  $('#addEventoForm').submit(function(event) {
    event.preventDefault();
    const id_evento = $('#addEventoId').val();
    const nombre_evento = $('#addEventoNombre').val();
    const artista = $('#addEventoArtista').val();
    const id_categoria = $('#addEventoCategoriaId').val();
    const ciudad = $('#addEventoCiudad').val();
    const id_publico = $('#addEventoPublicoId').val();

    const imagen = $('#addEventoImagen').prop('files')[0];
    const video = $('#addEventoVideo').prop('files')[0];
    const mapa = $('#addEventoMapa').prop('files')[0];

    const imagen_nombre = imagen ? imagen.name : '';
    const video_nombre = video ? video.name : '';
    const mapa_nombre = mapa ? mapa.name : '';

    const spotify = $('#addEventoSpotify').val();

    $.ajax({
      url: "Servicio/SEvento2.php",
      data: {
        tipo: 'add',
        id_evento: id_evento,
        nombre_evento: nombre_evento,
        artista: artista,
        id_categoria: id_categoria,
        ciudad: ciudad,
        id_publico: id_publico,
        imagen: "images/" + imagen_nombre,
        video: "videos/" + video_nombre,
        mapa: "images/mapas/" + mapa_nombre,
        spotify: spotify
      },
      type: 'post',
      success: function(response) {
        $('#addEventoModal').modal('hide');
        getList('');
        alert('Evento añadido correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al añadir el evento');
      }
    });
  });
</script>