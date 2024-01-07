<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Profil</title>
</head>

<style>
    /* body {
        height: 100vh !important;
    } */

    html,
    body {
        height: 100%;
    }

    /* ::-webkit-scrollbar {
            width: 0;
            background-color: transparent;
        } */
</style>

<!-- <body data-bs-theme="dark" class="d-flex justify-content-center align-items-center flex-column"> -->

<body data-bs-theme="dark">

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include "header.php"; ?>

        <main class="d-flex flex-row" style="flex: 1;">
            <?php include 'sidebar.php'; ?>

            <div class="container border py-3 col-lg-6 col-12 my-5">


                <!-- <?php foreach ($_SESSION as $key => $value) {
                            echo "$key: $value<br>";
                        } ?> -->

                <form method="POST" action="profile">

                    <div class="input-group mb-3">
                        <span class="input-group-text">ime</span>
                        <input type="text" class="form-control" name="ime" id="ime" placeholder="ime" value="<?= $_SESSION['ime']; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">prezime</span>
                        <input type="text" class="form-control" name="prezime" id="prezime" placeholder="prezime" value="<?= $_SESSION['prezime']; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">username</span>
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?= $_SESSION['username']; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">e-mail</span>
                        <span class="form-control text-muted"><?= $_SESSION["email"] ?></span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">datum registracije</span>
                        <span class="form-control text-muted"><?= date_format(date_create($_SESSION["datum_registracije"]), "d.m.Y. H:i:s") ?></span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">role</span>
                        <span class="form-control text-muted"><?= $_SESSION["role"] ?></span>
                    </div>

                    <button class="btn btn-success w-100" name="update_user" value="update_user" type="submit">Ažuriraj podatke</button>
                </form>
                <button id="update-button">update</button>
            </div>
        </main>

        <script>
            $(document).ready(function() {
                $("#update-button").click(function() {
                    console.log("klik")
                    Swal.fire({
                        position: "top-end",
                        target: "main",
                        icon: "success",
                        title: "Podaci uspješno ažurirani",
                        showConfirmButton: false,
                        timer: 1500 * 60,
                    });
                });
            });
        </script>
    </div>
</body>

</html>