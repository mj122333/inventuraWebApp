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

            <div class="container-fluid mx-0 py-2 h-100" style="font-size: 10px">

                <form id="form" onsubmit="return false;">

                    <?php $result = getStanje(); ?>
                    <h2><?= $result["row_count"] ?> rezultat/a</h2>
                    <div class="border table-wrapper-scroll-y custom-scrollbar">

                        <table class="table table-dark table-hover" style="font-size: 14px;">
                            <?php
                            if ($result["row_count"] > 0) {
                            ?>
                                <thead class="position-sticky" style="top: 0;">
                                    <tr>
                                        <!-- <th scope="col">Obriši</th> -->
                                        <th>ID</th>
                                        <th>Učionica</th>
                                        <th>Proizvod</th>
                                        <th>Količina</th>
                                        <th>Barkod</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result["result"] as $row) { ?>
                                        <tr>
                                            <th scope="row"><?= $row["proizvod_id"] ?></th>
                                            <td><?= $row["ucionica"] ?></td>
                                            <td><?= $row["naziv"] ?></td>
                                            <td><?= $row["kolicina"] ?></td>
                                            <td class="font-monospace barcode open-modal" data-value="<?= $row["barkod"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg"><img style="background-color: white;" class="img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg" alt="barcode alt"><?= $row["barkod"] ?></td>
                                        </tr>

                                <?php }
                                } else {
                                    echo "<th>Još nema zabilježenih stanja</th>";
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                </form>

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

        function prihvatiPromjenu(el, proizvodId, staraUcionica, novaUcionica) { // proizvodId, ..., ..., kolicina
            console.log(proizvodId + ": " + staraUcionica + " -> " + novaUcionica);
            promjenaStanja(proizvodId, staraUcionica, novaUcionica);

            var element = $(el);
            var td = element.parent();
            element.toggle();
            // td.text("PRIHVAĆENO");
            td.removeClass("text-warning").addClass("text-success");
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