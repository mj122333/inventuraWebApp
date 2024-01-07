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
</style>

<!-- <body data-bs-theme="dark" class="d-flex justify-content-center align-items-center flex-column"> -->

<body data-bs-theme="dark">

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include "views/header.php"; ?>

        <main class="d-flex flex-row" style="flex: 1;">
            <?php include 'views/sidebar.php'; ?>

            <div class="container border py-3 col-11 col-md-6 my-5">

                <form method="POST" action="">
                    <label for="opis" class="form-label">Dodaj učionicu</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><span class="d-none d-sm-flex">Oznaka</span></span>
                        <input type="text" class="form-control" name="oznaka" placeholder="oznaka">

                        <span class="d-none d-sm-flex input-group-text">Opis</span>
                        <input type="text" class="form-control" name="opis" placeholder="opis učionice">
                        <button class="btn btn-success" type="submit" name="dodaj_ucionicu">Dodaj</button>
                    </div>
                </form>

                <?php if ($action == "edit") : ?>

                    <!-- TODO edit ucionice -->

                <?php else : ?>
                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 50vh;">
                        <?php
                        $result = getUcionice();

                        if ($result['row_count'] > 0) {
                            foreach ($result["result"] as $row) { ?>

                                <li class="list-group-item">
                                    <a href="evidencija?u=<?= $row["oznaka"] ?>&i=<?= $zadnja_inventura ?>" class="link-secondary link-underline-opacity-0 text-white"><?= $row["oznaka"] ?>&nbsp;-&nbsp;<?= $row["opis"] ?></a>
                                    <img style="background-color: white;" class="img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg" alt="barcode alt">
                                    <!-- <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch">
                                </div> -->
                                </li>

                        <?php }
                        }
                        ?>
                    </ul>
                    <?php if ($result['row_count'] == 0) : ?>
                        <small class="text-secondary">Lista je prazna</small>
                    <?php else : ?>
                        <small class="text-secondary">Popis učionica</small>
                    <?php endif; ?>
                <?php endif; ?>



            </div>
        </main>
    </div>
</body>

</html>