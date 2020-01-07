<?php  
    session_start();

    // Create new PDO object to access MySQL database
    $pdo = new PDO('mysql:host=localhost;dbname=DATABASENAMEHERE', 'USERNAMEHERE', 'PASSWORDHERE');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Make sure all variables in form are declared
    if (isset($_POST["login-email"]) && isset($_POST["login-password"])){

        $email = $_POST["login-email"];
        $pass = $_POST["login-password"];

        $sql = "SELECT user_id, first_name, password_hash FROM users WHERE email = ?";

        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute([$email]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $rows = $stmnt->fetchAll();

        if (count($rows) == 1){
            if(password_verify($pass, $rows[0]['password_hash'])){
                $_SESSION['user_id'] = $rows[0]['user_id'];
                $_SESSION['user_fname'] = $rows[0]['first_name'];
                header("Location: http://{$_SERVER['HTTP_HOST']}/html/registration.php?status=login-success");
            }
            else {
                header("Location: http://{$_SERVER['HTTP_HOST']}/html/registration.php?status=login-wrong-userpass");
            }
            
        } else {
            header("Location: http://{$_SERVER['HTTP_HOST']}/html/registration.php?status=no-email");
        }

    } else {
        header("Location: http://{$_SERVER['HTTP_HOST']}/html/registration.php?status=login-error");
    }

?>