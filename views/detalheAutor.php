<?php 
    include_once "funcoes.php";
    include_once "database/AutorDAO.php";

    $codigoAutor = $_GET["url"][-1];
    $autor = AutorDAO::buscaAutor($codigoAutor);
?>

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
          <div class="card-body p-5">

            <p class="lead fw-bold mb-5" style="color: #f37a27;"><?php echo $autor->getNome()  ?></p>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Código</p>
                <p><?php echo $autor->getCodigo() ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">E-mail</p>
                <p><?php echo $autor->getEmail() ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Website</p>
                <p><?php echo $autor->getWebSite() ?></p>
              </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <a class="w-100 btn btn-primary" href="http://localhost/estante_virtual/autor/edicao/<?php echo $autor->getCodigo(); ?>" role="button">Alterar autor</a>
                </div>
                <div class="col mb-3">
                    <a class="w-100 btn btn-primary" href="http://localhost/estante_virtual/autor/exclui/<?php echo $autor->getCodigo(); ?>" role="button">Excluir autor</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>
