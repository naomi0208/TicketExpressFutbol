<div class="card-body table-responsive p-0">
<style>
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
  <h4 class="table-title"><strong>Lista de Públicos</strong></h4>
  <div class="d-flex justify-content-end mb-2">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPublicoModal">
      Añadir Público
    </button>
  </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID Publico</th>
                <th>Nombre Publico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="TbData"></tbody>
    </table>
</div>

<!-- Modal para editar publico -->
<div class="modal fade" id="editPublicoModal" tabindex="-1" role="dialog" aria-labelledby="editPublicoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPublicoModalLabel">Editar Publico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editPublicoForm">
          <input type="hidden" id="editPublicoId">
          <div class="form-group">
            <label for="editPublicoNombre">Nombre</label>
            <input type="text" class="form-control" id="editPublicoNombre" required>
          </div>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para añadir publico -->
<div class="modal fade" id="addPublicoModal" tabindex="-1" role="dialog" aria-labelledby="addPublicoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPublicoModalLabel">Añadir Publico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addPublicoForm">
          <div class="form-group">
            <label for="addPublicoId">ID</label>
            <input type="text" class="form-control" id="addPublicoId" required>
          </div>
          <div class="form-group">
            <label for="addPublicoNombre">Nombre</label>
            <input type="text" class="form-control" id="addPublicoNombre" required>
          </div>
          <button type="submit" class="btn btn-primary">Añadir Publico</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = getList('');

  function getList(bus) {
    $.ajax({
      url: "Servicio/SPublico.php",
      data: { tipo: 'list', txtbus: bus },
      type: 'get',
      success: function(e) {
        let data = JSON.parse(e);
        let tabla = "";
        for (let i = 0; i < data.length; i++) {
          tabla += "<tr>";
          tabla += "<td><span class='badge badge-warning'>" + data[i]['id_publico'] + '</span></td>';
          tabla += "<td>" + data[i]['descripcion'] + '</td>';
          tabla += "<td>";
          tabla += "<button class='btn btn-warning' onclick='editPublico(\"" + data[i]['id_publico'] + "\", \"" + data[i]['descripcion'] + "\")'><img src='images/pencil.svg'></button>";
          tabla += "<button class='btn btn-danger' onclick='deletePublico(\"" + data[i]['id_publico'] + "\")'><img src='images/trash.svg'></button>";
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

  function editPublico(id_publico, descripcion) {
    $('#editPublicoId').val(id_publico);
    $('#editPublicoNombre').val(descripcion);
    $('#editPublicoModal').modal('show');
  }

  $('#editPublicoForm').submit(function(event) {
    event.preventDefault();
    const id_publico = $('#editPublicoId').val();
    const descripcion = $('#editPublicoNombre').val();

    $.ajax({
      url: "Servicio/SPublico.php",
      data: { tipo: 'update', id_publico: id_publico, descripcion: descripcion },
      type: 'post',
      success: function(response) {
        $('#editPublicoModal').modal('hide');
        getList('');
        alert('Publico actualizada correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al actualizar la publico');
      }
    });
  });

  function deletePublico(id_publico) {
    $.ajax({
      url: "Servicio/SPublico.php",
      data: { tipo: 'delete', id_publico: id_publico },
      type: 'post',
      success: function(response) {
        alert('Publico eliminada correctamente');
        getList(''); // Actualiza la lista después de eliminar
      },
      error: function(xhr, status) {
        console.log("Error al eliminar la publico");
      }
    });
  }

  $('#addPublicoForm').submit(function(event) {
    event.preventDefault();
    const id_publico = $('#addPublicoId').val();
    const descripcion = $('#addPublicoNombre').val();

    $.ajax({
      url: "Servicio/SPublico.php",
      data: { tipo: 'add', id_publico: id_publico, descripcion: descripcion },
      type: 'post',
      success: function(response) {
        $('#addPublicoModal').modal('hide');
        getList('');
        alert('Publico añadida correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al añadir la publico');
      }
    });
  });
</script>