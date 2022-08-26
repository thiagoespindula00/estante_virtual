<?php

include_once "database/AutorDAO.php";
include_once "classes/Autor.php";

$autor = new Autor();
if (isset($autorEdicao))
    $autor = $autorEdicao;

?>

<script src="http://localhost/estante_virtual/assets/js/validacoes.js"></script>
<script src="http://localhost/estante_virtual/assets/js/funcoes.js"></script>
<script>
    function validaFormulario()
    {
        let nome = $("#nome");
        let email = $("#email");
        $(".invalid-feedback").hide();

        if (nome.val().length == 0) {
            let msgErrorNome = $("#msgErrorNome");
            msgErrorNome.html("Informe o nome!");
            msgErrorNome.show();
            event.preventDefault();
        }

        if (email.val().length != 0 && !validaEmail(email.val())){
            let msgErrorEmail = $("#msgErrorEmail");
            msgErrorEmail.html("E-mail inválido!");
            msgErrorEmail.show();
            event.preventDefault();
        }
    }
</script>

<div class="container">
    <h1 class="display-4"><?php echo $title; ?></h1>
    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <form class="my-3" onsubmit="validaFormulario()" action="http://localhost/estante_virtual/autor/<?php echo (isset($autorEdicao) ? "edicao/{$autor->getCodigo()}" : "cadastro"); ?>" method="POST">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control campoFormulario" id="nome" name="nome" placeholder="Nome" value="<?php echo $autor->getNome() ?>">
                            <label for="nome">Nome</label>
                        </div>
                        <div id="msgErrorNome" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control campoFormulario" id="email" name="email" placeholder="E-mail" value="<?php echo $autor->getEmail() ?>">
                            <label for="email">E-mail</label>
                        </div>
                        <div id="msgErrorEmail" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control campoFormulario" id="website" name="website" placeholder="Web site" value="<?php echo $autor->getWebSite() ?>">
                            <label for="nome">Web site</label>
                        </div>
                        <div id="msgErrorWebsite" class="invalid-feedback">
                        </div>
                    </div>

                </div>
                <div class="my-3 row g-3">
                    <div class="col-md-6">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
                    </div>
                    <div class="col-md-6">
                        <input type="button" class="w-100 btn btn-primary btn-lg" onclick="limpaCamposFormulario()" value="Limpar" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
