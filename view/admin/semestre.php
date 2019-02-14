<?php

require_once '../autoload.php';

use controller\SemestreController;
use model\Semestre;
use util\Message;

$semestre = new Semestre();
$semestreController = new SemestreController();

if (isset($_POST['gravar'])) {

    try {

        $semestre->setNomeSemestre($_POST['nome']);

        if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

            $id = $_GET['codigo'];
            $semestre->setIdSemestre($id);

            if ($semestreController->alterar($semestre)) {
                Message::makeSuccessSwal("Semestre alterado com sucesso!");
            } else {
                Message::makeErrorSwal("Não foi possível alterar semestre!");
            }

        } else {

            if ($semestreController->adicionar($semestre)) {
                Message::makeSuccessSwal("Semestre adicionado com sucesso!", "window.location = 'semestre/{$semestre->getIdSemestre()}'");
            } else {
                Message::makeErrorSwal("Não foi possível adicionar semestre!");
            }

        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

    try {

        $id = $_GET['codigo'];

        $semestre = $semestreController->carregar($id);

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_POST['excluir'])) {

    try {
        $id = $_POST['codigo'];

        if ($semestreController->excluir($id)) {
            Message::makeSuccessSwal("Semestre excluído com sucesso!", "window.location = 'semestre/listar'");
        } else {
            Message::makeErrorSwal("Não foi possível excluir semestre!");
        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastrar Semestre</h1>
</div>
<form method="post">
    <?php if (!empty($semestre->getIdSemestre())) { ?>
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="nome">Código:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo"
                           value="<?= $semestre->getIdSemestre() ?>" readonly>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= $semestre->getNomeSemestre() ?>">
    </div>
    <div class="btn-group btn-group-lg btn-sm-sticky" role="group">
        <button type="submit" class="btn btn-success" name="gravar">
            <i class="fa fa-save"></i> Gravar
        </button>
        <?php if (!empty($semestre->getIdSemestre())) { ?>
            <button type="button" class="btn btn-danger"
                    onclick="excluir('semestre/excluir', 'semestre', '<?= $semestre->getIdSemestre() ?>')">
                <i class="fa fa-trash-alt"></i> Excluir
            </button>
        <?php } ?>
        <button type="button" class="btn btn-secondary" onclick="novo('semestre/novo', 'semestre')">
            <i class="fa fa-file"></i> Novo
        </button>
    </div>
</form>
<script src="js/form.utils.js"></script>