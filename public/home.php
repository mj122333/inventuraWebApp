<?php
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Inventura</title>
</head>

<style>
    body {
        height: 100vh;
    }

    /* ::-webkit-scrollbar {
        width: 0;
        background-color: transparent;
    } */
</style>


<body data-bs-theme="dark">

    <div class="h-100 d-flex flex-column" style="flex: 1;">
        <?php
        include "header.php";
        ?>

        <main class="d-flex flex-row" style="flex: 1;">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-body-tertiary border-end border-secondary" style="width: 280px;">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4">Dashboard</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white bg-success" aria-current="page">
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
                        <a href="#" class="nav-link text-white">
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
            <?php if (true) : ?>
                <img src="favicon/logo_light.svg" alt="Logo SVG" class="mx-auto" />
            <?php endif; ?>
        </main>

    </div>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>