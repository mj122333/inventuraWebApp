<?php
include "db_config.php";
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

$kod = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["invite"])) {
        $kod = bin2hex(random_bytes(4));
    }
    $userID = $_SESSION["user_id"];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Admin</title>
</head>

<body data-bs-theme="dark">

    <?php
    include 'header.php';
    ?>

    <main>
        <div class="container border rounded py-3 w-50 my-5">
            <?php
            print_r($_SESSION);
            ?>
            <p>Admin page</p>
            <a class="btn btn-outline-primary" href="?invite=true">Genriraj kod za poziv</a>
            <?php if ($kod) : ?>
                <p>Vaš kod: <?= $kod ?></p>
            <?php endif; ?>
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
    </main>

    <?php
    include 'footer.php';
    ?>

</body>

</html>