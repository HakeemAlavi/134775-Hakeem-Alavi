<?php
require 'vendor/autoload.php';

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

// Create an HttpClient instance
$http = HttpClient::create();

// Create a HttpBrowser instance using the HttpClient
$client = new HttpBrowser($http);

// Define the URL of the webpage
$url = "https://www.who.int/emergencies/disease-outbreak-news/item/2023-DON437";

$crawler = $client->request("GET", $url);

// Find the first <h3> element and get its text
$firstH3Text = $crawler->filter('h3')->first()->text();

// Find the next 9 <p> elements and get their texts
$next9PTexts = $crawler->filter('p')->slice(0, 9);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS (You can adjust the path) -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- Font Awesome CDN-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="landing-css/style.css" />
    <!-- Your custom CSS -->
    <style>
        
        /* Custom CSS Styles */
        .simple-container{
            padding: 30px;
            margin-top: 50px;
        }
        .simple-content {
            margin-bottom: 40px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .simple-content-title {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .simple-content-text {
            font-size: 16px;
        }
    </style>
    <title>Scraped Content</title>
</head>
<body>
<div class="big-wrapper light">
<header>
          <div class="container">
            <div class="logo">
            <a href="landing.php"><img src="media/pharmacy.png" alt="Logo"/></a>
              <h3>CholeraCare</h3>
            </div>

            <div class="links">
              <ul>
                <li><a href="features.php">Features</a></li>
                <li><a href="simple.php">News</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="signup-user.php" class="btn">Sign up</a></li>
              </ul>
            </div>

            <div class="overlay"></div>

            <div class="hamburger-menu">
              <div class="bar"></div>
            </div>
          </div>
        </header>
    <div class="simple-container">
        <div class="simple-content">
            <h3 class="simple-content-title"><?php echo $firstH3Text; ?></h3>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(0)->text(); ?></p>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(1)->text(); ?></p>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(2)->text(); ?></p>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(3)->text(); ?></p>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(4)->text(); ?></p>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(5)->text(); ?></p>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(6)->text(); ?></p>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(7)->text(); ?></p>
            <p class="simple-content-text"><?php echo $next9PTexts->eq(8)->text(); ?></p>
        </div>
    </div>
</body>
</html>
