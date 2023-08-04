<?php
session_start();
include "db_config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Prijava</title>

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

<?php
$nameErr = $emailErr = $passwordErr = $loginErr = $loginSuccess = "";
$username = $email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, role FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $pass_hash = md5($password);
    $stmt->bind_param("ss", $username, $pass_hash);

    if ($stmt->execute()) {
        $rows = $stmt->get_result();
        if (mysqli_num_rows($rows) === 1) {


            $result = $rows->fetch_assoc();

            $loginSuccess = "Prijava uspješna, <b>" . $result["username"] . "</b>";
            $_SESSION["username"] = $result["username"];
            $_SESSION["role"] = $result["role"];
            $_SESSION["user_id"] = $result["id"];

            $userID = $result["id"];
            $expiry = time() + (60 * 60);
            $expiry_sql_format = date('Y-m-d H:i:s', $expiry);
            $token = bin2hex(random_bytes(32));

            setcookie('sessionid', $token, $expiry, '/');

            $sql = "SELECT * FROM session_cookies WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $userID);
            $stmt->execute();
            $rows = $stmt->get_result();
            if (mysqli_num_rows($rows) === 1) {
                $result = $rows->fetch_assoc();
                $sql = "UPDATE session_cookies SET token = ?, expiry = ? WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $token, $expiry_sql_format, $userID);
                $stmt->execute();
            } else {
                $sql = "INSERT INTO session_cookies (user_id, expiry, token) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $userID, $expiry_sql_format, $token);
                $stmt->execute();
            }

            $_SESSION["login_message"] = "Prijava uspješna, dobrodošli ";

            header("Location: index.php");
            exit;
        } else {
            $loginErr = "Krivo korisničko ime ili lozinka";
        }
    } else {
        $loginErr = "Prijava nije uspjela, pokušajte ponovo";
    }
}
?>

<body data-bs-theme="dark">

    <?php
    include "header.php";
    ?>

    <div id="<?php echo ($loginErr) ? 'shakeDiv' : ''; ?>" class="container border rounded py-3 my-5 col-lg-4">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <?php if ($loginErr) : ?>
                <p class="text-danger mb-3"><?php echo $loginErr; ?></p>
            <?php elseif ($loginSuccess) : ?>
                <p class="text-success mb-3"><?php echo $loginSuccess; ?></p>
            <?php endif; ?>

            <div class="input-group mb-3">
                <span class="input-group-text">username</span>
                <input type="text" class="form-control" name="username" id="username" placeholder="username">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">password</span>
                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                <button class="btn btn-success" id="show-pass" onclick="showPassword()" type="button">Show</button>
            </div>

            <button class="btn btn-success w-100" type="submit">Prijavi se</button>
        </form>

        <small>Nemate račun?</small>
        <a href="register.php" class="link-secondary link-underline-secondary link-underline-opacity-0 link-underline-opacity-75-hover"><small>Kreirajte ga!</small></a>
    </div>
    <!-- <img src="assets/smartphone_mockup.svg" alt=""> -->

    <script>
        shakeDiv();
    </script>
</body>

</html>