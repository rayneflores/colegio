<?php include "Views/Templates/header.php"; ?>
<div class="container-fluid">
    <h1 class="mt-4">Panel Administrativo</h1>
</div>
<div class="row mt-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-primary">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Usuarios
                <i class="fas fa-users fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Usuarios" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['usuarios']['total'])?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-success">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Docentes
                <i class="fas fa-graduation-cap fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Docentes" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['docentes']['total'])?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-purple">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Representantes
                <i class="fas fa-user-tie fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Representantes" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['representantes']['total'])?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-info">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Asignaturas
                <i class="fas fa-book fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Asignaturas" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['asignaturas']['total'])?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-danger">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Secciones
                <i class="fas fa-list-ol fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Grados" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['grados']['total'])?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-turquoise">
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                Alumnos
                <i class="fas fa-user fa-2x ml-end"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Alumnos" class="text-white">Ver Detalle</a>
                <span class="text-white"><?php echo($data['alumnos']['total'])?></span>
            </div>
        </div>
    </div>
</div>
<!--div class="row mt-2 d-flex justify-content-center">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Productos con Stock Minimo
            </div>
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                <canvas id="stockMinimo" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Productos Mas Vendidos
            </div>
            <div class="card-body d-flex text-white align-items-center justify-content-between">
                <canvas id="masVendidos" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div-->
<?php include "Views/Templates/footer.php"; ?>