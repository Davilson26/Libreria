
<?php
include("layouths/master.php");
?>
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=number] { -moz-appearance:textfield; }
    </style>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3 justify-content-center alaign-items-center text-center bg bg-dark pb-5 pt-4">
        <div class="card ">
            <div class="card-header bg bg-transparent">
                <h1>Gestión de miembros</h1>
            </div>
            <div class="card-body">
                <form id="userForm">
                    <input type="hidden" id="userId">
                    <input class="form-control text-center my-1 px-1 mx-1" type="text" id="userName" placeholder="Nombre" autofocus required>
                    <input class="form-control text-center my-1 px-1 mx-1" type="number" id="telefono" placeholder="Telefono" required>
                    <input class="form-control text-center my-1 px-1 mx-1" type="email" id="userEmail" placeholder="Correo Electrónico" autocomplete="no" required>
                    <div class="d-flex justify-content-end mt-3 gap-3">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-sm btn-danger">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3 justify-content-center alaign-items-center bg bg-secondary pt-3 pb-5">
        <div class="card">
            <div class="card-header bg bg-transparent text-center">
                <h1>Lista de miembros</h1>
            </div>
            <div class="card-body text-end">
                <ul id="userList" class="list-group"></ul>
            </div>
        </div>
    </div>


<script src="../js/miembrosModule.js"></script>
<?php
include("layouths/footer.php");
?>