<?php 
    session_start();

    $pdo = new PDO('mysql:host=localhost;dbname=DATABASENAMEHERE', 'USERNAMEHERE', 'PASSWORDHERE');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $locationID = $_POST["location_id"];
    if (isset($_SESSION['user_id'])){

        if (isset($_POST["rev-title"]) && isset($_POST["rev-body"]) && isset($_POST["rev-rating"]) && isset($_POST["location_id"])){
            // Set variables for easier access
            $revTitle = $_POST["rev-title"];
            $revBody = $_POST["rev-body"];
            $revRating = $_POST["rev-rating"];
            $userID = $_SESSION["user_id"];
    
            // Create Query for inserting new location data into database
            $sql = "INSERT INTO reviews (title, body, rating, user_id, location_id) VALUES (?, ?, ?, ?, ?)";
    
            // Prepared Statements to help against SQL Injection 
            $stmnt = $pdo->prepare($sql);
            try {
                $stmnt->execute([$revTitle,$revBody,$revRating,$userID,$locationID]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            
            // Update rating for the location to be average of all user review ratings
            $rating_sql = 
            "UPDATE locations 
            SET locations.rating = (SELECT ROUND(AVG(reviews.rating),2)
                                    FROM reviews
                                    WHERE reviews.location_id = ?)
            WHERE locations.location_id = ?";

            $rating_stmnt = $pdo->prepare($rating_sql);
            try {
                $rating_stmnt->execute([$locationID,$locationID]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }  
            header("Location: http://{$_SERVER['HTTP_HOST']}/html/location.php?location_id=".$locationID."&status=success");
        } else {

            header("Location: http://{$_SERVER['HTTP_HOST']}/html/location.php?location_id=".$locationID."&status=error");
        }

    } else {
        header("Location: http://{$_SERVER['HTTP_HOST']}/html/location.php?location_id=".$locationID."&status=not-logged-in");
    }
?>