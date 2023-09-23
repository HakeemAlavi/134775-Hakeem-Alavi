<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CholeraCare Landing Page</title>
    <link rel="stylesheet" href="landing-css/style.css" />
  </head>
  <body>
    <main>
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

        <div class="showcase-area">
          <div class="container">
            <div class="left">
              <div class="big-title">
                <h1>Say no to Cholera,</h1>
                <h1>Educate to eradicate.</h1>
              </div>
              <p class="text">
			  At CholeraCare, we're dedicated to transforming the way cholera is managed. Our web application offers a comprehensive suite of tools and resources to streamline cholera detection and prevention. Join us in the fight against cholera today!
              </p>
              <div class="cta">
                <a href="login-user.php" class="btn">Get started</a>
              </div>
            </div>

            <div class="right">
              <img src="media/cholera.jpg" alt="Cholera Image" class="person" />
            </div>
          </div>
        </div>

        <!-- <div class="bottom-area">
          <div class="container">
            <button class="toggle-btn">
              <i class="far fa-moon"></i>
              <i class="far fa-sun"></i>
            </button>
          </div>
        </div> -->
      </div>
    </main>

    <!-- JavaScript Files -->

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="landing-css/app.js"></script>
  </body>
</html>
