<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>

    <title>Admin</title>
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
</style>

<!-- <body data-bs-theme="dark" class="d-flex justify-content-center align-items-center flex-column"> -->

<body data-bs-theme="dark">

    <!-- <?php print_r($_SESSION); ?> -->

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include "views/header.php"; ?>


        <main class="d-flex flex-row" style="flex: 1;">
            <?php include "views/sidebar.php"; ?>

            <div class="h-100 w-100">

                <div class="row h-25 my-5 m-0 p-0">
                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/evidencija?i=<?= $zadnja_inventura ?>" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">EVIDENCIJA</p>
                        <!-- <ion-icon class="ikona" name="checkmark-circle-outline"></ion-icon> -->
                        <i class="ikona bi bi-check-circle"></i>
                    </a>

                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/ucionice" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">UČIONICE</p>
                        <!-- <ion-icon class="ikona" name="book-outline"></ion-icon> -->
                        <i class="ikona bi bi-book"></i>
                    </a>

                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/profesori" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">PROFESORI</p>
                        <!-- <ion-icon class="ikona" name="people-outline"></ion-icon> -->
                        <i class="ikona bi bi-people"></i>
                    </a>
                </div>

                <div class="row h-25 my-5 m-0 p-0">
                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/proizvodi" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">PROIZVODI</p>
                        <!-- <ion-icon class="ikona" name="pricetags-outline"></ion-icon> -->
                        <!-- <ion-icon class="ikona" name="documents-outline"></ion-icon> -->
                        <!-- <i class="ikona bi bi-files"></i> -->
                        <i class="ikona bi bi-box-seam"></i>
                    </a>

                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/usporedba" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">USPOREDBA</p>
                        <i class="ikona bi bi-arrow-left-right"></i>
                    </a>

                    <a href="<?php echo DS . APPFOLDER . DS ?>scan" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">SKEN</p>
                        <i class="ikona bi bi-upc-scan"></i>
                    </a>
                </div>

                <div>
                    <form action="" method="post" class="container col-6 col-3-sm rounded h-100">
                        <?php if ($inventura_aktivna) { ?>
                            <button type="submit" name="pokreni_inventuru" value="true" class="btn btn-warning container-fluid">
                                <div>
                                    <span>ZAUSTAVI INVENTURU</span>
                                    <div id="counter"></div>
                                </div>
                            </button>
                        <?php } else { ?>
                            <button type="submit" name="pokreni_inventuru" value="true" class="btn btn-primary container-fluid">
                                <div>
                                    <span>ZAPOČNI INVENTURU</span>
                                </div>
                            </button>
                        <?php } ?>
                    </form>

                </div>
            </div>

    </div>

    </main>
    </div>
</body>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script>
    const startTimeStamp = new Date('<?php echo date('Y-m-d\TH:i:s', strtotime($pocetak_inventure)); ?>').getTime();

    function updateCounter() {
        const currentTimeStamp = new Date().getTime();
        const elapsedTimeInSeconds = Math.floor((currentTimeStamp - startTimeStamp) / 1000);

        const days = Math.floor(elapsedTimeInSeconds / 86400);
        const hours = Math.floor((elapsedTimeInSeconds % 86400) / 3600);
        const minutes = Math.floor((elapsedTimeInSeconds % 3600) / 60);
        const seconds = elapsedTimeInSeconds % 60;

        const formattedTime = `${formatTime(days)} : ${formatTime(hours)} : ${formatTime(minutes)} : ${formatTime(seconds)}`;
        document.getElementById('counter').textContent = formattedTime;
    }

    function formatTime(value) {
        return value < 10 ? `0${value}` : value;
    }

    setInterval(updateCounter, 1000);

    // Initial update
    updateCounter();
</script>

</html>