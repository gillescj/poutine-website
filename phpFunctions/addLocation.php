<?php
    session_start();

    $pdo = new PDO('mysql:host=localhost;dbname=DATABASENAMEHERE', 'USERNAMEHERE', 'PASSWORDHERE');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SESSION['user_id'])){

        if (isset($_POST["ob-name"]) && isset($_POST["ob-desc"]) && isset($_POST["ob-location-lat"]) && isset($_POST["ob-location-long"])){

            $obName = $_POST["ob-name"];
            $obDescription = $_POST["ob-desc"];
            $obLat = $_POST["ob-location-lat"];
            $obLong = $_POST["ob-location-long"];
    
            // Create Query for inserting new location data into database
            $sql = "INSERT INTO locations (name, description, lat, lng, img_link, user_id) VALUES (?, ?, ?, ?, ?, ?)";
    
            $stmnt = $pdo->prepare($sql);
            try {
                $stmnt->execute([$obName,$obDescription,$obLat,$obLong,"link/to/img/placeholder", $_SESSION['user_id']]);
                header("Location: http://{$_SERVER['HTTP_HOST']}/html/submission.php?status=sub-success");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
    
        } else {
            header("Location: http://{$_SERVER['HTTP_HOST']}/html/submission.php?status=sub-error");
        }

    } else {
        header("Location: http://{$_SERVER['HTTP_HOST']}/html/submission.php?status=sub-not-logged-in");
    }
?>