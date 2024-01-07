<?php

// varijable za view
$nameErr = $emailErr = $passwordErr = $loginErr = $loginSuccess = "";
$username = $email = $password = "";

// logika za login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM vl_users WHERE username = ? AND password = ?";
    $pass_hash = md5($password);
    $result = $db->select($sql, array($username, $pass_hash));

    if ($result) {
        if ($result["row_count"] === 1) {

            $result = $result['result'][0];

            $loginSuccess = "Prijava uspješna, <b>" . $result["username"] . "</b>";

            foreach ($result as $key => $value) {
                if ($key != "password") {
                    $_SESSION[$key] = $value;
                }
            }

            // $_SESSION["id"] = $result["id"];
            // $_SESSION["ime"] = $result["ime"];
            // $_SESSION["prezime"] = $result["prezime"];
            // $_SESSION["username"] = $result["username"];
            // $_SESSION["email"] = $result["email"];
            // $_SESSION["role"] = $result["role"];
            // $_SESSION["datum_registracije"] = $result["datum_registracije"];

            $userID = $result["id"];
            $expiry = time() + (60 * 60 * 12); // 60 * 60 = 1 sat
            $_SESSION["expiry"] = $expiry;
            $expiry_sql_format = date('Y-m-d H:i:s', $expiry);
            $token = bin2hex(random_bytes(16));

            setcookie('sessionid', $token, $expiry, '/');

            $sql = "SELECT * FROM vl_session_cookies WHERE user_id = ?";
            $result = $db->select($sql, array($userID));


            if ($result["row_count"] === 1) {
                $sql = "UPDATE vl_session_cookies SET token = ?, expiry = ? WHERE user_id = ?";
                $db->update($sql, array($token, $expiry_sql_format, $userID));
            } else {
                $sql = "INSERT INTO vl_session_cookies (user_id, expiry, token) VALUES (?, ?, ?)";
                $db->insert($sql, array($userID, $expiry_sql_format, $token));
            }

            $_SESSION["login_message"] = "Prijava uspješna, dobrodošli ";


            header("Location: " . DS . APPFOLDER . DS . "home");
            exit;
        } else {
            $db->mysql_error("LOGIN FAIL", $username . " => " . $password);
            $loginErr = "Krivo korisničko ime ili lozinka";
        }
    } else {
        $loginErr = "Prijava nije uspjela, pokušajte ponovo";
    }
}

// ucitavanje login stranice
require_once "views/loginview.php";
