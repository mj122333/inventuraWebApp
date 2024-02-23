<nav class="navbar navbar-expand bg-body border-bottom border-1">

    <div class="container-fluid">
        <!-- <a class="navbar-brand" href="<?php echo DS . APPFOLDER . DS ?>home">Početna</a> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo DS . APPFOLDER . DS ?>home">Početna</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo DS . APPFOLDER . DS ?>profile">Profil</a>
                </li>

                <li class="nav-item">
                    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") : ?>
                        <a class="nav-link active" href="<?php echo DS . APPFOLDER . DS ?>admin">Admin</a>
                    <?php else : ?>
                        <a class="nav-link disabled">Admin</a>
                    <?php endif; ?>

                </li>
            </ul>

            <?php if (isset($_COOKIE["sessionid"])) : ?>
                <a class="btn btn-danger" href="<?php echo DS . APPFOLDER . DS ?>logout">Odjava <i class="bi bi-box-arrow-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
</nav>
