<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Andreas Faisst">
    <meta name="theme-color" content="#7952b3">
    <title>Andreas Faisst</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@250&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400&display=swap" rel="stylesheet">
    <!-- font-family: 'Lato', sans-serif; -->

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ceedc74733.js" crossorigin="anonymous"></script>
    
    <!-- Get Bootstrap -->
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom styles  -->
    <link href="./css/main.css" rel="stylesheet">

    <!-- Java Scripts -->
    <!-- <script src="./js/main.js"></script> -->


    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

<!-- RETRIEVE PAPERS --->
<?php

## Import functions
require './pub_code/code.php';

## Define Search Parameters
$params = '
{
    "author":"Faisst, A",
    "year1":2014,
    "year2":2030,
    "pos1":1,
    "pos2":3,
    "fields":"author,title,year,doctype,bibstem,issue,volume,page,bibcode,pubdate",
    "rows":2000,
    "token":"GEPfSqv6hnDSBu9xQmXIagITrsxVyCDBg6VmiJNW"
}
';

## Perform Search
$results = getpapers($params);

## Create HTML
$html_output = createHTML($results);

?>
<!-- END: RETRIEVE PAPERS -->

</head>

<body>

<!-- NAVIGATION -->
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark box-shadow bg-purple nav-opacity nav-links-opacity" >
    <div class="container-fluid">
        <a class="navbar-brand ms-3 me-4" href="index.html" style="text-decoration: none;"><i class="fa-solid fa-house"></i></a>
        <div class="navbar-toggler border-0  text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"  data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-1"></i>
        </div>
        <div class="collapse navbar-collapse fs-5" id="navbarCollapse">
            <ul class="navbar-nav mb-2 mb-md-0">
                <li class="nav-item dropdown ms-4 me-4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Research
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark  fs-5" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="researchoverview.htm">Overview</a></li>
                    <li><a class="dropdown-item" href="researchgroup.htm">Group</a></li>
                    <li><a class="dropdown-item" href="researchprojects.htm">Projects</a></li>
                    <li><a class="dropdown-item" href="publications.php">Publications</a></li>
                    </ul>
                </li>
                <li class="nav-item ms-4 me-4">
                    <a class="nav-link" href="teaching.htm">Teaching</a>
                </li>
                <li class="nav-item ms-4 me-4">
                    <a class="nav-link" href="outreach.htm">Outreach</a>
                </li>
                <li class="nav-item ms-4 me-4">
                    <a class="nav-link" href="aboutme.htm" >About Me</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN -->
<main class="">

    <!-- Header-->
    <div class="container-fluid text-bg-dark d-flex align-items-center imghead2-parallax" style="height: 50vh;">
        <div class="container-fluid text-start" style="width: 95vw; position:absolute; bottom: 50%">
            <h1 class="titlefont display-5 fw-bold text-white">Publications</h1>
            <!--<p class="lead fs-4 text-white">I explore the formation and evolution of galaxies through cosmic time.</p>-->
        </div>
    </div>
    <!-- End Header -->

    <!-- Content -->
    <div class="bg-white p-5">
        
        <p class="fs-5 text-justify">Below a complete list of <b> <?php echo($html_output[0]); ?> </b> main publications (first, second, and third author papers). For a list of all papers, please visit <a href="https://ui.adsabs.harvard.edu/search/q=%20author%3A%22Faisst%2C%20Andreas%22%20%20year%3A2010-&sort=date%20desc%2C%20bibcode%20desc&p_=0" target="_blank">NASA/ADS</a> directly.
        </p>

        <p class="fs-5 text-justify">
        <?php
        #echo("Number of entries: " . $html_output[0] . "<BR><BR>");
        echo($html_output[1]);
        ?>
        </p>

    </div>
    <!-- End Content -->
    
</main>




<!-- FOOTER -->
<footer>

    <div class="bg-dark text-center" style="min-height: 130px;">

        <p class="text-light ms-4 pt-4">
            <a href="https://www.linkedin.com/in/andreas-faisst-63123692" target="_blank"><i class="text-light fs-4 fa-brands fa-linkedin"></i></a>
            <a href="http://facebook.com/afaisst" target="_blank"><i class="text-light fs-4 fa-brands fa-facebook ms-3"></i></a>
            <a href="https://www.instagram.com/astrofaisst/" target="_blank"><i class="text-light fs-4 fa-brands fa-instagram ms-3"></i></a>
            <a href="https://twitter.com/astrofaisst" target="_blank"><i class="text-light fs-4 fa-brands fa-twitter ms-3"></i></a>
        </p>
        <p class="text-light ms-1 pt-1 mb-2">Copyright 2023 - Andreas Faisst - <a class="link-light" href="">Contact</a> </p>


    </div>
    
</footer>

<!-- END FOOTER -->


        
</body>
</html>

<!--     <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->