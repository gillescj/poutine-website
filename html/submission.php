<?php
    $status = '';
    $subMessage = '';

    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }

    switch ($status) {
        case 'sub-success':
            $subMessage = "Location Added";
        break;
        case 'sub-error':
            $subMessage = "Error Adding Location";
        break;
        case 'sub-not-logged-in':
            $subMessage = "Login Required";
        break;
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
    <script src="/script.js"></script>
    <title>Object Submission</title>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Object Submission</h1>
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
            <div class="object-submission-container">
                 <form id="submission-form" action="/phpFunctions/addLocation.php" method="POST">
                    <h2>Add a Location</h2>
                    <ul>
                        <li>
                            <div id="sub-status" class="status">
                                <?php echo $subMessage ?>
                            </div>
                        </li>
                        <li>
                            <label for="ob-name">Name</label>
                            <input type="text" id="ob-name" name="ob-name" placeholder="Enter Location Name..."
                                pattern="(^[a-zA-Z0-9\-_ ]{1,30}$)" required>
                        </li>
                        <li>
                            <label for="ob-desc">Description</label>
                            <textarea name="ob-desc" id="ob-desc" cols="30" rows="5" maxlength="255" required></textarea>
                        </li>
                        <li>
                            <div class="geolocation-input">
                                <ul>
                                    <li>
                                        <label for="ob-location-lat">Latitude</label>
                                        <input type="text" name="ob-location-lat" id="ob-location-lat"
                                            pattern="([+-]?(?=[\.?\d])\d*(\.\d+)?)" required>
                                    </li>
                                    <li>
                                        <label for="ob-location-long">Longitude</label>
                                        <input type="text" name="ob-location-long" id="ob-location-long"
                                            pattern="([+-]?(?=[\.?\d])\d*(\.\d+)?)" required>
                                    </li>
                                    <li>
                                        <input type="button" id="geolocate-submission" onclick="addGeo()"
                                            value="Use My Location">
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <label for="ob-image">Picture</label>
                            <input type="file" id="ob-image" name="img-upload">
                        </li>
                        <li>
                            <input type="submit" class="register-btn" value="Submit">
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