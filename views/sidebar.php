<div class="d-lg-flex d-none flex-column flex-shrink-0 p-3 text-white bg-body-tertiary border-end border-secondary" id="sidebar" style="width: 200px;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4"><?= translate_route($route) ?></span>
    </a>
    <hr>

    <style>
        ul li:hover {
            background-color: #212529;
            border-radius: 5px;
        }
    </style>

    <?php if ($route == "admin") { ?>
        <ul class="nav nav-pills flex-column mb-auto">

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/evidencija" class="<?php echo $sub_route == "evidencija" ? "bg-success" : ""  ?> nav-link text-white">
                    Evidencija
                </a>
            </li>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/ucionice" class="<?php echo $sub_route == "ucionice" ? "bg-success" : ""  ?> nav-link text-white">
                    Učionice
                </a>
            </li>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/profesori" class="<?php echo $sub_route == "profesori" ? "bg-success" : ""  ?> nav-link text-white">
                    Profesori
                </a>
            </li>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/proizvodi" class="<?php echo $sub_route == "proizvodi" ? "bg-success" : ""  ?> nav-link text-white">
                    Proizvodi
                </a>
            </li>

        </ul>

    <?php } else { ?>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link text-white bg-success" aria-current="page">
                    <!-- <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#home"></use>
                            </svg> -->
                    Početna
                </a>
            </li>
            <!-- <li>
                <a href="#" class="nav-link text-white">
                    Dashboard
                </a>

            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    Ljudi
                </a>
            </li>
            <li>
                <a href="ucionice" class="nav-link text-white">
                    Učionice
                </a>
            </li> -->
        </ul>
    <?php } ?>

    <hr>
    <div>
        <!-- <ion-icon name="person-outline"></ion-icon> -->
        <strong><?= $_SESSION["username"] ?></strong>
    </div>
    <!-- <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <ion-icon name="person-outline"></ion-icon>
            <strong><?= $_SESSION["username"] ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="logout">Odjava</a></li>
        </ul>
    </div> -->
</div>