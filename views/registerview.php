<?php
include "config/db_config.php";

if (isset($_COOKIE["sessionid"])) {
    header("Location: home.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Registracija</title>

    <style>
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-10px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(10px);
            }
        }

        .shake-animation {
            animation: shake .5s ease-in-out;
        }
    </style>

    <script>
        function shakeDiv() {
            const divToShake = document.getElementById("shakeDiv");
            divToShake.classList.add("shake-animation");
            setTimeout(() => {
                divToShake.classList.remove("shake-animation");
            }, 1000);
        }

        function showPassword() {
            var password = document.getElementById("password");
            var show = document.getElementById("show-pass");
            if (password.type === "password") {
                password.type = "text";
                show.innerHTML = "Sakrij";
            } else {
                password.type = "password";
                show.innerHTML = "Prikaži";
            }
        }
    </script>
</head>

<body data-bs-theme="dark" style="height: 100vh;" class="d-flex justify-content-center align-items-center">

    <div id="<?php echo ($emailErr) ? 'shakeDiv' : ''; ?>" class="container border rounded py-3 my-5 col-lg-4">
        <form class="needs-validation" novalidate method="POST" action="register">

            <?php if ($loginErr) : ?>
                <p class="text-danger mb-3"><?php echo $loginErr; ?></p>
            <?php elseif ($loginSuccess) : ?>
                <p class="text-success mb-3"><?php echo $loginSuccess; ?></p>
            <?php endif; ?>

            <div class="input-group mb-3">
                <span class="input-group-text">ime</span>
                <input type="text" class="form-control" name="ime" value="<?php echo $ime; ?>" placeholder="ime" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">prezime</span>
                <input type="text" class="form-control" name="prezime" value="<?php echo $prezime; ?>" placeholder="prezime" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">e-mail</span>
                <input type="text" class="form-control <?php echo ($emailErr) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo $email; ?>" placeholder="e-mail" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">username</span>
                <input type="text" class="form-control <?php echo ($nameErr) ? 'is-invalid' : ''; ?>" name="username" value="<?php echo $username; ?>" placeholder="username" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">password</span>
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                <button class="btn btn-success" id="show-pass" onclick="showPassword()" type="button">Prikaži</button>
            </div>

            <div class="form-check form-switch">
                <label class="form-check-label" for="kodcheck">Imate pozivni kod?</label>
                <input class="form-check-input" id="kodcheck" type="checkbox" role="switch">
            </div>

            <div id="kodDiv" style="display: none;">
                <small>Ako vas je pozvao admin unesite kod</small>
                <div class="input-group mb-3">
                    <span class="input-group-text">pozivni kod</span>
                    <input type="password" class="form-control" name="kod" placeholder="pozivni kod">
                </div>
            </div>

            <button class="btn btn-success w-100" type="submit">Registriraj se</button>
        </form>

        <small>Imate račun?</small>
        <a href="<?php echo DS . APPFOLDER . DS ?>login" class="link-secondary link-underline-secondary link-underline-opacity-0 link-underline-opacity-75-hover"><small>Prijavite se!</small></a>
    </div>

    <script>
        // shakeDiv();

        const toggleCheckbox = document.getElementById('kodcheck');
        const kodDiv = document.getElementById('kodDiv');

        toggleCheckbox.addEventListener('change', function() {
            if (toggleCheckbox.checked) {
                kodDiv.style.display = 'block';
            } else {
                kodDiv.style.display = 'none';
            }
        });
    </script>
</body>

</html>