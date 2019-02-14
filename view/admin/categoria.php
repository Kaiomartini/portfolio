<?php

require_once '../autoload.php';

use controller\CategoriaController;
use model\Categoria;
use util\Message;

$categoria = new Categoria();
$categoriaController = new CategoriaController();

if (isset($_POST['gravar'])) {

    try {

        $categoria->setNomeCategoria($_POST['nome']);

        if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

            $id = $_GET['codigo'];
            $categoria->setIdCategoria($id);

            if ($categoriaController->alterar($categoria)) {
                Message::makeSuccessSwal("Categoria alterado com sucesso!");
            } else {
                Message::makeErrorSwal("Não foi possível alterar categoria!");
            }

        } else {

            if ($categoriaController->adicionar($categoria)) {
                Message::makeSuccessSwal("Categoria adicionado com sucesso!", "window.location = 'categoria/{$categoria->getIdCategoria()}'");
            } else {
                Message::makeErrorSwal("Não foi possível adicionar categoria!");
            }

        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

    try {

        $id = $_GET['codigo'];

        $categoria = $categoriaController->carregar($id);

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_POST['excluir'])) {

    try {
        $id = $_POST['codigo'];

        if ($categoriaController->excluir($id)) {
            Message::makeSuccessSwal("Categoria excluído com sucesso!", "window.location = 'categoria/listar'");
        } else {
            Message::makeErrorSwal("Não foi possível excluir categoria!");
        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastrar Categoria</h1>
</div>
<form method="post">
    <?php if (!empty($categoria->getIdCategoria())) { ?>
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="nome">Código:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo"
                           value="<?= $categoria->getIdCategoria() ?>" readonly>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= $categoria->getNomeCategoria() ?>">
    </div>
    <div class="btn-group btn-group-lg btn-sm-sticky" role="group">
        <button type="submit" class="btn btn-success" name="gravar">
            <i class="fa fa-save"></i> Gravar
        </button>
        <?php if (!empty($categoria->getIdCategoria())) { ?>
            <button type="button" class="btn btn-danger"
                    onclick="excluir('categoria/excluir', 'categoria', '<?= $categoria->getIdCategoria() ?>')">
                <i class="fa fa-trash-alt"></i> Excluir
            </button>
        <?php } ?>
        <button type="button" class="btn btn-secondary" onclick="novo('categoria/novo', 'categoria')">
            <i class="fa fa-file"></i> Novo
        </button>
    </div>
</form>
<script src="js/form.utils.js"></script>