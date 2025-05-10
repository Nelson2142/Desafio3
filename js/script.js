$(function(){
    const btnRegistrar = $('#btnRegistrar');
  
    // Carga inicial
    cargarUsuarios();
  
    // Enviar registro
    $('#formularioRegistro').on('submit', function(e){
      e.preventDefault();
      btnRegistrar.prop('disabled', true);
  
      let usuario = {
        nombre_completo: $('#nombreCompleto').val().trim(),
        email:            $('#email').val().trim(),
        password:         $('#password').val(),
        fecha_nacimiento: $('#fechaNacimiento').val()
      };
  
      // Validaciones
      if (!usuario.nombre_completo || !usuario.email 
        || !usuario.password || !usuario.fecha_nacimiento) {
        alert('Todos los campos son obligatorios');
        btnRegistrar.prop('disabled', false);
        return;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(usuario.email)) {
        alert('Email con formato inválido');
        btnRegistrar.prop('disabled', false);
        return;
      }
      if (usuario.password.length < 6) {
        alert('La contraseña debe tener al menos 6 caracteres');
        btnRegistrar.prop('disabled', false);
        return;
      }

      if (new Date(usuario.fecha_nacimiento) > new Date()) {
        alert('La fecha de nacimiento no puede ser futura');
        btnRegistrar.prop('disabled', false);
        return;
      }
  
      $.ajax({
        url: 'insertar.php', method:'POST',
        contentType:'application/json', data: JSON.stringify(usuario),
        dataType:'json'
      }).done(resp=>{
        alert(resp.message);
        if (resp.success) {
          $('#formularioRegistro')[0].reset();
          cargarUsuarios();
        }
      }).fail(()=> alert('Error al registrar'))
        .always(()=> btnRegistrar.prop('disabled', false));
    });
  
    // Funciones AJAX
    function cargarUsuarios(){
      $.getJSON('listar.php', resp=>{
        renderizarUsuarios(resp.usuarios||[]);
      });
    }
  
    function renderizarUsuarios(usuarios){
      let tabla = $('#tablaUsuarios').empty();
      if (!usuarios.length) {
        tabla.append('<tr><td colspan="6" class="text-center">No hay usuarios</td></tr>');
        return;
      }
      usuarios.forEach(u=>{
        let fN = new Date(u.fecha_nacimiento).toLocaleDateString();
        let fR = new Date(u.fecha_registro).toLocaleString();
        tabla.append(`
          <tr data-id="${u.id}">
            <td>${u.id}</td>
            <td>${u.nombre_completo}</td>
            <td>${u.email}</td>
            <td>${fN}</td>
            <td>${fR}</td>
            <td>
              <button class="btn btn-sm btn-warning editar" data-id="${u.id}"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-sm btn-danger eliminar" data-id="${u.id}"><i class="bi bi-trash"></i></button>
            </td>
          </tr>`);
      });
      // eventos
      $('.eliminar').click(function(){
        if (!confirm('¿Confirma eliminación?')) return;
        let id = $(this).data('id');
        $.ajax({
          url:'eliminar.php', method:'POST',
          contentType:'application/json', data: JSON.stringify({id}),
          dataType:'json'
        }).done(r=>{
          alert(r.message);
          if (r.success) cargarUsuarios();
        });
      });
      $('.editar').click(function(){
        let id = $(this).data('id');
        let u = usuarios.find(x=>x.id==id);
        if (!u) return;
        $('#editId').val(u.id);
        $('#editNombreCompleto').val(u.nombre_completo);
        $('#editEmail').val(u.email);
        $('#editFechaNacimiento').val(u.fecha_nacimiento);
        new bootstrap.Modal($('#editarUsuarioModal')).show();
      });
    }
  
    // Guardar edición
    $('#guardarCambios').click(function(){
      let btn = $(this).prop('disabled',false);
      let usuario = {
        id:                $('#editId').val(),
        nombre_completo:   $('#editNombreCompleto').val().trim(),
        email:             $('#editEmail').val().trim(),
        fecha_nacimiento:  $('#editFechaNacimiento').val()
      };
      // mismas validaciones de fecha y email
      if (!usuario.nombre_completo||!usuario.email||!usuario.fecha_nacimiento) {
        alert('Todos los campos son obligatorios'); return;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(usuario.email)) {
        alert('Email inválido'); return;
      }
      if (new Date(usuario.fecha_nacimiento) > new Date()) {
        alert('Fecha de nacimiento no puede ser futura'); return;
      }
      btn.prop('disabled', true);
      $.ajax({
        url:'actualizar.php', method:'POST',
        contentType:'application/json', data: JSON.stringify(usuario),
        dataType:'json'
      }).done(r=>{
        alert(r.message);
        if (r.success) {
          $('#editarUsuarioModal').modal('hide');
          cargarUsuarios();
        }
      }).always(()=> btn.prop('disabled', false));
    });
  });  