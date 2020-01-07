<?php
    session_start();

    $status = '';
    $regMessage = '';
    $loginMessage = '';
    $loginUserMessage = "No One Logged In";

    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }

    switch ($status) {
        case 'reg-success':
            $regMessage = "Sign Up Successful, Please Log In";
        break;
        case 'reg-error':
            $regMessage = "Error Signing Up";
        break;
        case 'email-exists':
            $regMessage = "Email Already Exists, Please Log In";
        break;
        case 'login-success':
            $loginMessage = "Login Successful";
        break;
        case 'login-error':
            $loginMessage = "Error Logging In";
        break;
        case 'no-email':
            $loginMessage = "Email does not Exist";
        break;
        case 'login-wrong-userpass':
            $loginMessage = "Incorrect Email/Password";
        break;
        case 'logout':
            $loginMessage = "Logout Successful";
        break;
    }

    if (isset($_SESSION['user_fname'])){
        $loginUserMessage = "Current User:<br>".$_SESSION['user_fname'];
    }

?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main-styles.css" type="text/css">
    <script src="/script.js" defer></script>
    <title>Log In/Register</title>

</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Registration</h1>
            <nav>
                <ul>
                    <li>
                        <a href="/index.php ">Home</a>
                    </li>
                    <li>
                        <a href="/html/search.php ">Search</a>
                    </li>
                    <li>
                        <a href="/html/registration.php ">Registration</a>
                    </li>
                    <li>
                        <a href="/html/submission.php ">Locations</a>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="register-container">
                <form id="register-form" action="/phpFunctions/addUser.php" method="POST" >
                    <h2>Sign Up</h2>
                    <ul>
                        <li>
                            <div id="reg-status" class="status">
                                <?php echo $regMessage ?>
                            </div>
                        </li>
                        <li>
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" placeholder="Enter First Name...">
                            <div id="fname-err" class="regi-error"></div>
                        </li>

                        <li>
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lname" placeholder="Enter Last Name...">
                            <div id="lname-err" class="regi-error"></div>
                        </li>
                        <li>
                            <label for="reg-area">Area</label>
                            <select name="reg-area" id="reg-area">
                                <option value="hamilton">Hamilton</option>
                                <option value="brantford">Brantford</option>
                                <option value="cambridge">Cambridge</option>
                            </select>
                        </li>
                        <li>
                            <label for="reg-email">Email</label>
                            <input type="email" id="reg-email" name="reg-email" placeholder="Enter Username...">
                            <div id="reg-email-err" class="regi-error"></div>
                        </li>
                        <li>
                            <label for="reg-pswd">Password</label>
                            <input type="password" id="reg-pswd" name="reg-password" placeholder="Enter Password...">
                            <div id="reg-paswd-err" class="regi-error"></div>
                        </li>
                        <li>
                            <input type="submit" class="register-btn" value="Sign Up">
                        </li>
                    </ul>
                </form>

                <form id="login-form" action="/phpFunctions/loginUser.php" method="POST">
                    <h2>Log In</h2>
                    <ul>
                        <li>
                            <div id="login-status" class="status">
                                <?php echo $loginMessage ?>
                            </div>
                        </li>
                        <li>
                            <label for="login-email">Email</label>
                            <input type="email" id="login-email" name="login-email" placeholder="Enter Email...">
                            <div id="login-email-err" class="regi-error"></div>
                        </li>
                        <li>
                            <label for="login-pswd">Password</label>
                            <input type="password" id="login-pswd" name="login-password"
                                placeholder="Enter Password...">
                            <div id="login-paswd-err" class="regi-error"></div>
                        </li>
                        <li>
                            <input type="submit" class="login-btn" value="Log In">
                        </li>
                        <li>or...</li>
                        <li>
                            <input type="button" id="logout-btn" value="Log Out"
                                onclick="location.href = '/phpFunctions/logout.php'">
                        </li>
                        <li>
                            <?php echo $loginUserMessage; ?>
                        </li>
                    </ul>
                </form>
            </div>
        </main>
        <footer class="main-footer">Sample Footer<br>
            <span class="fa fa-facebook fa-lg"></span>
            <span class="fa fa-twitter fa-lg"></span>
            <span class="fa fa-instagram fa-lg"></span>
            <span class="fa fa-reddit fa-lg"></span>
        </footer>
    </div>

</body>

</html>