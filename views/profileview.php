<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Profil</title>
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

    <!-- <?php print_r($_SESSION); ?> -->

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include "header.php"; ?>

        <main class="d-flex flex-row" style="flex: 1;">
            <?php include 'sidebar.php'; ?>

            <div class="container border rounded py-3 w-50 my-5">

                <form method="POST" action="profile.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text">ID</span>
                        <input type="text" class="form-control" name="kod" placeholder="ID">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>

                    <div class="input-group my-3">
                        <label class="input-group-text">Options</label>
                        <select class="form-select">
                            <?php $ucionice = getUcionice(); ?>
                            <?php foreach ($ucionice["result"] as $u) : ?>
                                <option value="<?php echo $u['id']; ?>"><?php echo $u['oznaka']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>

                <ul class="list-group list-group-flush overflow-auto" style="max-height: 50vh;">
                    <?php
                    $sql = "SELECT * FROM test";
                    $result = $db->select($sql);

                    if ($result['row_count'] > 0) {
                        foreach ($result["result"] as $row) { ?>

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto fw-bold"><?= $row["id"] ?></div>
                                <a href='delete_item.php?id=<?= $row["id"] ?>' class="badge bg-danger rounded-pill">Izbriši</a>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch">
                                </div>
                            </li>

                    <?php }
                    }
                    ?>
                </ul>
                <?php if ($result['row_count'] == 0) : ?>
                    <small class="text-secondary">Lista je prazna</small>
                <?php else : ?>
                    <small class="text-secondary">Popis evidentiranih proizvoda</small>
                <?php endif; ?>

            </div>
        </main>

        <?php if (isset($_SESSION['login_message'])) : ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex alert alert-primary p-0">
                        <div class="toast-body fw-bold">
                            <?php echo $_SESSION['login_message']; ?><b><?php echo $username ?></b>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['login_message']); ?>
        <?php endif; ?>

        <script>
            const toastLiveExample = document.getElementById('liveToast')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastBootstrap.show();
        </script>
    </div>
</body>

</html>