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
  <h4 class="table-title"><strong>Lista de Sedes</strong></h4>
  <div class="d-flex justify-content-end mb-2">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSedeModal">
      Añadir Sede
    </button>
  </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID Sede</th>
                <th>Nombre Sede</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="TbData"></tbody>
    </table>
</div>

<!-- Modal para editar sede -->
<div class="modal fade" id="editSedeModal" tabindex="-1" role="dialog" aria-labelledby="editSedeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSedeModalLabel">Editar Sede</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editSedeForm">
          <input type="hidden" id="editSedeId">
          <div class="form-group">
            <label for="editSedeNombre">Nombre</label>
            <input type="text" class="form-control" id="editSedeNombre" required>
          </div>
          <div class="form-group">
            <label for="editSedeDireccion">Direccion</label>
            <input type="text" class="form-control" id="editSedeDireccion" required>
          </div>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para añadir sede -->
<div class="modal fade" id="addSedeModal" tabindex="-1" role="dialog" aria-labelledby="addSedeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSedeModalLabel">Añadir Sede</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addSedeForm">
          <div class="form-group">
            <label for="addSedeId">ID</label>
            <input type="text" class="form-control" id="addSedeId" required>
          </div>
          <div class="form-group">
            <label for="addSedeNombre">Nombre</label>
            <input type="text" class="form-control" id="addSedeNombre" required>
          </div>
          <div class="form-group">
            <label for="addSedeDireccion">Direccion</label>
            <input type="text" class="form-control" id="addSedeDireccion" required>
          </div>
          <button type="submit" class="btn btn-primary">Añadir Sede</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = getList('');

  function getList(bus) {
    $.ajax({
      url: "Servicio/SSede.php",
      data: { tipo: 'list', txtbus: bus },
      type: 'get',
      success: function(e) {
        let data = JSON.parse(e);
        let tabla = "";
        for (let i = 0; i < data.length; i++) {
          tabla += "<tr>";
          tabla += "<td><span class='badge badge-warning'>" + data[i]['id_sede'] + '</span></td>';
          tabla += "<td><span class='float-left text-navy'><strong>" + data[i]['nombre'] + '</strong></span></td>';
          tabla += "<td>" + data[i]['direccion'] + '</td>';
          tabla += "<td>";
          tabla += "<button class='btn btn-warning' onclick='editSede(\"" + data[i]['id_sede'] + "\", \"" + data[i]['nombre'] + "\", \"" + data[i]['direccion'] + "\")'><img src='images/pencil.svg'></button>";
          tabla += "<button class='btn btn-danger' onclick='deleteSede(\"" + data[i]['id_sede'] + "\")'><img src='images/trash.svg'></button>";
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

  function editSede(id_sede, nombre, direccion) {
    $('#editSedeId').val(id_sede);
    $('#editSedeNombre').val(nombre);
    $('#editSedeDireccion').val(direccion);
    $('#editSedeModal').modal('show');
  }

  $('#editSedeForm').submit(function(event) {
    event.preventDefault();
    const id_sede = $('#editSedeId').val();
    const nombre = $('#editSedeNombre').val();
    const direccion = $('#editSedeDireccion').val();

    $.ajax({
      url: "Servicio/SSede.php",
      data: { tipo: 'update', id_sede: id_sede, nombre: nombre, direccion: direccion },
      type: 'post',
      success: function(response) {
        $('#editSedeModal').modal('hide');
        getList('');
        alert('Sede actualizada correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al actualizar la sede');
      }
    });
  });

  function deleteSede(id_sede) {
    $.ajax({
      url: "Servicio/SSede.php",
      data: { tipo: 'delete', id_sede: id_sede },
      type: 'post',
      success: function(response) {
        alert('Sede eliminada correctamente');
        getList(''); // Actualiza la lista después de eliminar
      },
      error: function(xhr, status) {
        console.log("Error al eliminar la sede");
      }
    });
  }

  $('#addSedeForm').submit(function(event) {
    event.preventDefault();
    const id_sede = $('#addSedeId').val();
    const nombre = $('#addSedeNombre').val();
    const direccion = $('#addSedeDireccion').val();

    $.ajax({
      url: "Servicio/SSede.php",
      data: { tipo: 'add', id_sede: id_sede, nombre: nombre, direccion: direccion },
      type: 'post',
      success: function(response) {
        $('#addSedeModal').modal('hide');
        getList('');
        alert('Sede añadida correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al añadir la sede');
      }
    });
  });
</script>