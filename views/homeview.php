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


<body data-bs-theme="dark">

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include "header.php"; ?>

        <main class="d-flex flex-row" style="flex: 1;">
            <?php include 'sidebar.php'; ?>

            <div id="pozadina" class="h-100 w-100">

                <?php if (true) : ?>
                    <!-- <img src="<?php echo DS . APPFOLDER . DS ?>favicon/logo_light_orange.svg" alt="Logo SVG" class="mx-auto" /> -->
                <?php endif; ?>

                <div class="row h-25 my-5 m-0 p-0">
                    <a href="<?php echo DS . APPFOLDER . DS ?>scan" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-6 col-lg-3">
                        <p class="d-block">SKEN</p>
                        <i class="ikona bi bi-upc-scan"></i>
                    </a>
                </div>

                <!-- <img src="<?php echo DS . APPFOLDER . DS ?>favicon/logo_light_orange.svg" alt="Logo SVG" class="img-fluid" /> -->

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