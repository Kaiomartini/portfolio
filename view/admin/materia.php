<?php

require_once '../autoload.php';

use controller\MateriaController;
use model\Materia;
use util\Message;

$materia = new Materia();
$materiaController = new MateriaController();

if (isset($_POST['gravar'])) {

    try {

        $materia->setNomeMateria($_POST['nome']);

        if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

            $id = $_GET['codigo'];
            $materia->setIdMateria($id);

            if ($materiaController->alterar($materia)) {
                Message::makeSuccessSwal("Materia alterado com sucesso!");
            } else {
                Message::makeErrorSwal("Não foi possível alterar materia!");
            }

        } else {

            if ($materiaController->adicionar($materia)) {
                Message::makeSuccessSwal("Materia adicionado com sucesso!", "window.location = 'materia/{$materia->getIdMateria()}'");
            } else {
                Message::makeErrorSwal("Não foi possível adicionar materia!");
            }

        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

    try {

        $id = $_GET['codigo'];

        $materia = $materiaController->carregar($id);

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_POST['excluir'])) {

    try {
        $id = $_POST['codigo'];

        if ($materiaController->excluir($id)) {
            Message::makeSuccessSwal("Materia excluído com sucesso!", "window.location = 'materia/listar'");
        } else {
            Message::makeErrorSwal("Não foi possível excluir materia!");
        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastrar Materia</h1>
</div>
<form method="post">
    <?php if (!empty($materia->getIdMateria())) { ?>
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="nome">Código:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo"
                           value="<?= $materia->getIdMateria() ?>" readonly>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= $materia->getNomeMateria() ?>">
    </div>
    <div class="btn-group btn-group-lg btn-sm-sticky" role="group">
        <button type="submit" class="btn btn-success" name="gravar">
            <i class="fa fa-save"></i> Gravar
        </button>
        <?php if (!empty($materia->getIdMateria())) { ?>
            <button type="button" class="btn btn-danger"
                    onclick="excluir('materia/excluir', 'materia', '<?= $materia->getIdMateria() ?>')">
                <i class="fa fa-trash-alt"></i> Excluir
            </button>
        <?php } ?>
        <button type="button" class="btn btn-secondary" onclick="novo('materia/novo', 'materia')">
            <i class="fa fa-file"></i> Novo
        </button>
    </div>
</form>
<script src="js/form.utils.js"></script>