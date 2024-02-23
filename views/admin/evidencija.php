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
        /* height: 30rem; */
        height: 24rem;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .barcode {
        /* height: 50px; */
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
                <?php if (!empty($i)) { ?>
                    <h5>Rezultati za inventuru <i>#<?= $i ?></i></h5>
                <?php } else { ?>
                    <h5>Rezultati za inventuru <i>#<?= $zadnja_inventura ?></i></h5>
                <?php } ?>
                <div class="bg-main rounded border p-3">

                    <form id="filter-form" class="row" action="" method="get">

                        <div class="col-12 col-sm-6 col-md-3 d-block d-sm-inline">
                            <div class="input-group mb-3 col-12">
                                <span class="input-group-text">#</span>
                                <?php $inventura_range = inventuraIdRange(); ?>
                                <input id="i-input" class="form-control" name="i" value="<?php echo !empty($i) ? $i : $zadnja_inventura ?>" type="number" min=<?= $inventura_range["min_id"] ?> max=<?= $inventura_range["max_id"] ?>>
                                <span data-tooltip="Prikaži zadnju inventuru" role="button" onclick="updateInventura()" class="input-group-text"><i class="bi bi-calendar4-event"></i></span>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-md-3 d-block d-sm-inline">
                            <div class="input-group mb-3 col-6">
                                <label class="input-group-text">Učionica</label>
                                <select id="u-input" name="u" class="form-select">
                                    <option value>Odaberi učionicu</option>
                                    <?php
                                    $ucionice = getUcionice();
                                    foreach ($ucionice["result"] as $row) {
                                    ?>
                                        <option value="<?= $row["oznaka"] ?>" <?php echo $u == $row["oznaka"] ? "selected" : "" ?>><?= $row["oznaka"] ?></option>
                                    <?php } ?>
                                </select>
                                <span data-tooltip="Izbriši" data-target="u-input" role="button" onclick="clearSearch(this)" class="input-group-text"><i class="bi bi-trash3"></i></span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3 d-block d-sm-inline">
                            <div class="input-group mb-3 col-6">
                                <label class="input-group-text">Profesor</label>
                                <select id="p-input" name="p" class="form-select">
                                    <option value>Odaberi profesora</option>
                                    <?php
                                    $ucionice = getProfesori();
                                    foreach ($ucionice["result"] as $row) {
                                    ?>
                                        <option value="<?= $row["id"] ?>" <?php echo $p == $row["id"] ? "selected" : "" ?>><?= $row["ime"] . " " . $row["prezime"] ?></option>
                                    <?php } ?>
                                </select>
                                <span data-tooltip="Izbriši" data-target="p-input" role="button" onclick="clearSearch(this)" class="input-group-text"><i class="bi bi-trash3"></i></span>
                            </div>
                        </div>

                        <div class="d-block col-12 col-sm-6 col-md-3">
                            <div class="input-group mb-3">
                                <span data-tooltip="Izbriši" data-target="s-input" role="button" onclick="clearSearch(this)" class="input-group-text"><i class="bi bi-trash3"></i></span>
                                <input id="s-input" name="search" type="text" class="form-control" value="<?= !empty($search) ? $search : "" ?>" placeholder="Pretraživanje">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                            </div>
                        </div>

                        <div class="d-block"><button type="submit" class="btn btn-sm btn-primary col-12 col-md-2">Primijeni</button></div>
                    </form>

                    <hr>

                    <form id="form" onsubmit="return false;">

                        <?php $result = getEvidencija(); ?>
                        <h2><?= $result["row_count"] ?> rezultat/a</h2>
                        <div class="table-wrapper-scroll-y custom-scrollbar">
                            <!-- <table class="table table-dark table-hover"> -->

                            <table class="darkTableToggle table table-hover table-borderless" style="font-size: 12px;">
                                <?php
                                if ($result["row_count"] > 0) {
                                ?>
                                    <thead class="position-sticky" style="top: 0;">
                                        <tr>
                                            <th class="text-gray" scope="col">Obriši</th>
                                            <th class="text-gray">ID</th>
                                            <th class="text-gray">Proizvod</th>
                                            <th class="text-gray">Učionica</th>
                                            <th class="text-gray">Datum</th>
                                            <th class="text-gray d-sm-table-cell d-none">Vrijeme</th>
                                            <th class="text-gray d-sm-table-cell d-none">Korisnik</th>
                                            <!-- <th>Barkod<button style="float: right; height: 100%; background-color: transparent; border: none;" id="refresh"><ion-icon name="refresh-outline"></ion-icon></button></th> -->
                                            <th class="text-gray">Barkod</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result["result"] as $row) { ?>
                                            <tr>
                                                <td>
                                                    <input class="form-check-input checkEvidencija" type="checkbox" value="<?= $row["id"] ?>">
                                                </td>
                                                <th scope="row"><?= $row["proizvod_id"] ?></th>
                                                <td><?= $row["naziv"] ?></td>
                                                <td><?= $row["ucionica"] ?></td>
                                                <td><?= date_format(date_create($row["datum"]), "d.m.Y.") ?></td>
                                                <td class="d-sm-table-cell d-none"><?= $row["vrijeme"] ?></td>
                                                <td class="d-sm-table-cell d-none"><?= $row["username"] == $_SESSION["username"] ? $row["username"] . " (Vi)" : $row["username"] ?></td>
                                                <td class="font-monospace barcode open-modal" data-value="<?= $row["barkod"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg"><img style="background-color: white;" class="img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg" alt="barcode alt"><?= $row["barkod"] ?></td>
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
                            <button class="btn btn-sm btn-success fw-bold" onclick="deleteItems()">Izbriši odabrano <i class="bi bi-trash3"></i></button>
                            <button data-tooltip="Označi sve" class="btn btn-sm btn-primary fw-bold" id="oznaci"><i class="bi bi-check-square"></i></button>
                            <button data-tooltip="Makni sve" class="btn btn-sm btn-outline-primary fw-bold" id="makni"><i class="bi bi-x-square"></i></button>
                        <?php } ?>
                    </form>

                </div>
            </div>
        </main>

    </div>

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
        // tooltip aktivacija za bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function clearSearch(el) {
            var element = $(el);
            console.log('#' + element.data('target'))
            $('#' + element.data('target')).val('');
            $('#filter-form').submit();
        }

        function updateInventura() {
            $('#i-input').val(<?php echo $zadnja_inventura ?>);
            $('#filter-form').submit();
        }

        $(document).ready(function() {
            $("#oznaci").click(function() {
                $(".checkEvidencija").each(function() {
                    this.checked = true;
                })
            });

            $('[data-tooltip]').each(function() {
                $(this).tooltip({
                    placement: 'top',
                    title: $(this).data('tooltip')
                });
            });

            $("#i-input").change(function() {
                var inventura_id = $(this).val();
                $('#filter-form').submit();
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

            $("#filter-form").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serializeArray();

                formData = formData.filter(function(item) {
                    return item.value.trim() !== '';
                });

                var url = '?' + $.param(formData);

                window.location.href = url;
            });

        });
    </script>

</body>

</html>