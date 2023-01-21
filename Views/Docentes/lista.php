<?php include "Views/Templates/header.php"; ?>
<div class="col-md-8 mx-auto mt-4">
    <div class="card">
        <div class="card-header text-center bg-dark text-white">
            Establecer Asignaturas
        </div>
        <div class="card-body">
            <form id="frmEstAsig" onsubmit="establecerAsignaturas(event)">
                <div class="row">
                    <?php foreach ($data['datos'] as $row) { ?>
                        <div class="col-md-4 text-center text-capitalize p-2">
                            <label for=""><?php echo $row['asig_nombre']." de ". $row['grad_nombre']; ?></label><br>
                            <input type="checkbox" name="asignaturas[]" value="<?php echo $row['id']; ?>" <?php echo isset($data['asignaturas_establecidas'][$row['id']]) ? 'checked' : '' ;?>>
                        </div>
                    <?php } ?>
                    <input type="hidden" value="<?php echo $data['id_docente']; ?>" name="id_docente">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-outline-primary">Establecer Asignaturas</button>
                    <a class="btn btn-outline-danger" href="<?php echo base_url ;?>Docentes">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>