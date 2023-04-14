<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inventura</title>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="koliko">
        <input type="submit" value="submit">
    </form>

    <div class="popis">
        <ul>
            <li>popis item</li>
            <li>popis item</li>
            <?php
            $popis = array();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $k = $_POST['koliko'];
                if (empty($k)) {
                    echo "Input is empty";
                } else {
                    for ($i = 0; $i < $k; $i++) {
                        array_push($popis, $i);
                    }
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $k = $_GET['koliko'];
                if (empty($k)) {
                    echo "Input is empty";
                } else {
                    for ($i = 0; $i < $k; $i++) {
                        array_push($popis, $i);
                    }
                }
                header("Content-Type: application/json");

                echo strval(rand(0, 10));

                $myfile = fopen("testfile.txt", "w");
                fwrite($myfile, "radi");
            }

            for ($i = 0; $i < count($popis); $i++) {
                echo "<li>$popis[$i]</li>";
            }
            ?>
        </ul>
    </div>



</body>

</html>