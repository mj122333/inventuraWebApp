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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
                show.innerHTML = "Hide";
            } else {
                password.type = "password";
                show.innerHTML = "Show";
            }
        }
    </script>
</head>

<body data-bs-theme="dark" style="height: 100vh;" class="d-flex justify-content-center align-items-center">

    <div id="<?php echo ($emailErr) ? 'shakeDiv' : ''; ?>" class="container border rounded py-3 my-5 col-lg-4">
        <form class="needs-validation" novalidate method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <?php if ($loginErr) : ?>
                <p class="text-danger mb-3"><?php echo $loginErr; ?></p>
            <?php elseif ($loginSuccess) : ?>
                <p class="text-success mb-3"><?php echo $loginSuccess; ?></p>
            <?php endif; ?>

            <div class="input-group mb-3">
                <span class="input-group-text">ime</span>
                <input required type="text" class="form-control" name="ime" value="<?php echo $ime; ?>" placeholder="ime">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">prezime</span>
                <input required type="text" class="form-control" name="prezime" value="<?php echo $prezime; ?>" placeholder="prezime">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">e-mail</span>
                <input required type="text" class="form-control <?php echo ($emailErr) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo $email; ?>" placeholder="e-mail">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">username</span>
                <input required type="text" class="form-control <?php echo ($nameErr) ? 'is-invalid' : ''; ?>" name="username" value="<?php echo $username; ?>" placeholder="username">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">password</span>
                <input required type="password" class="form-control" id="password" name="password" placeholder="password">
                <button class="btn btn-success" id="show-pass" onclick="showPassword()" type="button">Show</button>
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
        <a href="login" class="link-secondary link-underline-secondary link-underline-opacity-0 link-underline-opacity-75-hover"><small>Prijavite se!</small></a>
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