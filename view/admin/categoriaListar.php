<?php

require_once '../autoload.php';

use controller\CategoriaController;

$categoriaController = new CategoriaController();

$categorias = $categoriaController->getCategorias();

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Categorias</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered border">
        <thead>
        <tr>
            <th scope="col" class="fit">#</th>
            <th scope="col">Nome</th>
            <th class="fit"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($categorias as $categoria){ ?>
            <tr>
                <td class="px-3"><?= $categoria->getIdCategoria(); ?></td>
                <td><?= $categoria->getNomeCategoria(); ?></td>
                <td><a href="categoria/<?= $categoria->getIdCategoria(); ?>"><i class="fas fa-edit"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script src="js/form.utils.js"></script>
<script>
    $(document).ready(function () {
        $('.table').DataTable({
                "oLanguage": {
                    "sUrl": "js/datatables.pt.json"
                }
            }
        );
    });
</script>