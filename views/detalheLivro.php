<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
          <div class="card-body p-5">

            <p class="lead fw-bold mb-5" style="color: #f37a27;"><?php echo $livro->getTitulo() ?></p>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Código</p>
                <p><?php echo $livro->getCodigo() ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">ISBN</p>
                <p><?php echo $livro->getIsbn() ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Número de páginas</p>
                <p><?php echo $livro->getNumeroPaginas() ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Ano publicação</p>
                <p><?php echo $livro->getAnoPublicacao() ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Editora</p>
                <p><?php echo "<a href=\"http://localhost/estante_virtual/editora/" .$livro->getEditora()->getCodigo(). "\">" . $livro->getEditora()->getNome() . "</a>" ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Número da edição</p>
                <p><?php echo $livro->getNumeroEdicao() ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Autores</p>
                <?php 
                    foreach ($livro->getListaAutores() as $autor) {
                        echo "<p><a href=\"http://localhost/estante_virtual/autor/" .$autor->getCodigo(). "\">" .$autor->getNome(). "</a></p>";
                    }
                ?>
              </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <a class="w-100 btn btn-primary" href="http://localhost/estante_virtual/livro/edicao/<?php echo $livro->getCodigo(); ?>" role="button">Alterar livro</a>
                </div>
                <div class="col mb-3">
                    <a class="w-100 btn btn-primary" href="http://localhost/estante_virtual/livro/exclui/<?php echo $livro->getCodigo(); ?>" role="button">Excluir livro</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>
