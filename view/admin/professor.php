<?php

require_once '../autoload.php';

use controller\ProfessorController;
use model\Professor;
use util\Message;

$professor = new Professor();
$professorController = new ProfessorController();

if (isset($_POST['gravar'])) {

    try {

        $professor->setNomeProfessor($_POST['nome']);

        if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

            $id = $_GET['codigo'];
            $professor->setIdProfessor($id);

            if ($professorController->alterar($professor)) {
                Message::makeSuccessSwal("Professor alterado com sucesso!");
            } else {
                Message::makeErrorSwal("Não foi possível alterar professor!");
            }

        } else {

            if ($professorController->adicionar($professor)) {
                Message::makeSuccessSwal("Professor adicionado com sucesso!", "window.location = 'professor/{$professor->getIdProfessor()}'");
            } else {
                Message::makeErrorSwal("Não foi possível adicionar professor!");
            }

        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

    try {

        $id = $_GET['codigo'];

        $professor = $professorController->carregar($id);

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_POST['excluir'])) {

    try {
        $id = $_POST['codigo'];

        if ($professorController->excluir($id)) {
            Message::makeSuccessSwal("Professor excluído com sucesso!", "window.location = 'professor/listar'");
        } else {
            Message::makeErrorSwal("Não foi possível excluir professor!");
        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastrar Professor</h1>
</div>
<form method="post">
    <?php if (!empty($professor->getIdProfessor())) { ?>
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="nome">Código:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo"
                           value="<?= $professor->getIdProfessor() ?>" readonly>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= $professor->getNomeProfessor() ?>">
    </div>
    <div class="btn-group btn-group-lg btn-sm-sticky" role="group">
        <button type="submit" class="btn btn-success" name="gravar">
            <i class="fa fa-save"></i> Gravar
        </button>
        <?php if (!empty($professor->getIdProfessor())) { ?>
            <button type="button" class="btn btn-danger"
                    onclick="excluir('professor/excluir', 'professor', '<?= $professor->getIdProfessor() ?>')">
                <i class="fa fa-trash-alt"></i> Excluir
            </button>
        <?php } ?>
        <button type="button" class="btn btn-secondary" onclick="novo('professor/novo', 'professor')">
            <i class="fa fa-file"></i> Novo
        </button>
    </div>
</form>
<script src="js/form.utils.js"></script>