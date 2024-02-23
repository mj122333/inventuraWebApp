<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
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

    .ikona-parent {
        position: relative;
        overflow: hidden;
    }

    .ikona-parent:hover .ikona {
        /* font-size: 14em; */
        font-size: 10em;
        right: -35px;
        top: -20px;
    }

    .ikona {
        /* font-size: 12em; */
        font-size: 8em;
        color: #495057;
        position: absolute;
        right: -50px;
        top: -10px;
        transition: .5s;
    }

    #pozadina {
        position: ab;
        /* Make sure the position is set to relative */
        background: url('../favicon/logo_light_orange.svg') center;
    }
</style>


<body data-bs-theme="light">
    <script defer>
        $("body").attr('data-bs-theme', initialTheme);
    </script>

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include "header.php"; ?>

        <main class="d-flex flex-row" style="flex: 1;">
            <?php include 'sidebar.php'; ?>

            <div class="w-100 bg-tertiary p-3">
                <div class="row gy-3 d-flex justify-content-center">

                    <a style="height: fit-content;" class="col-12 col-md-3 link-underline link-underline-opacity-0" href="<?php echo DS . APPFOLDER . DS ?>scan">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-upc-scan"></i></h5>
                                <p class="card-text fw-semibold">Sken</p>
                                <h1 id="count-up-proizvodi" class="fw-bold"></h1>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </main>

        <?php if (isset($_SESSION['login_message'])) : ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex alert alert-warning p-0">
                        <div class="toast-body fw-bold">
                            <?php echo $_SESSION['login_message']; ?><b><?php echo $_SESSION["username"]; ?></b>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <!-- <?php unset($_SESSION['login_message']); ?> -->
        <?php endif; ?>

    </div>

    <script>
        const toastLiveExample = document.getElementById('liveToast')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastBootstrap.show();
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>