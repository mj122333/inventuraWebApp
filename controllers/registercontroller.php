<?php
// varijable za view
$nameErr = $emailErr = $passwordErr = $loginErr = $loginSuccess = "";
$username = $email = $password = $ime = $prezime = "";

// logika za registraciju i provjeru valjanosti podataka
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];

    $result = $db->select("SELECT username, email FROM vl_users WHERE username = ? OR email = ?", array($username, $email));

    if ($result['row_count'] >= 1) {
        $emailErr = $nameErr = "E-mail ili korisničko ime su zauzeti";
        $loginErr = "E-mail ili korisničko ime su zauzeti";
    } else {

        if (isset($_POST["kod"]) && $_POST["kod"] !== "") {
            $sql = "SELECT user_id, vl_users.username as pozivatelj, vl_users.id as admin_id FROM vl_invite_codes, vl_users WHERE kod = ? AND user_id=users.id";
            $result = $db->select($sql, array($_POST["kod"]));

            if ($result['row_count'] === 1) {
                $result = $result["result"];
                $admin_id = $result["admin_id"];
                $admin_username = $result["pozivatelj"];

                $role = "user";
                $sql = "INSERT INTO vl_users (ime, prezime, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
                $pass_hash = md5($password);
                $result = $db->insert($sql, array($ime, $prezime, $username, $email, $pass_hash, $role));

                if ($result["success"]) {
                    $loginSuccess = "Pozvao vas je admin <b>" . $admin_username . "</b>, sad se možete prijaviti";
                } else {
                    $loginErr = "Registracija nije uspjela, pokušajte ponovo";
                }

                $user_id = $result["insert_id"];
                $sql = "INSERT INTO vl_pozvani (admin_id, user_id) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $admin_id, $user_id);
                $stmt->execute();
            } else {
                $loginErr = "Pozivni kod ne postoji ili više nije valjan";
            }
        } else {

            if (!preg_match("/^[\w\.\-]+@([\w\-]+\.)+[\w\-]{2,4}$/", $email)) {
                $loginErr = "Neispravna e-mail adresa";
            } else {
                $role = "user";
                $pass_hash = md5($password);
                $result = $db->insert("INSERT INTO vl_users (ime, prezime, username, email, password, role, datum_registracije) VALUES (?, ?, ?, ?, ?, '$role', ?)", array($ime, $prezime, $username, $email, $pass_hash, date("Y-m-d H:i:s")));

                if ($result["success"]) {
                    $loginSuccess = "Registracija uspješna <b>" . $username . "</b>, sad se možete prijaviti";
                } else {
                    $loginErr = "Registracija nije uspjela, pokušajte ponovo";
                }
            }
        }
    }
}

// echo basename(__FILE__, '.php');


require_once "views/registerview.php";
