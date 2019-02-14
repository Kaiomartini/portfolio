<?php

require_once '../autoload.php';

use controller\CategoriaController;
use controller\MateriaController;
use controller\ProfessorController;
use controller\ProjetoController;
use controller\SemestreController;
use model\Projeto;
use util\Message;
use util\ImageResize;


$projeto = new Projeto();
$projetoController = new ProjetoController();

$materiaController = new MateriaController();
$categoriaController = new CategoriaController();
$semestreController = new SemestreController();
$professorController = new ProfessorController();

$categorias = $categoriaController->getCategorias();
$semestres = $semestreController->getSemestres();
$professores = $professorController->getProfessores();
$materias = $materiaController->getMaterias();

if (isset($_POST['gravar'])) {

    try {
        $projeto->setNomeProjeto(isset($_POST['nome']) ? $_POST['nome'] : null);
        $projeto->setIdCategoria(isset($_POST['categoria']) ? $_POST['categoria'] : null);
        $projeto->setIdMateria(isset($_POST['materia']) ? $_POST['materia'] : null);
        $projeto->setIdSemestre(isset($_POST['semestre']) ? $_POST['semestre'] : null);
        $projeto->setIdProfessor(isset($_POST['professor']) ? $_POST['professor'] : null);

        if (isset($_FILES['imagemProjeto']) && !empty($_FILES["imagemProjeto"]["tmp_name"])) {

            $image = new ImageResize($_FILES["imagemProjeto"]["tmp_name"]);
            $fileName = '../images/projeto/' . hash_file('md5', $_FILES["imagemProjeto"]["tmp_name"]) . '.png';
            $image->save($fileName, IMAGETYPE_PNG);

            $projeto->setImagemProjeto($fileName);

        }else{
            $projeto->setImagemProjeto(isset($_POST['imagemProjetoOld']) ? $_POST['imagemProjetoOld'] : null);
        }

        if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

            $id = $_GET['codigo'];
            $projeto->setIdProjeto($id);

            if ($projetoController->alterar($projeto)) {
                Message::makeSuccessSwal("Projeto alterado com sucesso!");
            } else {
                Message::makeErrorSwal("Não foi possível alterar projeto!");
            }

        } else {

            if ($projetoController->adicionar($projeto)) {
                Message::makeSuccessSwal("Projeto adicionado com sucesso!", "window.location = 'projeto/{$projeto->getIdProjeto()}'");
            } else {
                Message::makeErrorSwal("Não foi possível adicionar projeto!");
            }

        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {

    try {

        $id = $_GET['codigo'];

        $projeto = $projetoController->carregar($id);

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

} else if (isset($_POST['excluir'])) {

    try {
        $id = $_POST['codigo'];

        if ($projetoController->excluir($id)) {
            Message::makeSuccessSwal("Projeto excluído com sucesso!", "window.location = 'projeto/listar'");
        } else {
            Message::makeErrorSwal("Não foi possível excluir projeto!");
        }

    } catch (\Exception $ex) {
        Message::makeErrorSwal($ex->getMessage());
    }

}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastrar Projeto</h1>
</div>
<form method="post" enctype="multipart/form-data">
    <?php if (!empty($projeto->getIdProjeto())) { ?>
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="nome">Código:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo"
                           value="<?= $projeto->getIdProjeto() ?>" readonly>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= $projeto->getNomeProjeto() ?>">
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control select2" id="categoria" name="categoria">
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?= $categoria->getIdCategoria(); ?>"<?= $categoria->getIdCategoria() == $projeto->getIdCategoria() ? " selected" : "" ?>><?= $categoria->getNomeCategoria(); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="materia">Materia</label>
                <select class="form-control select2" id="materia" name="materia">
                    <?php foreach ($materias as $materia) { ?>
                        <option value="<?= $materia->getIdMateria(); ?>"<?= $materia->getIdMateria() == $projeto->getIdMateria() ? " selected" : "" ?>><?= $materia->getNomeMateria(); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="semestre">Semestre</label>
                <select class="form-control select2" id="semestre" name="semestre">
                    <?php foreach ($semestres as $semestre) { ?>
                        <option value="<?= $semestre->getIdSemestre(); ?>"<?= $semestre->getIdSemestre() == $projeto->getIdSemestre() ? " selected" : "" ?>><?= $semestre->getNomeSemestre(); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="professor">Professor</label>
                <select class="form-control select2" id="professor" name="professor">
                    <?php foreach ($professores as $professor) { ?>
                        <option value="<?= $professor->getIdProfessor(); ?>"<?= $professor->getIdProfessor() == $projeto->getIdProfessor() ? " selected" : "" ?>><?= $professor->getNomeProfessor(); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Imagem do Projeto</label>
                <div class="input-group mb-3 btn-file">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary btn-sm" type="button" id="button-addon1"
                                onclick="$('#imgInp').trigger('click');">Enviar…
                        </button>
                    </div>
                    <input type="hidden" name="imagemProjetoOld" value="<?= $projeto->getImagemProjeto() ?>">
                    <input type="file" id="imgInp" class="invisible" name="imagemProjeto">
                    <input type="text" class="form-control" readonly>
                </div>
                <img class="img-fluid" id='img-upload' src="<?= $projeto->getImagemProjeto() ?>" style=""/>
            </div>
        </div>
    </div>
    <div class="btn-group btn-group-lg btn-sm-sticky" role="group">
        <button type="submit" class="btn btn-success" name="gravar">
            <i class="fa fa-save"></i> Gravar
        </button>
        <?php if (!empty($projeto->getIdProjeto())) { ?>
            <button type="button" class="btn btn-danger"
                    onclick="excluir('projeto/excluir', 'projeto', '<?= $projeto->getIdProjeto() ?>')">
                <i class="fa fa-trash-alt"></i> Excluir
            </button>
        <?php } ?>
        <button type="button" class="btn btn-secondary" onclick="novo('projeto/novo', 'projeto')">
            <i class="fa fa-file"></i> Novo
        </button>
    </div>
</form>
<script src="js/form.utils.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            language: "pt-BR"
        });

        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });

    });
</script>