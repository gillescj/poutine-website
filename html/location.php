<?php 
    $pdo = new PDO('mysql:host=localhost;dbname=DATABASENAMEHERE', 'USERNAMEHERE', 'PASSWORDHERE');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $status = '';
    $reviewMessage = '';

    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }

    switch ($status) {
        case 'success':
            $reviewMessage = "Review Posted Successfully";
        break;
        case 'error':
            $reviewMessage = "Error Posting Review";
        break;
        case 'not-logged-in':
            $reviewMessage = "Please Log In to Post Reviews";
        break;
    }

    if (isset($_GET["location_id"])){
        $location_id = $_GET['location_id'];

        $info_sql = "SELECT name, lat, lng, rating FROM locations WHERE location_id = ?";

        $info_stmnt = $pdo->prepare($info_sql);
        try {
            $info_stmnt->execute([$location_id]);
            $info_rows = $info_stmnt->fetchAll();
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Reviews Database Access
        $reviews_sql = "SELECT reviews.title, reviews.body, reviews.rating FROM reviews WHERE reviews.location_id = ?";

        $reviews_stmnt = $pdo->prepare($reviews_sql);
        try {
            $reviews_stmnt->execute([$location_id]);
            $reviews_rows = $reviews_stmnt->fetchAll();
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    } else {
        header("Location: http://{$_SERVER['HTTP_HOST']}/html/search.php");
    }

?>


<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main-styles.css" type="text/css">
    <script src="script.js"></script>
    <script src="map.js"></script>
    <title>Object Details</title>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Object Details</h1>
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
            <div class="sample-top">
                <div class="top-info">
                    <h2><?php echo $info_rows[0]['name']; ?></h2>
                    <h2><?php echo $info_rows[0]['rating'].'/5'; ?></h3>
                </div>
                <!-- <div class="top-media">
                    <div class="top-picture">
                        <img src="/img/smokes-logo.jpg" alt="Smoke's Poutinerie Logo">
                    </div>
                </div> -->
            </div>
            <div id="sample-map">
                <script src="/map2.js"></script>
                <script>
                    addMarker(<?php echo $info_rows[0]['lat']; ?>, <?php echo $info_rows[0]['lng']; ?>,<?php echo json_encode($info_rows[0]['name']); ?>);
                    changeView(<?php echo $info_rows[0]['lat']; ?>, <?php echo $info_rows[0]['lng']; ?>);
                </script>
            </div>
            <div id="reviews">
                <h2 id="review-header">Reviews</h2>
                <div id="review-form-container">
                    <form id="review-form" action="/phpFunctions/addReview.php" method="POST">
                        <h2>Write a Review</h2>
                        <ul>
                            <li>
                                <div id="review-status" class="status">
                                    <?php echo $reviewMessage ?>
                                </div>
                            </li>
                            <li>
                                <div id="review-status" class="status">
                                </div>
                            </li>
                            <li>
                                <label for="rev-title">Title</label>
                                <input type="text" id="rev-title" name="rev-title" maxlength="100" required>
                            </li>
                            <li>
                                <label for="rev-body">Body</label>
                                <textarea name="rev-body" id="rev-body" cols="30" rows="5" maxlength="1000" required></textarea>
                            </li>
                            <li>
                                <label for="rev-rating">Rating</label>
                                <select name="rev-rating" id="rev-rating">
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="5" selected="selected">5 Stars</option>
                                </select>
                            </li>
                            <li class="hidden">
                                <input type="hidden" name="location_id" value="<?php echo $location_id ?>">
                            </li>
                            <li>
                                <input type="submit" value="Post Review">
                            </li>
                        </ul> 
                    </form>
                </div>
                <div id="review-post-container">
                    <?php foreach ($reviews_rows as $row): ?>
                        <div class="review-post">
                            <ul>
                                <li>
                                    <h3><?php echo $row['title']; ?></h3>
                                    <h4><?php echo $row['rating'].'/5'; ?></h5>
                                    <p><?php echo $row['body']; ?></p>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
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
