<?php include "Views/Templates/header.php"; ?>
<div class="card">
    <div class="card-header card-header-primary fw-bold">
        Docentes
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-light table-bordered table-hover" id="tblDocentes">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Titulo</th>
                        <th>Institucion</th>
                        <th>Año de Graduacion</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="nuevo_docente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title">Nuevo Docente</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmDocente">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <input id="fe_nac" class="form-control" type="date" data-date-format="DD MMMM YYYY" name="fe_nac" placeholder="Fecha de Nacimiento">
                        <label for="fe_nac">Fecha de Nacimiento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="titulo" class="form-control" type="text" name="titulo" placeholder="Titulo Obtenido">
                        <label for="titulo">Titulo Obtenido</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="institucion" class="form-control" type="text" name="institucion" placeholder="Institucion">
                        <label for="institucion">Institucion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="anio_grad" class="form-control" type="number" min="1900" max="2099" step="1" name="anio_grad" placeholder="Año de Graduacion">
                        <label for="anio_grad">Año de Graduacion</label>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarDocente(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>