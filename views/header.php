<nav class="navbar navbar-expand-lg bg-body border-bottom border-secondary">

    <style>
        .parent-container {
            height: 50px;
            overflow: hidden;
        }

        .parent-container img {
            height: 100%;
            width: auto;
            display: block;
        }
    </style>

    <div class="container-fluid">
        <a class="navbar-brand" href="home">Početna</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="profile">Profil</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") : ?>
                        <a class="nav-link active" href="admin">Admin</a>
                    <?php else : ?>
                        <a class="nav-link disabled">Admin</a>
                    <?php endif; ?>

                </li>
            </ul>

            <div class="parent-container">
                <img src="barcodes/code_165197697230.png" alt="barcode alt">
            </div>
            <?php if (isset($_COOKIE["sessionid"])) : ?>
                <a class="btn btn-danger" href="logout">Odjava</a>
            <?php endif; ?>
        </div>
    </div>
</nav>


<!-- <header class="p-3 bg-dark text-white w-100">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                        <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
                        <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                        <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                        <li><a href="#" class="nav-link px-2 text-white">About</a></li>
                    </ul>

                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                    </form>

                    <div class="text-end">
                        <button type="button" class="btn btn-outline-light me-2">Login</button>
                        <button type="button" class="btn btn-warning">Sign-up</button>
                    </div>
                </div>
            </div>
        </header> -->