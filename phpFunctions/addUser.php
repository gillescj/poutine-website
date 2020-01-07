<?php
    // Create new PDO object to access MySQL database
    $pdo = new PDO('mysql:host=localhost;dbname=DATABASENAMEHERE', 'USERNAMEHERE', 'PASSWORDHERE');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Make sure all variables in form are declared
    if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["reg-area"]) && isset($_POST["reg-email"]) && isset($_POST["reg-password"])){
        
        // Check if email is alredy in database
        $email = $_POST["reg-email"];
        
        $email_count_sql = "SELECT * FROM users WHERE email = ?";
        $email_count_stmnt = $pdo->prepare($email_count_sql);
        try {
            $email_count_stmnt->execute([$email]);
            $email_count = count($email_count_stmnt->fetchAll());
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($email_count == 0){
        
            // Set variables for easier access
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $area = $_POST["reg-area"];
            $pass = $_POST["reg-password"];
            $pass_hash = password_hash($pass, PASSWORD_ARGON2I);

            // Create Query for inserting new user data into database
            $sql = "INSERT INTO users (first_name, last_name, area, email, password_hash) VALUES (?, ?, ?, ?, ?)";

            // Prepared Statements to help against SQL Injection 
            $stmnt = $pdo->prepare($sql);
            try {
                $stmnt->execute([$fname,$lname,$area,$email,$pass_hash]);
                // Redirect back to registration page when done
                header("Location: http://{$_SERVER['HTTP_HOST']}/html/registration.php?status=reg-success");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            header("Location: http://{$_SERVER['HTTP_HOST']}/html/registration.php?status=email-exists");
        }
    } else {
        // If form variables aren't all set, redirect back with error status
        header("Location: http://{$_SERVER['HTTP_HOST']}/html/registration.php?status=reg-error");
    }

?>
