<div class="form-floating mb-3">
    <input type="text" class="form-control" id="email" name="email" placeholder="" value="" required>
    <label for="email">Email</label>
    <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
</div>
<div class="form-floating mb-3">
    <input type="password" class="form-control" id="password" name="password" placeholder="" value="" required>
    <label for="password">Contraseña</label>
    <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
</div>
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
    <label for="name" id="nameLabel">Nombre</label>
    <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
</div>
<div class="input-group input-group-lg  mb-3">
    <div class="input-group-text">
        <input type="checkbox" name="isTeam" id="isTeamCheck">
    </div>
    <input type="text" class="form-control" value="" disabled >
</div>
<div class="mb-3">
    <label for="image-user" class="form-label ms-2 mt-2"></label>
    <input class="form-control" type="file" id="image-user" name="image-user">
</div>
<button type="button" id="switch-button" class="btn btn-primary">Back to Login</button>
<button type="button" id="submit-button" class="btn btn-primary">Register</button>