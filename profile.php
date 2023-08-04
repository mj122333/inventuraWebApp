<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Profil</title>
</head>

<body data-bs-theme="dark">

    <?php
    include 'header.php';
    ?>

    <main>
        <p>profil</p>
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
    </main>

    <?php
    include 'footer.php';
    ?>

</body>

</html>