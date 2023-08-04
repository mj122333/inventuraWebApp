<nav class="navbar navbar-expand-lg bg-body-tertiary">

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
        <a class="navbar-brand" href="./">Početna</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="profile.php">Profil</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") : ?>
                        <a class="nav-link active" href="admin.php">Admin</a>
                    <?php else : ?>
                        <a class="nav-link disabled">Admin</a>
                    <?php endif; ?>

                </li>
            </ul>

            <div class="parent-container">
                <img src="new_code0.png" alt="">
            </div>
            <?php if (isset($_COOKIE["sessionid"])) : ?>
                <a class="nav-link" href="logout.php">Odjava</a>
            <?php endif; ?>
        </div>
    </div>
</nav>