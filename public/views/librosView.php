<?php

include '../../config/db.php';
global $pdo;
$stmt = $pdo->query("SELECT id, nombre FROM categorias ORDER BY nombre ASC");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
include("layouths/master.php");
?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center alaign-items-center text-center bg bg-dark pb-5 pt-4">
        <div class="card ">
            <div class="card-header bg bg-transparent">
                <h1>Gestión de Libros</h1>
            </div>
            <div class="card-body">
                <form id="libroForm">
                    <input type="hidden" id="id">
                    <input class="form-control my-1 px-1 mx-1" type="text" id="titulo" placeholder="Titulo" required>
                    <input class="form-control my-1 px-1 mx-1" type="text" id="autor" placeholder="Autor" required>
                    
                    <select class="form-control my-1 px-1 mx-1" name="disponibilidad" id="disponibilidad">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>

                    <select class="form-control my-1 px-1 mx-1" name="categoria_id" id="categoria_id">
                        <option value="">Seleccione</option>
                        <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo $cat['id']?>"><?php echo $cat['nombre']?></option>
                        <?php endforeach ?>
                    </select>

                    <div class="d-flex justify-content-end mt-3 gap-3">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar Libro</button>
                        <button type="reset" class="btn btn-sm btn-danger">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center alaign-items-center text-center bg bg-secondary pt-3 pb-5">
        <div class="card">
            <div class="card-header bg bg-transparent">
                <h1>Lista de Libros</h1>
            </div>
            <div class="card-body">
                <ul id="librosList" class="list-group"></ul>
            </div>
        </div>
    </div>

    <script src="../js/librosModule.js"></script>
<?php
include("layouths/footer.php");
?>