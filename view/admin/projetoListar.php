<?php

require_once '../autoload.php';

use controller\ProjetoController;

$projetoController = new ProjetoController();

$projetos = $projetoController->getProjetos();

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Projetos</h1>
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
        <?php foreach($projetos as $projeto){ ?>
        <tr>
            <td class="px-3"><?= $projeto->getIdProjeto(); ?></td>
            <td><?= $projeto->getNomeProjeto(); ?></td>
            <td><a href="projeto/<?= $projeto->getIdProjeto(); ?>"><i class="fas fa-edit"></i></a></td>
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