<?php
include "db_config.php";


if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header('HTTP/1.1 403 Forbidden');
    exit;
}

$kod = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["invite"])) {
        $kod = bin2hex(random_bytes(4));
    }
    $userID = $_SESSION["id"];
    $sql = "SELECT * FROM invite_codes WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $rows = $stmt->get_result();
    if (mysqli_num_rows($rows) === 1) {
        $result = $rows->fetch_assoc();
        $sql = "UPDATE invite_codes SET kod = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $kod, $userID);
        $stmt->execute();
    } else {
        $sql = "INSERT INTO invite_codes (kod, user_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $kod, $userID);
        $stmt->execute();
    }
}

$sql = "SELECT users.username FROM pozvani, users WHERE users.id = user_id AND admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["id"]);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Admin</title>
</head>

<style>
    body {
        height: 100vh;
    }
</style>

<body data-bs-theme="dark" class="d-flex flex-column px-0">


    <div class="h-100 d-flex flex-column" style="flex: 1;">


        <?php
        include 'header.php';
        ?>
        <!-- <main class="container">
        <div class="row">
            <div class="col-3">
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark shadow">
                    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <svg class="bi me-2" width="40" height="32">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                        <span class="fs-4">Sidebar</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2"></use>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#table"></use>
                                </svg>
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#grid"></use>
                                </svg>
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#people-circle"></use>
                                </svg>
                                Customers
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/smartphone_mockup.svg" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong><?= $_SESSION["username"] ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Odjava</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="container border rounded py-3 w-50 my-5">
                    <?php
                    print_r($_SESSION);
                    ?>
                    <p>Admin page</p>
                    <a class="btn btn-outline-primary" href="?invite=true">Genriraj kod za poziv</a>
                    <?php if ($kod) : ?>
                        <p>Vaš kod: <?= $kod ?></p>
                    <?php endif; ?>

                    <ul class="list-group">
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <li class="list-group-item"><?= $row["username"] ?></li>
                        <?php endwhile; ?>
                    </ul>

                    <p><?php
                        if (isset($_COOKIE["sessionid"])) {
                            echo $_COOKIE["sessionid"];
                        }
                        ?></p>
                    <p>
                        <?php
                        echo $_SESSION["role"];
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </main> -->
        <main class="d-flex flex-row">
            <?php include 'sidebar.php'; ?>
            <div class="container-fluid row px-0 mx-0 h-100">
                <div class="col px-5">
                    <div class="border h-50 overflow-auto">
                        <table class="table table-dark table-hover">
                            <thead class="position-sticky" style="top: 0;">
                                <tr>
                                    <th scope="col">Obriši</th>
                                    <th>ID</th>
                                    <th>proizvod_id</th>
                                    <th>ucionica_id</th>
                                    <th>datum</th>
                                    <th>vrijeme</th>
                                    <th>user_id</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM evidencija";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tr class="bg-success">
                                            <th>
                                                <input class="form-check-input" type="checkbox" value="">
                                            </th>
                                            <th scope="row"><?= $row["id"] ?></th>
                                            <td><?= $row["proizvod_id"] ?></td>
                                            <td><?= $row["ucionica_id"] ?></td>
                                            <td><?= $row["datum"] ?></td>
                                            <td><?= $row["vrijeme"] ?></td>
                                            <td><?= $row["user_id"] ?></td>
                                        </tr>

                                <?php }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <p>asdadd</p>

                </div>
            </div>
        </main>

    </div>


</body>

</html>