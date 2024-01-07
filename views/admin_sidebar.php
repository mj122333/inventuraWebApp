<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-body-tertiary border-end border-secondary" id="sidebar" style="width: 280px;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

        <li>
            <a href="<?php echo DS . APPFOLDER . DS ?>admin/evidencija" class="<?php echo $sub_route == "evidencija" ? "bg-success" : ""  ?> nav-link text-white">
                Evidencija
            </a>
        </li>
        <!-- <li>
            <a href="ljudi" class="nav-link text-white">
                Ljudi
            </a>
        </li> -->
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
            <a href="#" class="nav-link text-white">
                <b><i><?= "route: " . $route ?></i></b>
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
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
    </div>
</div>