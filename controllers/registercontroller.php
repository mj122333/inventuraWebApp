<?php
$nameErr = $emailErr = $passwordErr = $loginErr = $loginSuccess = "";
$username = $email = $password = $ime = $prezime = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT username, email FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 1) {
        $emailErr = $nameErr = "E-mail ili korisničko ime su zauzeti";
        $loginErr = "E-mail ili korisničko ime su zauzeti";
    } else {

        if (isset($_POST["kod"]) && $_POST["kod"] !== "") {
            $sql = "SELECT user_id, users.username as pozivatelj, users.id as admin_id FROM invite_codes, users WHERE kod = ? AND user_id=users.id";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_POST["kod"]);
            $stmt->execute();
            $rows = $stmt->get_result();
            if ($rows->num_rows === 1) {
                $result = $rows->fetch_assoc();
                $admin_id = $result["admin_id"];
                $admin_username = $result["pozivatelj"];

                $role = "user";
                $sql = "INSERT INTO users (ime, prezime, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $pass_hash = md5($password);
                $stmt->bind_param("ssss", $ime, $prezime, $username, $email, $pass_hash, $role);

                if ($stmt->execute()) {
                    $loginSuccess = "Pozvao vas je admin <b>" . $admin_username . "</b>, sad se možete prijaviti";
                } else {
                    $loginErr = "Registracija nije uspjela, pokušajte ponovo";
                }

                $user_id = mysqli_insert_id($conn);
                $sql = "INSERT INTO pozvani (admin_id, user_id) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $admin_id, $user_id);
                $stmt->execute();
            } else {
                $loginErr = "Pozivni kod ne postoji ili više nije valjan";
            }
        } else {
            $role = "admin";
            $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, '$role')";
            $stmt = $conn->prepare($sql);
            $pass_hash = md5($password);
            $stmt->bind_param("sss", $username, $email, $pass_hash);

            if ($stmt->execute()) {
                $loginSuccess = "Registracija uspješna <b>" . $username . "</b>, sad se možete prijaviti";
            } else {
                $loginErr = "Registracija nije uspjela, pokušajte ponovo";
            }
        }
    }
}

echo basename(__FILE__, '.php');


require_once "views/registerview.php";
