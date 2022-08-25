<nav class="navbar navbar-light fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/estante_virtual/">
                            <img src="https://cdn-icons-png.flaticon.com/512/553/553416.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                            Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="http://localhost/estante_virtual/assets/images/livros.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                            Livros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="http://localhost/estante_virtual/livro/cadastro">Cadastrar livro</a></li>
                            <li><a class="dropdown-item" href="http://localhost/estante_virtual/livros">Listagem de livros</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="http://localhost/estante_virtual/assets/images/autor.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                            Autores
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="http://localhost/estante_virtual/autor/cadastro">Cadastrar autor</a></li>
                            <li><a class="dropdown-item" href="http://localhost/estante_virtual/autores">Listagem de autores</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="http://localhost/estante_virtual/assets/images/editora.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                            Editoras
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="http://localhost/estante_virtual/editora/cadastro">Cadastrar editora</a></li>
                            <li><a class="dropdown-item" href="http://localhost/estante_virtual/editoras">Listagem de editoras</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
