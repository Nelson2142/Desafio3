$(document).ready(function() {
    // Cargar usuarios al iniciar
    cargarUsuarios();

    // Validación del formulario
    $('#formularioRegistro').on('submit', function(e) {
        e.preventDefault();
        
        // Validación del cliente
        let nombre = $('#nombreCompleto').val().trim();
        let email = $('#email').val().trim();
        let password = $('#password').val();
        let fechaNacimiento = $('#fechaNacimiento').val();
        
        if (!nombre || !email || !password || !fechaNacimiento) {
            alert('Todos los campos son requeridos');
            return;
        }
        
        if (!validarEmail(email)) {
            alert('Por favor ingresa un email válido');
            return;
        }
        
        if (password.length < 6) {
            alert('La contraseña debe tener al menos 6 caracteres');
            return;
        }
        
        // Enviar datos al servidor
        registrarUsuario({
            nombre_completo: nombre,
            email: email,
            password: password,
            fecha_nacimiento: fechaNacimiento
        });
    });
    
    // Función para cargar usuarios
    function cargarUsuarios() {
        $.ajax({
            url: 'listar.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    renderizarUsuarios(response.usuarios);
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar usuarios:', error);
            }
        });
    }
    
    // Función para registrar usuario
    function registrarUsuario(usuario) {
        $.ajax({
            url: 'insertar.php',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(usuario),
            success: function(response) {
                if (response.success) {
                    $('#formularioRegistro')[0].reset();
                    cargarUsuarios();
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al registrar usuario:', error);
                alert('Error al registrar usuario');
            }
        });
    }
    
    // Función para renderizar usuarios en la tabla
    function renderizarUsuarios(usuarios) {
        let tabla = $('#tablaUsuarios');
        tabla.empty();
        
        if (usuarios.length === 0) {
            tabla.append('<tr><td colspan="6" class="text-center">No hay usuarios registrados</td></tr>');
            return;
        }
        
        usuarios.forEach(usuario => {
            let fechaNac = new Date(usuario.fecha_nacimiento).toLocaleDateString();
            let fechaReg = new Date(usuario.fecha_registro).toLocaleString();
            
            let fila = `
                <tr data-id="${usuario.id}">
                    <td>${usuario.id}</td>
                    <td>${usuario.nombre_completo}</td>
                    <td>${usuario.email}</td>
                    <td>${fechaNac}</td>
                    <td>${fechaReg}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editar-usuario" data-id="${usuario.id}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger eliminar-usuario" data-id="${usuario.id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            
            tabla.append(fila);
        });
        
        // Asignar eventos a los botones
        $('.editar-usuario').on('click', function() {
            let id = $(this).data('id');
            editarUsuario(id);
        });
        
        $('.eliminar-usuario').on('click', function() {
            let id = $(this).data('id');
            eliminarUsuario(id);
        });
    }
    
    // Función para editar usuario
    function editarUsuario(id) {
        $.ajax({
            url: 'listar.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let usuario = response.usuarios.find(u => u.id == id);
                    if (usuario) {
                        $('#editId').val(usuario.id);
                        $('#editNombreCompleto').val(usuario.nombre_completo);
                        $('#editEmail').val(usuario.email);
                        $('#editFechaNacimiento').val(usuario.fecha_nacimiento);
                        
                        let modal = new bootstrap.Modal(document.getElementById('editarUsuarioModal'));
                        modal.show();
                    }
                }
            }
        });
    }
    
    // Guardar cambios al editar
    $('#guardarCambios').on('click', function() {
        let usuario = {
            id: $('#editId').val(),
            nombre_completo: $('#editNombreCompleto').val().trim(),
            email: $('#editEmail').val().trim(),
            fecha_nacimiento: $('#editFechaNacimiento').val()
        };
        
        if (!usuario.nombre_completo || !usuario.email || !usuario.fecha_nacimiento) {
            alert('Todos los campos son requeridos');
            return;
        }
        
        if (!validarEmail(usuario.email)) {
            alert('Por favor ingresa un email válido');
            return;
        }
        
        $.ajax({
            url: 'actualizar.php',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(usuario),
            success: function(response) {
                if (response.success) {
                    $('#editarUsuarioModal').modal('hide');
                    cargarUsuarios();
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            }
        });
    });
    
    // Función para eliminar usuario
    function eliminarUsuario(id) {
        if (!confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            return;
        }
        
        $.ajax({
            url: 'eliminar.php',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({ id: id }),
            success: function(response) {
                if (response.success) {
                    cargarUsuarios();
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            }
        });
    }
    
    // Función auxiliar para validar email
    function validarEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});