<div class="container">
    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <form class="my-3" action="http://localhost/estante_virtual/autor/cadastro" method="POST">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                            <label for="nome">Nome</label>
                        </div>
                        <div id="msgErrorNome" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="email" name="email" placeholder="E-mail">
                            <label for="email">E-mail</label>
                        </div>
                        <div id="msgErrorEmail" class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="website" name="website" placeholder="Web site">
                            <label for="nome">Web site</label>
                        </div>
                        <div id="msgErrorNome" class="invalid-feedback">
                        </div>
                    </div>

                </div>
                <div class="my-3 row g-3">
                    <div class="col-md-6">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
                    </div>
                    <div class="col-md-6">
                        <button class="w-100 btn btn-primary btn-lg" type="reset">Limpar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

