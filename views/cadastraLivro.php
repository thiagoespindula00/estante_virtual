<?php
include_once "database/EditoraDAO.php";
?>

<div class="container">
    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <form class="my-3" action="http://localhost/estante_virtual/livro/cadastro" method="POST">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
                            <label for="titulo">Titulo</label>
                        </div>
                        <div id="msgErrorNome" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN">
                            <label for="isbn">ISBN</label>
                        </div>
                        <div id="msgErrorEmail" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="numpaginas" name="numpaginas" placeholder="Número de páginas">
                            <label for="numpaginas">Número de páginas</label>
                        </div>
                        <div id="msgErrorNome" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="numedicao" name="numedicao" placeholder="Número da edição">
                            <label for="numedicao">Número da edição</label>
                        </div>
                        <div id="msgErrorNome" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="anopublicacao" name="anopublicacao" placeholder="Ano da publicação">
                            <label for="anopublicacao">Ano da publicação</label>
                        </div>
                        <div id="msgErrorNome" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cod_editora" class="form-label">Editora</label>
                        <select class="form-select" id="cod_editora" name="cod_editora">
                            <option value="">Escolha...</option>
                            <?php
                                $editoras = EditoraDAO::buscaEditoras();
                                foreach ($editoras as $editora) {
                                    echo "<option value='{$editora->getCodigo()}'>{$editora->getNome()}</option>";
                                }
                            ?>
                        </select>
                        <div id="msgErrorCurso" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="my-3 row g-3">
                    <div class="col-md-6">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
                    </div>
                    <div class="col-md-6">
                        <button class="w-100 btn btn-primary btn-lg" type="reset" onClick="limpa();$('#atencao').hide();">Limpar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
