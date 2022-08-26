<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
          <div class="card-body p-5">

            <p class="lead fw-bold mb-5" style="color: #f37a27;"><?php echo $editora->getNome()  ?></p>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Código</p>
                <p><?php echo $editora->getCodigo() ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Cidade</p>
                <p><?php echo $editora->getCidade() ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">E-mail</p>
                <p><?php echo $editora->getEmail() ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Telefone</p>
                <p><?php echo $editora->getTelefone() ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Website</p>
                <p><?php echo $editora->getWebSite() ?></p>
              </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <a class="w-100 btn btn-primary" href="http://localhost/estante_virtual/editora/edicao/<?php echo $editora->getCodigo(); ?>" role="button">Alterar editora</a>
                </div>
                <div class="col mb-3">
                    <a class="w-100 btn btn-primary" href="http://localhost/estante_virtual/editora/exclui/<?php echo $editora->getCodigo(); ?>" role="button">Excluir editora</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>

