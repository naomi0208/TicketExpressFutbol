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
  <h4 class="table-title"><strong>Lista de Categorias</strong></h4>
  <div class="d-flex justify-content-end mb-2">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategoriaModal">
      Añadir Categoria
    </button>
  </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID Categoria</th>
                <th>Nombre Categoria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="TbData"></tbody>
    </table>
</div>

<!-- Modal para editar categoria -->
<div class="modal fade" id="editCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="editCategoriaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoriaModalLabel">Editar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editCategoriaForm">
          <input type="hidden" id="editCategoriaId">
          <div class="form-group">
            <label for="editCategoriaNombre">Nombre</label>
            <input type="text" class="form-control" id="editCategoriaNombre" required>
          </div>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para añadir categoria -->
<div class="modal fade" id="addCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="addCategoriaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoriaModalLabel">Añadir Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addCategoriaForm">
          <div class="form-group">
            <label for="addCategoriaId">ID</label>
            <input type="text" class="form-control" id="addCategoriaId" required>
          </div>
          <div class="form-group">
            <label for="addCategoriaNombre">Nombre</label>
            <input type="text" class="form-control" id="addCategoriaNombre" required>
          </div>
          <button type="submit" class="btn btn-primary">Añadir Categoria</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = getList('');

  function getList(bus) {
    $.ajax({
      url: "Servicio/SCategoria.php",
      data: { tipo: 'list', txtbus: bus },
      type: 'get',
      success: function(e) {
        let data = JSON.parse(e);
        let tabla = "";
        for (let i = 0; i < data.length; i++) {
          tabla += "<tr>";
          tabla += "<td><span class='badge badge-warning'>" + data[i]['id_categoria'] + '</span></td>';
          tabla += "<td>" + data[i]['nombre_categoria'] + '</td>';
          tabla += "<td>";
          tabla += "<button class='btn btn-warning' onclick='editCategoria(\"" + data[i]['id_categoria'] + "\", \"" + data[i]['nombre_categoria'] + "\")'><img src='images/pencil.svg'></button>";
          tabla += "<button class='btn btn-danger' onclick='deleteCategoria(\"" + data[i]['id_categoria'] + "\")'><img src='images/trash.svg'></button>";
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

  function editCategoria(id_categoria, nombre_categoria) {
    $('#editCategoriaId').val(id_categoria);
    $('#editCategoriaNombre').val(nombre_categoria);
    $('#editCategoriaModal').modal('show');
  }

  $('#editCategoriaForm').submit(function(event) {
    event.preventDefault();
    const id_categoria = $('#editCategoriaId').val();
    const nombre_categoria = $('#editCategoriaNombre').val();

    $.ajax({
      url: "Servicio/SCategoria.php",
      data: { tipo: 'update', id_categoria: id_categoria, nombre_categoria: nombre_categoria },
      type: 'post',
      success: function(response) {
        $('#editCategoriaModal').modal('hide');
        getList('');
        alert('Categoria actualizada correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al actualizar la categoria');
      }
    });
  });

  function deleteCategoria(id_categoria) {
    $.ajax({
      url: "Servicio/SCategoria.php",
      data: { tipo: 'delete', id_categoria: id_categoria },
      type: 'post',
      success: function(response) {
        alert('Categoria eliminada correctamente');
        getList(''); // Actualiza la lista después de eliminar
      },
      error: function(xhr, status) {
        console.log("Error al eliminar la categoria");
      }
    });
  }

  $('#addCategoriaForm').submit(function(event) {
    event.preventDefault();
    const id_categoria = $('#addCategoriaId').val();
    const nombre_categoria = $('#addCategoriaNombre').val();

    $.ajax({
      url: "Servicio/SCategoria.php",
      data: { tipo: 'add', id_categoria: id_categoria, nombre_categoria: nombre_categoria },
      type: 'post',
      success: function(response) {
        $('#addCategoriaModal').modal('hide');
        getList('');
        alert('Categoria añadida correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al añadir la categoria');
      }
    });
  });
</script>