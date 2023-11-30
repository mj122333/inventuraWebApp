<?php

$nameErr = $emailErr = $passwordErr = $loginErr = $loginSuccess = "";
$username = $email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, role FROM users WHERE username = ? AND password = ?";
    $pass_hash = md5($password);
    $result = $db->select($sql, array($username, $pass_hash));

    if ($result) {
        if ($result["row_count"] === 1) {

            $result = $result['result'][0];

            $loginSuccess = "Prijava uspješna, <b>" . $result["username"] . "</b>";
            $_SESSION["username"] = $result["username"];
            $_SESSION["role"] = $result["role"];
            $_SESSION["id"] = $result["id"];

            $userID = $result["id"];
            $expiry = time() + (60 * 60);
            $_SESSION["expiry"] = $expiry;
            $expiry_sql_format = date('Y-m-d H:i:s', $expiry);
            $token = bin2hex(random_bytes(16));

            setcookie('sessionid', $token, $expiry, '/');

            $sql = "SELECT * FROM session_cookies WHERE user_id = ?";
            $result = $db->select($sql, array($userID));


            if ($result["row_count"] === 1) {
                $sql = "UPDATE session_cookies SET token = ?, expiry = ? WHERE user_id = ?";
                $db->update($sql, array($token, $expiry_sql_format, $userID));
            } else {
                $sql = "INSERT INTO session_cookies (user_id, expiry, token) VALUES (?, ?, ?)";
                $db->insert($sql, array($userID, $expiry_sql_format, $token));
            }

            $_SESSION["login_message"] = "Prijava uspješna, dobrodošli ";

            header("Location: profile");
            exit;
        } else {
            $loginErr = "Krivo korisničko ime ili lozinka";
        }
    } else {
        $loginErr = "Prijava nije uspjela, pokušajte ponovo";
    }
}


function login_with_cookie($cookie)
{
    
}



echo basename(__FILE__, '.php');


require_once "views/loginview.php";
