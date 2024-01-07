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

            <div class="container border py-3 w-50 my-5">

                <!-- <div class="border h-50 overflow-auto"> -->
                <!-- <form id="form" onsubmit="return false;">

                    <div class="border table-wrapper-scroll-y custom-scrollbar">
                        <table class="table table-dark table-hover">
                            <?php
                            $result = getProfesoriEvidencija();
                            $profesori = array();

                            if ($result["row_count"] > 0) {
                            ?>
                                <thead class="position-sticky" style="top: 0;">
                                    <tr>
                                        <th scope="col">Obriši</th>
                                        <th>ID</th>
                                        <th>proizvod</th>
                                        <th>ucionica</th>
                                        <th>datum</th>
                                        <th>vrijeme</th>
                                        <th>korisnik</th>
                                        <th>barkod<button style="float: right; height: 100%; background-color: transparent; border: none;" id="refresh"><ion-icon name="refresh-outline"></ion-icon></button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result["result"] as $row) { ?>

                                        <?php if (!in_array($row["username"], $profesori)) {
                                            $profesori[] = $row["username"] ?>
                                            <tr class="row-parent" data-row-parent="<?= $row["username"] ?>">
                                                <td class="fw-bold bg-success" colspan="8"><?= strtoupper($row["username"]) ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tr style="display: none;" class="row-child" data-row-child="<?= $row["username"] ?>">
                                            <th>
                                                <input class="form-check-input checkEvidencija" type="checkbox" value="<?= $row["id"] ?>">
                                            </th>
                                            <th scope="row"><?= $row["id"] ?></th>
                                            <td><?= $row["naziv"] ?></td>
                                            <td><?= $row["ucionica"] ?></td>
                                            <td><?= date_format(date_create($row["datum"]), "d.m.Y.") ?></td>
                                            <td><?= $row["vrijeme"] ?></td>
                                            <td><?= $row["username"] ?></td>
                                            <td class="barcode open-modal" data-value="<?= $row["barkod"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.png"><img style="background-color: white;" class="img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.png" alt="barcode alt"><?= $row["barkod"] ?></td>
                                        </tr>

                                <?php }
                                } else {
                                    echo "<th>Još nema zabilježenih evidencija</th>";
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                    <?php if ($result["row_count"] > 0) { ?>
                        <button class="btn btn-success fw-bold" type="submit" onclick="deleteItems()">IZBRIŠI ODABRANO</button>
                        <button class="btn btn-primary fw-bold" id="oznaci">OZNAČI SVE</button>
                        <button class="btn btn-outline-primary fw-bold" id="makni">MAKNI SVE</button>
                    <?php } ?>
                </form> -->

                <ul class="list-group list-group-flush overflow-auto" style="max-height: 50vh;">
                    <?php
                    $result = getProfesori();

                    if ($result['row_count'] > 0) {
                        foreach ($result["result"] as $row) { ?>

                            <li class="list-group-item">
                                <a href="evidencija?p=<?= $row["id"] ?>&i=<?= $zadnja_inventura ?>" class="link-secondary link-underline-opacity-0 text-white"><?= $row["ime"] . " " . $row["prezime"] . " (" . $row["username"] . ")" ?></a>
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
                    <small class="text-secondary">Popis profesora</small>
                <?php endif; ?>
            </div>
        </main>

    </div>

    <!-- bootstrap modal -->
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
            $("#oznaci").click(function() {
                $(".checkEvidencija").each(function() {
                    this.checked = true;
                })
            });

            $("#makni").click(function() {
                $(".checkEvidencija").each(function() {
                    this.checked = false;
                })
            });

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

            $(document).ready(function() {
                $('.row-parent').click(function() {
                    var profesor = $(this).data('row-parent');
                    console.log(profesor);
                    $('.row-child[data-row-child="' + profesor + '"]').toggle();
                });
            });
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- <script src="../bootstrap/js/bootstrap.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>