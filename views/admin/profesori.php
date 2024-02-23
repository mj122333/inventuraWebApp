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

<body data-bs-theme="light">
    <script defer>
        $("body").attr('data-bs-theme', initialTheme);
    </script>

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include 'views/header.php'; ?>

        <main class="d-flex flex-row h-100" style="overflow: hidden;">

            <?php include 'views/sidebar.php'; ?>

            <div class="container col-11 col-md-8" style="overflow-y: auto;">

                <div class="row my-2">
                    <?php
                    $result = getProfesori();

                    if ($result['row_count'] > 0) {
                        foreach ($result["result"] as $row) { ?>

                            <div class="card border-0 shadow-sm col-3 pt-2 mx-3 mb-5">
                                <div class="rounded" style="display: flex; align-items: center; justify-content: center; overflow: hidden; height: 128px;">
                                    <img src="<?php echo DS . APPFOLDER . DS ?>images/proizvod_422.jpg" class="card-img-top" alt="">
                                </div>
                                <div class="card-body p-0">
                                    <h5 class="card-title"><?= $row["ime"] . " " . $row["prezime"] . " (" . $row["username"] . ")" ?></h5>
                                    <p class="card-text fw-bold <?php echo $row["role"] == "admin" ? "text-danger" : "text-success" ?>"><?= $row["role"] ?></p>
                                    <a href="evidencija?p=<?= $row["id"] ?>&i=<?= $zadnja_inventura ?>" class="link-secondary link-underline-secondary link-underline-opacity-0 link-underline-opacity-75-hover">Evidencija od korisnika</a>
                                </div>
                            </div>

                    <?php }
                    }
                    ?>
                </div>

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