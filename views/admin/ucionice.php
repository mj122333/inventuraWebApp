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

            <div class="container row mx-auto">
                <div class="container border rounded py-3 col-md-11 col-lg-5 my-5">


                    <form method="POST" action="">
                        <?php if (get("action") == "edit") : ?>

                            <label for="opis" class="form-label">Uredi učionicu</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><span class="d-none d-sm-flex">Oznaka</span></span>
                                <input required type="text" class="form-control" name="oznaka" placeholder="oznaka" value="<?= $_GET["oznaka"] ?>">

                                <span class="d-none d-sm-flex input-group-text">Opis</span>
                                <input required type="text" class="form-control" name="opis" placeholder="opis učionice" value="<?= $_GET["opis"] ?>">
                                <button class="btn btn-success" type="submit" name="uredi_ucionicu">Uredi</button>
                            </div>
                            <input hidden type="text" class="form-control" name="id" value="<?= $_GET["id"] ?>">
                            <a href="ucionice" class="btn btn-warning">Dodavanje učionice</a>

                        <?php else : ?>

                            <label for="opis" class="form-label">Dodaj učionicu</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><span class="d-none d-sm-flex">Oznaka</span></span>
                                <input required type="text" class="form-control" name="oznaka" placeholder="oznaka">

                                <span class="d-none d-sm-flex input-group-text">Opis</span>
                                <input required type="text" class="form-control" name="opis" placeholder="opis učionice">
                                <button class="btn btn-success" type="submit" name="dodaj_ucionicu">Dodaj</button>
                            </div>

                        <?php endif; ?>

                    </form>

                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 50vh;">
                        <?php
                        $result = getUcionice();

                        if ($result['row_count'] > 0) {
                            foreach ($result["result"] as $row) { ?>

                                <li class="list-group-item">
                                    <div class="float-start">
                                        <a href="evidencija?u=<?= $row["oznaka"] ?>&i=<?= $zadnja_inventura ?>" class="link-secondary link-underline-opacity-0 text-white"><?= $row["oznaka"] ?>&nbsp;-&nbsp;<?= $row["opis"] ?></a>
                                        <a href="ucionice?action=edit&oznaka=<?= $row["oznaka"] ?>&id=<?= $row["id"] ?>&opis=<?= $row["opis"] ?>"><i class="bi bi-pen"></i></a>
                                    </div>

                                    <div style="cursor: pointer;" class="float-end d-flex flex-column open-modal" data-value="<?= $row["barkod"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg">
                                        <img style="background-color: white; height: 26px;" class="img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg" alt="barcode alt">
                                        <span class="font-monospace"><?= $row["barkod"] ?></span>
                                    </div>

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


                </div>

                <div class="container border rounded py-3 col-md-11 col-lg-5 my-5">


                    <form method="POST" action="">

                        <label class="form-label">Dodaj tip proizvoda</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><span class="d-none d-sm-flex">Tip</span></span>
                            <input required type="text" class="form-control" name="tip_naziv" placeholder="tip">

                            <button class="btn btn-success" type="submit" name="dodaj_tip">Dodaj</button>
                        </div>


                    </form>

                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 50vh;">
                        <?php
                        $result = getTipovi();

                        if ($result['row_count'] > 0) {
                            foreach ($result["result"] as $row) { ?>

                                <li class="list-group-item">
                                    <div class="float-start">
                                        <span><?= $row["tip"] ?></span>
                                    </div>
                                </li>

                        <?php }
                        }
                        ?>
                    </ul>
                    <?php if ($result['row_count'] == 0) : ?>
                        <small class="text-secondary">Lista je prazna</small>
                    <?php else : ?>
                        <small class="text-secondary">Popis tipova proizvoda</small>
                    <?php endif; ?>


                </div>
            </div>
        </main>
    </div>

    <!-- <span id="dodajTip" class="btn btn-sm btn-success col-12 col-md-2">Dodaj tip proizvoda <i class="bi bi-box-arrow-up-right"></i></span> -->


    <!-- bootstrap modal -->
    <div class="modal fade" id="barcode-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <img style="background-color: white;" id="modal-image" class="img-thumbnail img-fluid" alt="barcode alt">
                <p id="modal-text" class="text-center display-5 font-monospace"></p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.open-modal').click(function() {
                var imageSrc = $(this).data('image');
                var codeValue = $(this).data('value')
                $('#modal-image').attr('src', imageSrc);
                $('#modal-text').text(codeValue);
                $('#barcode-modal').modal('show');
            });
        });
    </script>

</body>

</html>