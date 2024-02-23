<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Admin</title>
    <script src="/<?php echo APPFOLDER ?>/js/delete_items.js"></script>
    <script src="/<?php echo APPFOLDER ?>/js/get_cookie.js"></script>
</head>

<style>
    body {
        height: 100vh;
    }

    .custom-scrollbar {
        position: relative;
        height: 18rem;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .barcode {
        height: 38px;
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

<body data-bs-theme="light">
    <script defer>
        $("body").attr('data-bs-theme', initialTheme);
    </script>

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include 'views/header.php'; ?>

        <main class="d-flex flex-row h-100">

            <?php include 'views/sidebar.php'; ?>

            <div class="container-fluid mx-0 py-2 h-100 bg-tertiary" style="font-size: 10px">

                <div class="bg-main border rounded p-3">
                    <form id="proizvod-form" class="row" action="" method="post" enctype="multipart/form-data">
                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text">Naziv</span>
                                <input class="form-control" name="naziv" type="text" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text">Opis</span>
                                <input class="form-control" name="opis" type="text" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text">Tip</label>
                                <select name="tip" class="form-select" required>
                                    <option value>Odaberi tip proizvoda</option>
                                    <?php
                                    $tipovi = getTipovi();
                                    foreach ($tipovi["result"] as $row) {
                                    ?>
                                        <option value="<?= $row["tip_id"] ?>"><?= $row["tip"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text">Količina</span>
                                <input class="form-control" name="kolicina" type="number" min="1" value="1" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text">Vrijednost</span>
                                <input class="form-control" name="vrij" type="number" min="0.05" value="1" step="0.05" required>
                                <span class="input-group-text">€</span>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text">Koeficijent</span>
                                <input class="form-control" name="koef" type="number" min="0.00" value="1" step="0.05" required>
                                <span role="button" class="input-group-text" data-tooltip="Vrijednost se kod obračuna smanjuje za umnožak koef. i poč. vrij."><i class="bi bi-info-circle"></i></span>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text">Učionica</label>
                                <select name="ucionica" class="form-select" required>
                                    <option value>Odaberi učionicu</option>
                                    <?php
                                    $ucionice = getUcionice();
                                    foreach ($ucionice["result"] as $row) {
                                    ?>
                                        <option value="<?= $row["id"] ?>"><?= $row["oznaka"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-block col-12 col-md-6">
                            <div class="input-group input-group-sm mb-3 col-12">
                                <label class="input-group-text" for="inputGroupFile01">Slika</label>
                                <input required type="file" name="slika" accept="image/png, image/jpeg" class="form-control" id="inputGroupFile01">
                            </div>
                        </div>

                        <div class="d-block col-12">
                            <button type="submit" value="true" name="dodaj_proizvod" class="btn btn-primary col-12 col-md-2">Dodaj <i class="bi bi-database-add"></i></button>
                        </div>
                    </form>

                    <hr>

                    <form id="form" onsubmit="return false;">

                        <?php $result = getProizvodi(); ?>
                        <h2>
                            <?= $result["row_count"] ?> proizvoda <button onclick="toggleForm()" id="toggleFormButton" class="col-4 col-md-2 btn btn-sm btn-outline-primary">Sakrij formu <i class="bi bi-caret-up-fill"></i></button>
                        </h2>


                        <div class="table-wrapper-scroll-y custom-scrollbar">
                            <table class="darkTableToggle table table-hover table-borderless" style="font-size: 12px;">
                                <?php
                                if ($result["row_count"] > 0) {
                                ?>
                                    <thead class="position-sticky" style="top: 0;">
                                        <tr>
                                            <!-- <th scope="col">Obriši</th> -->
                                            <th class="d-none d-md-table-cell">ID</th>
                                            <th>Slika</th>
                                            <th>Naziv</th>
                                            <th class="d-none d-md-table-cell">Opis</th>
                                            <th class="d-none d-md-table-cell">Tip</th>
                                            <!-- <th>Količina</th> -->
                                            <th class="d-none d-md-table-cell">Poč. vrij.</th>
                                            <th class="d-none d-md-table-cell">Vrij. knjigov.</th>
                                            <th>Barkod</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result["result"] as $row) { ?>
                                            <tr class="bg-success">
                                                <!-- <th>
                                                <input class="form-check-input checkEvidencija" type="checkbox" value="<?= $row["id"] ?>">
                                            </th> -->
                                                <th class="d-none d-md-table-cell" scope="row"><?= $row["id"] ?></th>
                                                <?php if (!empty($row["slika"]) && file_exists("images/" . $row["slika"])) : ?>
                                                    <td class="open-modal" data-value="<?= $row["naziv"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>images/<?= $row["slika"] ?>">
                                                        <img class="barcode img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>images/<?= $row["slika"] ?>" alt="Nema slike">
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <img class="barcode img-thumbnail img-fluid" alt="Nema slike">
                                                    </td>
                                                <?php endif; ?>
                                                <!-- <td><a href="evidencija?i=<?= $zadnja_inventura ?>&search=<?= $row["naziv"] ?>" class="link-secondary link-underline-opacity-0 text-white"><?= $row["naziv"] ?></a></td> -->
                                                <td class="link-underline-opacity-0"><?= $row["naziv"] ?></td>
                                                <td class="d-none d-md-table-cell"><?= $row["opis"] ?></td>
                                                <td class="d-none d-md-table-cell"><span class="bg-tertiary p-1 rounded"><?= $row["tip"] ?></span></td>
                                                <!-- <td><?= $row["kolicina"] ?></td> -->
                                                <td class="d-none d-md-table-cell"><?= $row["pocetna_vrij"] ?></td>
                                                <td class="d-none d-md-table-cell"><?= $row["vrij_knjig"] ?></td>
                                                <td class="font-monospace barcode open-modal" data-value="<?= $row["barkod"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg"><img style="background-color: white;" class="img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg" alt="barcode alt"><?= $row["barkod"] ?></td>


                                            </tr>

                                    <?php }
                                    } else {
                                        echo "<th>Nema proizvoda</th>";
                                    }
                                    ?>
                                    </tbody>
                            </table>
                        </div>
                        <button data-tooltip="Oprez, ova radnja se nemože poništiti" onclick="obracunVrij()" class="mt-3 btn btn-primary">Obračun vrijednosti <i class="bi bi-calculator"></i></button>
                        <!-- <a id="generate" href="<?php echo DS . APPFOLDER . DS ?>importdb?action=generate_barcodes" class="mt-3 btn btn-outline-primary">Generiraj barkodove <i class="bi bi-upc"></i></a> -->
                    </form>
                </div>

            </div>
        </main>

    </div>

    <div class="modal fade" id="barcode-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <img style="background-color: white;" id="modal-image" class="img-thumbnail img-fluid" alt="barcode alt">
                <p id="modal-text" class="font-monospace text-center display-5"></p>
            </div>
        </div>
    </div>

    <script>
        function obracunVrij() {
            const sessionCookie = getCookie("sessionid");
            const requestOptions = {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Cookie: "sessionid=" + sessionCookie,
                },
            };

            var url = "/<?php echo APPFOLDER ?>/api/obracun";
            fetch(url, requestOptions)
                .then((response) => response.text())
                .then((data) => {
                    location.reload();

                    // console.log(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });

        }

        function toggleForm() {
            if ($('#proizvod-form').css('display') != 'none') {
                $('.custom-scrollbar').css("height", "65vh");
                $("#toggleFormButton").text('Otkrij formu ');
                $("#toggleFormButton").append('<i class="bi bi-caret-down-fill"></i>');
            } else {
                $('.custom-scrollbar').css("height", "18rem");
                $("#toggleFormButton").text('Sakrij formu ');
                $("#toggleFormButton").append('<i class="bi bi-caret-up-fill"></i>');
            }
            $('#proizvod-form').slideToggle('fast');
        }

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

            $('[data-tooltip]').each(function() {
                $(this).tooltip({
                    placement: 'top',
                    title: $(this).data('tooltip')
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


</body>

</html>