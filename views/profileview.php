<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Profil</title>

</head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/countup@1.8.2/countUp.js"></script>

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

<!-- <body data-bs-theme="light" class="d-flex justify-content-center align-items-center flex-column"> -->

<body data-bs-theme="light">
    <script defer>
        $("body").attr('data-bs-theme', initialTheme);
    </script>

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include "header.php"; ?>

        <main class="d-flex flex-row" style="flex: 1;">
            <?php include 'sidebar.php'; ?>

            <div class="p-3 bg-tertiary w-100" style="overflow-y: hidden;">
                <div class="row gy-3">

                    <div class="col-12 col-md-6">

                        <?php if ($error_message != "") : ?>
                            <p class="text-danger"><?= $error_message; ?></p>
                        <?php endif; ?>
                        <div class="card border">
                            <div class="card-body">
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

                                    <button class="btn btn-primary w-100" name="update_user" value="update_user" type="submit">Ažuriraj podatke</button>
                                </form>
                            </div>
                        </div>


                    </div>

                    <div style="height: fit-content;" class="col-6 col-md-3">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-check-circle"></i></h5>
                                <h1 id="count-up-evidencija" class="fw-bold"></h1>
                                <p class="card-text fw-semibold">evidencija</p>
                            </div>
                        </div>
                    </div>

                    <div style="height: fit-content;" class="col-6 col-md-3">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-check-circle"></i></h5>
                                <h1 id="count-up-evidencija2" class="fw-bold"></h1>
                                <p class="card-text fw-semibold">evidencija ove inventure</p>
                            </div>
                        </div>
                    </div>

                    <div style="height: fit-content;" class="col-6 col-md-3 d-block d-md-none">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-paint-bucket"></i></h5>
                                <h1 id="count-up-evidencija2" class="fw-bold"></h1>
                                <p class="card-text fw-semibold">Tema</p>
                                <div class="d-flex">
                                    <i class="lightIcon bi bi-sun-fill pe-2 text-primary"></i>
                                    <div class="form-check form-switch">
                                        <input onchange="toggleTheme()" class="themeButton form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                    <i class="darkIcon bi bi-moon-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!-- <div class="container-fluid mx-0 py-2 h-100 bg-tertiary">
                <h5>Postavke profila</h5>

                <div class="row">
                    <div class="col-4 bg-main border rounded p-3">

                        <?php if ($error_message != "") : ?>
                            <p class="text-danger"><?= $error_message; ?></p>
                        <?php endif; ?>

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
                    </div>

                    <div class="col-4 bg-main border rounded p-3">
                        BOk
                    </div>
                </div>

            </div> -->
        </main>

    </div>

</body>
<script>
    $(document).ready(function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme == "dark") {
            $('.themeButton').prop('checked', initialTheme === 'dark');
            $(".darkTableToggle").addClass("table-dark");

            $(".lightIcon").removeClass("text-primary");
            $(".darkIcon").addClass("text-primary");
        }
    });

    function toggleTheme() {
        if ($(".themeButton").is(":checked")) {
            // dark theme
            $("body").attr('data-bs-theme', 'dark');
            $(".darkTableToggle").addClass("table-dark");

            $(".lightIcon").removeClass("text-primary");
            $(".darkIcon").addClass("text-primary");

            localStorage.setItem('theme', "dark");
        } else {
            // light theme
            $("body").attr('data-bs-theme', 'light');
            $(".darkTableToggle").removeClass("table-dark");

            $(".darkIcon").removeClass("text-primary");
            $(".lightIcon").addClass("text-primary");

            localStorage.setItem('theme', "light");
        }

    }

    document.addEventListener('DOMContentLoaded', function() {
        const c1 = new CountUp('count-up-evidencija', 0, <?= evidencijeOdUsera(); ?>);
        c1.start();

        const c2 = new CountUp('count-up-evidencija2', 0, <?= evidencijeOdUsera(true); ?>);
        c2.start();
    });
</script>

</html>