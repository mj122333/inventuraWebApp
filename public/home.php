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

        <?php include "header.php"; ?>

        <main class="d-flex flex-row" style="flex: 1;">
            <?php include 'sidebar.php'; ?>

            <?php if (true) : ?>
                <img src="favicon/logo_light.svg" alt="Logo SVG" class="mx-auto" />
            <?php endif; ?>
        </main>

    </div>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>