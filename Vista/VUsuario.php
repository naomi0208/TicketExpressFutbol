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
  <h4 class="table-title"><strong>Lista de Usuarios</strong></h4>
  <div class="d-flex justify-content-end mb-2">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
      Añadir Usuario
    </button>
  </div>
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dni</th>
                <th>Email</th>
                <th>Password</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="TbData"></tbody>
    </table>
</div>

<!-- Modal para editar usuario -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editUserForm">
          <input type="hidden" id="editUserId">
          <div class="form-group">
            <label for="editUserNombre">Nombre</label>
            <input type="text" class="form-control" id="editUserNombre" required>
          </div>
          <div class="form-group">
            <label for="editUserApellido">Apellido</label>
            <input type="text" class="form-control" id="editUserApellido" required>
          </div>
          <div class="form-group">
            <label for="editUserDni">DNI</label>
            <input type="text" class="form-control" id="editUserDni" required>
          </div>
          <div class="form-group">
            <label for="editUserEmail">Email</label>
            <input type="email" class="form-control" id="editUserEmail" required>
          </div>
          <div class="form-group">
            <label for="editUserPassword">Password</label>
            <input type="text" class="form-control" id="editUserPassword" required>
          </div>
          <div class="form-group">
            <label for="editUserTipo">Tipo de Usuario</label>
            <select class="form-control" id="editUserTipo" required>
              <option value="administrador">Administrador</option>
              <option value="cliente">Cliente</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para añadir usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Añadir Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addUserForm">
          <div class="form-group">
            <label for="addUserId">ID</label>
            <input type="text" class="form-control" id="addUserId" required>
          </div>
          <div class="form-group">
            <label for="addUserNombre">Nombre</label>
            <input type="text" class="form-control" id="addUserNombre" required>
          </div>
          <div class="form-group">
            <label for="addUserApellido">Apellido</label>
            <input type="text" class="form-control" id="addUserApellido" required>
          </div>
          <div class="form-group">
            <label for="addUserDni">DNI</label>
            <input type="text" class="form-control" id="addUserDni" required>
          </div>
          <div class="form-group">
            <label for="addUserEmail">Email</label>
            <input type="email" class="form-control" id="addUserEmail" required>
          </div>
          <div class="form-group">
            <label for="addUserPassword">Password</label>
            <input type="text" class="form-control" id="addUserPassword" required>
          </div>
          <div class="form-group">
            <label for="addUserTipo">Tipo de Usuario</label>
            <select class="form-control" id="addUserTipo" required>
              <option value="administrador">Administrador</option>
              <option value="cliente">Cliente</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Añadir Usuario</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    window.load=getList('');

  function getList(bus){
    $.ajax({
      url: "Servicio/SUsuario.php",
      data: {tipo: 'list', txtbus: bus},
      type: 'get',
      success: function(e){
        let data=JSON.parse(e);
        let tabla="";
        for (let i = 0; i < data.length; i++) {
            tabla+="<tr>";
            tabla+="<td><span class='badge badge-danger'>"+data[i]['id']+'</span></td>';
            tabla+="<td>"+data[i]['nombre']+'</td>';
            tabla+="<td>"+data[i]['apellido']+'</td>';
            tabla+="<td>"+data[i]['dni']+'</td>';
            tabla+="<td>"+data[i]['email']+'</td>';
            tabla+="<td>"+data[i]['password']+'</td>';
            tabla+="<td><span class='badge badge-success'>"+data[i]['tipo_usuario']+'</span></td>';
            tabla += "<td>";
            tabla += "<button class='btn btn-warning' onclick='editUser(\"" + data[i]['id'] + "\", \"" + data[i]['nombre'] + "\", \"" + data[i]['apellido'] + "\", \"" + data[i]['dni'] + "\", \"" + data[i]['email'] + "\", \"" + data[i]['password'] + "\")'><img src='images/pencil.svg'></button>";
            tabla += "<button class='btn btn-danger' onclick='deleteUser(\"" + data[i]['id'] + "\")'><img src='images/trash.svg'></button>";
            tabla += "</td>";
            tabla+="</tr>";
        }
        $("#TbData").html(tabla);
      }, error: function(xhr, status){
        console.log("Error 404 no se encontró la web");
      }
    });
  }

  function editUser(id, nombre, apellido, dni, email, password, tipo_usuario) {
    $('#editUserId').val(id);
    $('#editUserNombre').val(nombre);
    $('#editUserApellido').val(apellido);
    $('#editUserDni').val(dni);
    $('#editUserEmail').val(email);
    $('#editUserPassword').val(password);
    $('#editUserTipo').val(tipo_usuario);
    $('#editUserModal').modal('show');
  }

  $('#editUserForm').submit(function(event) {
    event.preventDefault();
    const id = $('#editUserId').val();
    const nombre = $('#editUserNombre').val();
    const apellido = $('#editUserApellido').val();
    const dni = $('#editUserDni').val();
    const email = $('#editUserEmail').val();
    const password = $('#editUserPassword').val();
    const tipo_usuario = $('#editUserTipo').val();

    $.ajax({
      url: "Servicio/SUsuario.php",
      data: { tipo: 'update', id: id, nombre: nombre, apellido: apellido, dni: dni, email: email, password: password, tipo_usuario: tipo_usuario },
      type: 'post',
      success: function(response) {
        $('#editUserModal').modal('hide');
        getList('');
        alert('Usuario actualizado correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al actualizar el usuario');
      }
    });
  });
  
  function deleteUser(id) {
    $.ajax({
        url: "Servicio/SUsuario.php",
        data: { tipo: 'delete', id: id },
        type: 'post',
        success: function(response) {
            alert('Usuario eliminado correctamente');
            getList(''); // Actualiza la lista después de eliminar
        },
        error: function(xhr, status) {
            console.log("Error al eliminar el usuario");
        }
    });
  }

  $('#addUserForm').submit(function(event) {
    event.preventDefault();
    const id = $('#addUserId').val();
    const nombre = $('#addUserNombre').val();
    const apellido = $('#addUserApellido').val();
    const dni = $('#addUserDni').val();
    const email = $('#addUserEmail').val();
    const password = $('#addUserPassword').val();
    const tipo_usuario = $('#addUserTipo').val();

    $.ajax({
      url: "Servicio/SUsuario.php",
      data: { tipo: 'add', id: id, nombre: nombre, apellido: apellido, dni: dni, email: email, password: password, tipo_usuario: tipo_usuario },
      type: 'post',
      success: function(response) {
        $('#addUserModal').modal('hide');
        getList('');
        alert('Usuario añadido correctamente');
      },
      error: function(xhr, status) {
        console.log('Error al añadir el usuario');
      }
    });
  });

</script>