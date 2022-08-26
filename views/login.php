<?php

$usuario = "";
$senha = "";
$lembrarLogin = "";

if (isset($_COOKIE["lembrarLogin"])) {
    $lembrarLogin = $_COOKIE["lembrarLogin"];

    if ($lembrarLogin) {
        if (isset($_COOKIE["usuario"]))
            $usuario = $_COOKIE["usuario"];

        if (isset($_COOKIE["senha"]))
            $senha = base64_decode($_COOKIE["senha"]);
    }
}

if (isset($_SESSION["logado"]) && !$_SESSION["logado"]) {
    $usuario = $_SESSION["usuario"];
    $lembrarLogin = $_SESSION["lembrarLogin"];
}

?>
<link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
<form class="form-signin" style="position: absolute;top: 25%;left: 25%;right: 25%;bottom: 25%;" action="http://localhost/estante_virtual/login" method="POST">
    <img class="mb-4"
         src="http://localhost/estante_virtual//assets/images/estante.png"
         alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Faça seu login</h1>

    <div class="form-floating">
        <input type="text" name="usuario" class="form-control" id="floatingInput" placeholder="Usuario"
               value="<?php echo $usuario; ?>">
        <label for="floatingInput">Usuário</label>
    </div>
    <div class="form-floating">
        <input type="password" name="senha" class="form-control" id="password" placeholder="Senha"
               data-toggle="password" value="<?php echo $senha; ?>">
        <label for="password">Senha</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="lembrarLogin"
                   value="1" <?php echo($lembrarLogin == 1 ? "checked" : ""); ?> >
            Lembrar de mim
        </label>
    </div>
    <div style="color: red;">
        <?php
        //if (isset($_SESSION["status"]) && $_SESSION["status"] != 0)
        //    echo $statusMsg[$_SESSION["status"]];
        ?>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
</form>
