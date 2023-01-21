<?php include "Views/Templates/header.php"; ?>
<div class="card mt-4">
    <div class="card-header card-header-primary fw-bold">
        Asignaturas
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-2" type="button" onclick="frmAsignatura();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblAsignaturas">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Asignatura</th>
                        <th>Grado</th>
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
<div class="modal fade" id="nueva_asignatura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nueva Asignatura</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmAsignatura">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input id="asignatura" class="form-control" type="text" name="asignatura" placeholder="Nombre de la Asignatura">
                        <label for="asignatura">Asignatura</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="grado" class="form-control" name="grado">
                            <?php foreach ($data['grados'] as $row) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                        </select>
                        <label for="rol">Grado</label>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarAsignatura(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>