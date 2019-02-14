<?php
session_start();
ini_set('default_charset', 'utf-8');
require_once '../autoload.php';

if (!isset($_GET['Pagina'])) {
    $_GET['Pagina'] = "dashboard";
}

/*if (!($_GET['Pagina'] == "cliente" or $_GET['Pagina'] == "produto")) {
    $_GET['Pagina'] = "login";
}*/


require_once 'fragments/header.php';

?>
    <!-- page content -->


<?php include_once($_GET['Pagina'] . ".php"); ?>

    <!-- /page content -->

<?php require_once 'fragments/footer.php' ?>