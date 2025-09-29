<x-guest-elegante>
    <div class="container-elegante">
        <h2 style="text-align: center; color: #4a4a4a; margin-bottom: 20px;">Crear Nuevo Usuario</h2>
        <form method="POST" action="{{ route('admin.store-user') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Tipo de Usuario</label>
                <select id="role" name="role" required>
                    <option value="user">Usuario Regular</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="auditor">Auditor</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <button type="submit">Crear Usuario</button>
        </form>
    </div>
</x-guest-elegante>