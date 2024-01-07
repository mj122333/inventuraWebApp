<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Admin</title>
    <script src="/<?php echo APPFOLDER ?>/js/delete_items.js"></script>
</head>

<style>
    body {
        height: 100vh;
    }

    .custom-scrollbar {
        position: relative;
        height: 30rem;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .barcode {
        height: 50px;
        overflow: hidden;
    }

    .barcode:hover {
        cursor: pointer;
    }

    .barcode img {
        height: 100%;
        width: auto;
        display: block;
    }
</style>

<body data-bs-theme="dark">

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include 'views/header.php'; ?>

        <main class="d-flex flex-row h-100">

            <?php include 'views/sidebar.php'; ?>

            <div class="container-fluid row p-5 mx-0 h-100">
                <!-- <form action="" method="get">
                    <div class="form-check">
                        <input name="inventura_id" class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                            Prikaži samo zadnju inventuru
                        </label>
                        <button type="submit" class="btn btn-primary">Primijeni</button>
                    </div>
                </form> -->

                <form id="form" onsubmit="return false;">

                    <?php $result = getProizvodi(); ?>
                    <h2><?= $result["row_count"] ?> proizvoda</h2>

                    <div class="border table-wrapper-scroll-y custom-scrollbar">
                        <table class="table table-dark table-hover">
                            <?php
                            if ($result["row_count"] > 0) {
                            ?>
                                <thead class="position-sticky" style="top: 0;">
                                    <tr>
                                        <!-- <th scope="col">Obriši</th> -->
                                        <th class="d-none d-md-table-cell">ID</th>
                                        <th>Naziv</th>
                                        <th class="d-none d-md-table-cell">Opis</th>
                                        <th class="d-none d-md-table-cell">Tip</th>
                                        <th>Barkod<button style="float: right; height: 100%; background-color: transparent; border: none;" id="refresh"><ion-icon name="refresh-outline"></ion-icon></button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result["result"] as $row) { ?>
                                        <tr class="bg-success">
                                            <!-- <th>
                                                <input class="form-check-input checkEvidencija" type="checkbox" value="<?= $row["id"] ?>">
                                            </th> -->
                                            <th class="d-none d-md-table-cell" scope="row"><?= $row["id"] ?></th>
                                            <td><a href="evidencija?i=<?= $zadnja_inventura ?>&search=<?= $row["naziv"] ?>" class="link-secondary link-underline-opacity-0 text-white"><?= $row["naziv"] ?></a></td>
                                            <td class="d-none d-md-table-cell"><?= $row["opis"] ?></td>
                                            <td class="d-none d-md-table-cell"><?= $row["tip"] ?></td>
                                            <td class="barcode open-modal" data-value="<?= $row["barkod"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg"><img style="background-color: white;" class="img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg" alt="barcode alt"><?= $row["barkod"] ?></td>
                                        </tr>

                                <?php }
                                } else {
                                    echo "<th>Nema proizvoda</th>";
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                </form>

            </div>
        </main>

    </div>

    <div class="modal fade" id="barcode-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <img style="background-color: white;" id="modal-image" class="img-thumbnail img-fluid" alt="barcode alt">
                <p id="modal-text" class="text-center display-5"></p>
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

            $('#refresh').click(() => {
                location.reload();
            });
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


</body>

</html>