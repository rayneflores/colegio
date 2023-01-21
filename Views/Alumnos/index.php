<?php include "Views/Templates/header.php"; ?>
<div class="card mt-4">
    <div class="card-header card-header-primary fw-bold">
        Alumnos
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-2" type="button" onclick="frmAlumno();"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblAlumnos">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Sexo</th>
                        <th>Representante</th>
                        <th>Estado</th>
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
<div class="modal fade" id="nuevo_alumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nuevo Alumno</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmAlumno">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input id="cedula" class="form-control" type="text" name="cedula" placeholder="Cedula">
                        <label for="cedula">Cedula</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Alumnno">
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="fe_nac" class="form-control" type="date" data-date-format="DD MMMM YYYY" name="fe_nac" placeholder="Fecha de Nacimiento">
                        <label for="fe_nac">Fecha de Nacimiento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="sexo" class="form-control" name="sexo">
                            <option value="m">Masculino</option>
                            <option value="f">Femenino</option>
                            <option value="o">Otro</option>
                        </select>
                        <label for="sexo">Sexo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="rep_id" class="form-control" name="rep_id">
                            <?php foreach ($data['representantes'] as $row) { ?>
                                <option value="<?php echo $row['rep_id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                        </select>
                        <label for="rep_id">Representante</label>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarAlumno(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>