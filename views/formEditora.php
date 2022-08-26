<?php
include_once "database/EditoraDAO.php";
include_once "classes/Editora.php";

$editora = new Editora();
if (isset($editoraEdicao))
    $editora = $editoraEdicao;
?>

<script src="http://localhost/estante_virtual/assets/js/validacoes.js"></script>
<script src="http://localhost/estante_virtual/assets/js/funcoes.js"></script>
<script>

    $(document).ready(function () {
        $("#telefone").mask("+55 (00) 00000-0000");
    });

    function validaFormulario()
    {
        let nome = $("#nome");
        let email = $("#email");
        let telefone = $("#telefone");
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

        if (telefone.val().length != 0 && !validaTelefone(telefone.val())) {
            let msgErrorTelefone = $("#msgErrorTelefone");
            msgErrorTelefone.html("Telefone inválido!");
            msgErrorTelefone.show();
            event.preventDefault();
        }

    }
</script>

<div class="container">
    <h1 class="display-4"><?php echo $title; ?></h1>
    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <form class="my-3"  action="http://localhost/estante_virtual/editora/<?php echo (isset($editoraEdicao) ? "edicao/{$editoraEdicao->getCodigo()}" : "cadastro"); ?>" method="POST">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control campoFormulario" id="nome" name="nome" placeholder="Nome" value="<?php echo $editora->getNome() ?>">
                            <label for="nome">Nome</label>
                        </div>
                        <div id="msgErrorNome" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cidade" class="form-label">Cidade</label>
                        <select class="form-select campoFormulario" id="cidade" name="cidade">
                            <option value="">Escolha...</option>
                            <option <?php echo ($editora->getCidade() == "Gaspar" ? " selected " : "") ?> value="Gaspar">Gaspar</option>
                        </select>
                        <div id="msgErrorCidade" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control campoFormulario" id="email" name="email" placeholder="E-mail" value="<?php echo $editora->getEmail() ?>">
                            <label for="email">E-mail</label>
                        </div>
                        <div id="msgErrorEmail" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="tel" class="form-control campoFormulario" id="telefone" name="telefone" placeholder="Telefone" value="<?php echo $editora->getTelefone() ?>">
                            <label for="telefone">Telefone</label>
                        </div>
                        <div id="msgErrorTelefone" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control campoFormulario" id="website" name="website" placeholder="Web site" value="<?php echo $editora->getWebSite() ?>">
                            <label for="website">Web site</label>
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
