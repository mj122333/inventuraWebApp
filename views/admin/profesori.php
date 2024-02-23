<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Admin</title>
    <script src="/<?php echo APPFOLDER ?>/js/get_cookie.js"></script>
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

            <div class="p-3 bg-tertiary w-100" style="overflow-y: auto;">

                <div class="row gy-3">

                    <?php
                    $result = getProfesori();

                    if ($result['row_count'] > 0) {
                        foreach ($result["result"] as $row) { ?>

                            <div style="height: fit-content;" class="col-6 col-md-3">
                                <div class="card border">
                                    <a class="card-body link-underline link-underline-opacity-0" href="evidencija?p=<?= $row["id"] ?>&i=<?= $zadnja_inventura ?>">
                                        <h5 class="btn btn-icon"><i class="bi bi-person"></i></h5>
                                        <?= $row["ime"] . " " . $row["prezime"] . " (" . $row["username"] . ")" ?>
                                        <p class="card-text fw-semibold <?php echo $row["role"] == "admin" ? "text-danger" : "text-success" ?>"><?= $row["role"] ?></p>
                                    </a>

                                    <?php if ($row["id"] != $_SESSION["id"]) : ?>
                                        <button class="btn btn-primary m-3" onclick="changeRole(<?= $row['id'] ?>, '<?= $row['role'] == 'admin' ? 'user' : 'admin' ?>')">Promijeni ulogu</button>
                                    <?php endif; ?>


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
        function changeRole(id, role) {
            const sessionCookie = getCookie("sessionid");
            const requestOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Cookie': 'sessionid=' + sessionCookie,
                },
                body: JSON.stringify({
                    "data": {
                        "id": id,
                        "role": role,
                    },
                    "action": "change_role"
                })
            };

            var url = "js_upload";
            fetch(url, requestOptions)
                .then(response => response.text())
                .then(data => {
                    location.reload();

                    // console.log(data)
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

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