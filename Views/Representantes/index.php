<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary fw-bold">
        Representantes
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblRepresentantes">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Cedula</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="nuevo_representante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nuevo Representante</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmRepresentante">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input id="fe_nac" class="form-control" type="date" data-date-format="DD MMMM YYYY" name="fe_nac" placeholder="Fecha de Nacimiento">
                        <label for="fe_nac">Fecha de Nacimiento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="cedula" class="form-control" type="text" name="cedula" placeholder="Cedula">
                        <label for="cedula">Cedula</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Direccion">
                        <label for="direccion">Direccion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="telefono" class="form-control" type="number" name="telefono" placeholder="Telefono">
                        <label for="telefono">Telefono</label>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarRepresentante(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>