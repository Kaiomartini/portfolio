<?php
session_start();
if(isset($_SESSION['usuario'])){
    header("Location: dashboard");
}
if (isset($_POST['usuario']) && isset($_POST['senha'])) {

    $usuario = !empty($_POST['usuario']) ? $_POST['usuario'] : null;
    $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;
    $msg;

    if ($usuario == 'admin' && $senha == '123456') {
        $_SESSION['usuario'] = 'Admin';
        header("Location: dashboard");
    } else if ($usuario == 'caio' && $senha == 'carona') {
        $_SESSION['usuario'] = 'caio';
        header("Location: dashboard");
    } else {
        $msg = 'Usuário e/ou senha inválido(s).';
    }

}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8"/>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Logim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>

    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">


    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/material-dashboard.min.css" rel="stylesheet"/>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 500px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .btn.btn-primary {
            background-color:#008bd8;
            
            
        }
        .btn.btn-primary:hover {
            background-color:#005788;
            
            
        }
        a{
            color:#0a6ebd;
        }

    </style>

</head>

<body class="text-center">
<form class="form-signin" method="post">
    
    <h1 class="h3 mb-3 font-weight-normal">Administração</h1>
    <label for="usuario" class="sr-only">Usuário</label>
    <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuário" required autofocus>
    <label for="senha" class="sr-only">Senha</label>
    <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Lembrar-me
        </label>
    </div>
    <?php if (isset($msg)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
  {$msg}
</div>";
    } ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
    <p class="mt-5 mb-3 text-muted">Copyright &copy;
        <script>document.write(new Date().getFullYear());</script>
        <a href="https://kaique.tech"
           target="_blank">Caio martini</a> - All rights reserved.
    </p>
</form>
</body>

</html>
