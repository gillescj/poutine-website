<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main-styles.css" type="text/css">
    <script src="/script.js"></script>
    <title>Search</title>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Search</h1>
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
            <div id="search-container">
                <form id="search" action="/html/search_results.php" method="GET">
                    <ul>
                        <li>
                            <label for="location-search">Location Name</label>
                            <input type="search" name="location-search" id="location-search"
                                placeholder="Enter a Name of Location...">
                        </li>
                        <li>
                            <label for="rating-search">Rating</label>
                            <select name="rating-search" id="rating-search">
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                                <option value="any-star" selected="selected">Any Stars</option>
                            </select>
                        </li>
                        <li>
                            <input type="submit" value="Search">
                        </li>
                        <li>
                            <input type="button" value="Search My Location" onclick="displayGeo()">
                        </li>
                        <li id="geo-location"></li>
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