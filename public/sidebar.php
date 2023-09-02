<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-body-tertiary border-end border-secondary" style="width: 280px;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link text-white" aria-current="page">
                <!-- <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#home"></use>
                            </svg> -->
                Home
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                Dashboard
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                Orders
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white bg-success">
                Products
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                Customers
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