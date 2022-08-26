<?php
include_once "database/EditoraDAO.php";
include_once "database/AutorDAO.php";
include_once "classes/Livro.php";

$livro = new Livro();
if (isset($livroEdicao))
    $livro = $livroEdicao;

?>

<script src="http://localhost/estante_virtual/assets/js/validacoes.js"></script>
<script src="http://localhost/estante_virtual/assets/js/funcoes.js"></script>
<script>
    function validaFormulario()
    {
        let titulo = $("#titulo");
        let editora = $("#cod_editora");
        $(".invalid-feedback").hide();

        if (titulo.val().length == 0) {
            let msgErrorTitulo = $("#msgErrorTitulo");
            msgErrorTitulo.html("Informe o titulo!");
            msgErrorTitulo.show();
            event.preventDefault();
        }

        if (editora.val().length == 0) {
            let msgErrorEditora = $("#msgErrorEditora");
            msgErrorEditora.html("Informe a editora!");
            msgErrorEditora.show();
            event.preventDefault();
        }
    }
</script>

<div class="container">
    <h1 class="display-4"><?php echo $title; ?></h1>
    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <form class="my-3" onsubmit="validaFormulario()" action="http://localhost/estante_virtual/livro/<?php echo (isset($livroEdicao) ? "edicao/{$livro->getCodigo()}" : "cadastro"); ?>" method="POST">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control campoFormulario" id="titulo" name="titulo" placeholder="Titulo" value="<?php echo $livro->getTitulo() ?>">
                            <label for="titulo">Titulo</label>
                        </div>
                        <div id="msgErrorTitulo" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control campoFormulario" id="isbn" name="isbn" placeholder="ISBN" value="<?php echo $livro->getIsbn(); ?>">
                            <label for="isbn">ISBN</label>
                        </div>
                        <div id="msgErrorEmail" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" min="1" class="form-control campoFormulario" id="numpaginas" name="numpaginas" placeholder="Número de páginas" value="<?php echo ($livro->getNumeroPaginas() != 0 ? $livro->getNumeroPaginas() : "") ?>">
                            <label for="numpaginas">Número de páginas</label>
                        </div>
                        <div id="msgErrorNumeroPaginas" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" class="form-control campoFormulario" id="numedicao" name="numedicao" placeholder="Número da edição" value="<?php echo ($livro->getNumeroEdicao() != 0 ? $livro->getNumeroEdicao() : "") ?>">
                            <label for="numedicao">Número da edição</label>
                        </div>
                        <div id="msgErrorNumeroEdicao" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" class="form-control campoFormulario" id="anopublicacao" name="anopublicacao" placeholder="Ano da publicação" value="<?php echo ($livro->getAnoPublicacao() != 0 ? $livro->getAnoPublicacao() : "") ?>">
                            <label for="anopublicacao">Ano da publicação</label>
                        </div>
                        <div id="msgErrorAnoPublicacao" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="cod_editora" class="form-label">Editora</label>
                        <select class="form-select campoFormulario" id="cod_editora" name="cod_editora">
                            <option value="">Escolha...</option>
                            <?php
                                $editoras = EditoraDAO::buscaEditoras();
                                foreach ($editoras as $editora) {
                                    echo "<option " .($editora->getCodigo() == $livro->getEditora()->getCodigo() ? "selected" : ""). " value=\"{$editora->getCodigo()}\">{$editora->getNome()}</option>";
                                }
                            ?>
                        </select>
                        <div id="msgErrorEditora" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <fieldset class="my-3">
                            <legend>Autores</legend>
                                <?php
                                    $autores = AutorDAO::buscaAutores();
                                    foreach ($autores as $autor) {
                                        echo "<div class=\"form-check\">";
                                        echo "  <input class=\"form-check-input autores campoFormularioCheckBox\" " .(in_array($autor, $livro->getListaAutores()) ? "checked" : ""). " type=\"checkbox\" id=\"{$autor->getCodigo()}\" name=\"autores[]\" value='{$autor->getCodigo()}'/>";
                                        echo "  <label class=\"form-check-label\" for=\"{$autor->getCodigo()}\">{$autor->getNome()}</label>";
                                        echo "</div>";
                                    }
                                ?>
                        </fieldset>
                        <div id="msgErrorAutores" class="invalid-feedback">
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
