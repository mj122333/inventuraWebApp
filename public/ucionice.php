<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Admin</title>
    <script src="js/delete_items.js"></script>
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
</style>

<body data-bs-theme="light">

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include 'header.php'; ?>

        <main class="d-flex flex-row h-100">

            <?php include 'sidebar.php'; ?>

            <div class="container-fluid row p-5 mx-0 h-100">
                <!-- <div class="border h-50 overflow-auto"> -->
                <form id="form" onsubmit="return false;">

                    <div class="border table-wrapper-scroll-y custom-scrollbar">
                        <table class="table table-dark table-hover">
                            <?php
                            $sql = "SELECT * FROM ucionice";
                            $result = $db->select($sql);

                            if ($result["row_count"] > 0) {
                            ?>
                                <thead class="position-sticky" style="top: 0;">
                                    <tr>
                                        <th scope="col">Obriši</th>
                                        <th>ID</th>
                                        <th>oznaka</th>
                                        <th>opis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result["result"] as $row) { ?>
                                        <tr class="bg-success">
                                            <th>
                                                <input class="form-check-input checkEvidencija" type="checkbox" value="<?= $row["id"] ?>">
                                            </th>
                                            <th scope="row"><?= $row["id"] ?></th>
                                            <td><?= $row["oznaka"] ?></td>
                                            <td><?= $row["opis"] ?></td>
                                        </tr>

                                <?php }
                                } else {
                                    echo "<th>Još nema zabilježenih evidencija</th>";
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                    <button class="btn btn-success fw-bold" type="submit" onclick="deleteItems()">IZBRIŠI ODABRANO</button>
                    <button class="btn btn-primary fw-bold" id="oznaci">OZNAČI SVE</button>
                    <button class="btn btn-outline-primary fw-bold" id="makni">MAKNI SVE</button>
                </form>

            </div>
        </main>

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
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>