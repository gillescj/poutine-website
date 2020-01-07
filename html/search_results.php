<?php 

$pdo = new PDO('mysql:host=localhost;dbname=DATABASENAMEHERE', 'USERNAMEHERE', 'PASSWORDHERE');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET["location-search"]) && isset($_GET["rating-search"])){
        $location_query = $_GET['location-search'];
        $rating_query = $_GET['rating-search'];
        
        if(isset($_GET["exact"])){
            $sql = "SELECT location_id, name, description, lat, lng, rating FROM locations WHERE name = ?";
    
                $stmnt = $pdo->prepare($sql);
                try {
                    $stmnt->execute([$location_query]);
                    $rows = $stmnt->fetchAll();
                    
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

        } else {
            if($rating_query == 'any-star'){
                $sql = "SELECT location_id, name, description, lat, lng, rating FROM locations WHERE name LIKE ? ORDER BY name";
    
                $stmnt = $pdo->prepare($sql);
                try {
                    $stmnt->execute(['%'.$location_query.'%']);
                    $rows = $stmnt->fetchAll();
                    
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                $sql = "SELECT location_id, name, description, lat, lng, rating FROM locations WHERE name LIKE ? and FLOOR(rating) = ? ORDER BY name";
    
                $stmnt = $pdo->prepare($sql);
                try {
                    $stmnt->execute(['%'.$location_query.'%', $rating_query]);
                    $rows = $stmnt->fetchAll();
                    
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main-styles.css" type="text/css">
    <script src="/script.js"></script>
    <title>Search Results</title>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Search Results</h1>
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
            <div class="results-wrapper">
                <div class="results-list">
                    <?php if(!empty($rows)): ?>
                        <?php foreach ($rows as $row): ?>
                            <ul>
                                <li><h3><?php echo '<a href="/html/location.php?location_id='.$row['location_id'].'">'.$row['name'].'</a>'; ?></h3></li>
                                <li><?php echo '<a href="/html/location.php?location_id='.$row['location_id'].'">More Information</a>'; ?></li>
                                <li class="flytolink"><?php echo '<a href="/html/search_results.php?location-search='.$row['name'].'&rating-search=any-star&exact=true">Fly Here</a>'; ?></li>
                                <li><?php echo 'Rating: '.$row['rating'].'/5'; ?></li>
                                <li><?php echo 'Latitude: '.$row['lat']; ?></li>
                                <li><?php echo 'Longitude: '.$row['lng']; ?></li>
                                <li><?php echo $row['description']; ?></li>
                            </ul>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <ul>
                            <li><?php echo 'Sorry, No Results Found'; ?></li>
                        </ul>
                        
                    <?php endif; ?>
                </div>
                <div id="results-map" class="map">
                    <script src="/map.js"></script>
                    <script>
                        addMarker(<?php echo $rows[0]['lat'] ?>, <?php echo $rows[0]['lng'] ?>,<?php echo json_encode('<a href="/html/location.php?location_id='.$rows[0]['location_id'].'">'.$rows[0]['name'].'</a>') ?>);
                        changeView(<?php echo $rows[0]['lat'] ?>, <?php echo $rows[0]['lng'] ?>);
                    </script>
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