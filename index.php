<!DOCTYPE html>
<!-- head used for information used by browsers like styles and scripts -->

<head>
    <!-- meta viewport added for responsive web design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- using roboto and open sans font familes -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- relative link to css file in same directory  -->
    <link rel="stylesheet" href="/css/main-styles.css" type="text/css">
    <!-- document will not validate without a title -->
    <title>Poutine Encyclopedia</title>
</head>

<!-- body is the majority of the website, most tags go inside the body tag -->

<body>
    <!-- using a div (a generic block element to wrap everything in body) -->
    <!-- id's should be used uniquely, classes can be used more than once. -->
    <div class="container">
        <!-- This header tag contains an h1 to show the name of the webpage,
        as well as a nav element which is an html5 element typically used to display 
        different links to other connected html pages. -->
        <header class="header">

            <h1>Poutine Encyclopedia
                <span>
                    <picture>
                        <source media="(min-width: 45em)" srcset="/img/fries-640.png">
                        <source media="(max-width: 45em)" srcset="/img/fries-320.png">
                        <img src="/img/fries-640.png" style="width:1.5em;" alt="Fries Logo ">
                    </picture>
                </span>
            </h1>
            <nav>
                <!-- a tags contain links, in this nav bar all links are relative based off the location
                of index.html -->
                <ul>
                    <li id="h">
                        <a href="/index.php ">Home</a>
                    </li>
                    <li id="s">
                        <a href="/html/search.php ">Search</a>
                    </li>
                    <li id="r">
                        <a href="/html/registration.php ">Registration</a>
                    </li>
                    <li id="l">
                        <a href="/html/submission.php ">Locations</a>
                    </li>
                </ul>

            </nav>
        </header>
        <!-- paragraph containing general information about the site on the homepage. -->
        <main>
            <div class="intro">
                <h3>A Place to Find and Share Poutine</h3>

                <img src="/img/poutine.png " alt="Poutine ">
                <p>
                    An archive of all <span id="special">restaurants</span> which serve poutine.
                </p>

            </div>
        </main>
        <!-- Footer is typically at bottom of page and used for less important links, 
             copyright info, country information, etc... -->
        <footer class="main-footer ">Sample Footer<br>
            <span class="fa fa-facebook fa-lg "></span>
            <span class="fa fa-twitter fa-lg "></span>
            <span class="fa fa-instagram fa-lg "></span>
            <span class="fa fa-reddit fa-lg "></span>
        </footer>
    </div>
    <div id="background"></div>
</body>

</html>