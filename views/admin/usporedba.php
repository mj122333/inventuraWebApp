<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Admin</title>
    <script src="/<?php echo APPFOLDER ?>/js/promjene.js"></script>
</head>

<style>
    body {
        height: 100vh;
    }

    .custom-scrollbar {
        position: relative;
        /* height: 30rem; */
        height: 30rem;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .barcode {
        /* height: 50px; */
        height: 42px;
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

            <!-- TODO omoguciti prikaz samo ako je inventura zavrsila -->

            <div class="container-fluid mx-0 py-2 h-100" style="font-size: 10px">

                <form id="form" onsubmit="return false;">

                    <?php $result = getPromjene(32, 31); ?>
                    <?php if (checkInventura()) : ?>
                        <h1>Inventura <i>#<?= $zadnja_inventura ?></i> još traje</h1>
                    <?php else : ?>
                        <h1>Inventura <i>#<?= $zadnja_inventura ?></i> je završila</h1>
                    <?php endif; ?>
                    <h2><?= $result["row_count"] ?> rezultat/a</h2>
                    <div class="border table-wrapper-scroll-y custom-scrollbar">
                        <!-- <table class="table table-dark table-hover"> -->

                        <table class="table table-dark table-hover" style="font-size: 14px;">
                            <?php
                            if ($result["row_count"] > 0) {
                            ?>
                                <thead class="position-sticky" style="top: 0;">
                                    <tr>
                                        <!-- <th scope="col">Obriši</th> -->
                                        <th>ID</th>
                                        <th>Proizvod</th>
                                        <th>Učionica</th>
                                        <!-- <th>Datum</th> -->
                                        <!-- <th class="d-sm-table-cell d-none">Vrijeme</th> -->
                                        <!-- <th class="d-sm-table-cell d-none">Korisnik</th> -->
                                        <th>Barkod</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result["result"] as $row) { ?>
                                        <tr>
                                            <!-- <th>
                                                <input class="form-check-input checkEvidencija" type="checkbox" value="<?= $row["id"] ?>">
                                            </th> -->
                                            <th scope="row"><?= $row["proizvod_id"] ?></th>

                                            <td class="<?php
                                                        if ($row["promjena"] == "novo") {
                                                            echo "text-success fw-bold";
                                                        } elseif ($row["promjena"] == "nestalo") {
                                                            echo "text-danger fw-bold";
                                                        } else {
                                                            echo "";
                                                        }
                                                        ?>"><?= $row["naziv"] ?></td>

                                            <td class="<?php echo $row["promjena"] == "ucionica" ? "text-warning fw-bold" : "" ?>">
                                                <?= $row["ucionica"] ?>
                                                <?php if ($row["promjena"] == "ucionica") : ?>
                                                    <button data-color="bg-success" data-message="Prihvaćeno" onclick="prihvatiPromjenu(this, <?= $row['proizvod_id'] ?>, <?= $row['ucionica_stara'] ?>, <?= $row['ucionica_nova'] ?>)" class="toastButton btn btn-sm btn-success">Prihvati <i class="bi bi-check-lg"></i></button>
                                                <?php elseif ($row["promjena"] == "nestalo") : ?>
                                                    <button data-color="bg-danger" data-message="Otpisano" onclick="otpisiPromjenu(this, '<?= $row['naziv'] ?>')" class="toastButton btn btn-sm btn-danger">Otpiši <i class="bi bi-x-lg"></i></button>
                                                <?php endif; ?>
                                            </td>

                                            <!-- <td><?= date_format(date_create($row["datum"]), "d.m.Y.") ?></td> -->
                                            <!-- <td class="d-sm-table-cell d-none"><?= $row["vrijeme"] ?></td> -->
                                            <!-- <td class="d-sm-table-cell d-none"><?= $row["username"] == $_SESSION["username"] ? $row["username"] . " (Vi)" : $row["username"] ?></td> -->
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
                </form>

            </div>
        </main>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast toast-template align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>



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

        function prihvatiPromjenu(el, proizvodId, staraUcionica, novaUcionica) { // proizvodId, ..., ..., kolicina
            console.log(proizvodId + ": " + staraUcionica + " -> " + novaUcionica);
            promjenaStanja(proizvodId, staraUcionica, novaUcionica);

            var button = $(el);
            var td = button.parent();
            button.toggle();
            td.removeClass("text-warning").addClass("text-success");
        }

        function otpisiPromjenu(el, naziv) {
            console.log('otpisano ->', naziv);

            var button = $(el);
            var td = button.parent();
            button.toggle();
            td.addClass("text-danger fw-bold");
        }

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

        function showToast(message, colorClass) {
            var toastContainer = $('.toast-container');
            var toast = toastContainer.find('.toast-template').clone();
            toast.removeClass("toast-template");

            toast.find('.toast-body').text(message);

            // toast.removeClass('bg-primary bg-success');
            toast.addClass(colorClass);

            toastContainer.append(toast);

            toast.toast({
                delay: 2000
            }).toast('show');
        }

        $(document).ready(function() {

            $('.toastButton').click(function() {
                var message = $(this).data('message');
                var color = $(this).data('color');
                showToast(message, color);
            });

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
            })

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