<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Services Section</title>
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
    <style>
      section {
        height: 140vh;
        width: 100%;
        display: grid;
        place-items: center;
      }
    </style>
    
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
                
                <li><a href="signup-user.php" class="btn">Sign up</a></li>
              </ul>
            </div>

            <div class="overlay"></div>

            <div class="hamburger-menu">
              <div class="bar"></div>
            </div>
          </div>
        </header>
    <section>
    
      <div class="row">
        <div class="column">
          <div class="card">
            <div class="icon-wrapper">
              <i class="fa-solid fa-newspaper"></i>
            </div>
            <h3>Latest News</h3>
            <p>
            Stay informed with real-time updates on cholera outbreaks and developments.
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="icon-wrapper">
            <i class="fa-solid fa-vial"></i>
            </div>
            <h3>Symptoms Alignment</h3>
            <p>
            Quickly identify and input cholera symptoms and receive an informed guess for better diagnosis.
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="icon-wrapper">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <h3>Competence Quiz</h3>
            <p>
            Active recall is utilized after learning about cholera and proper hygiene and sanitation to maximize knowledge retention.
            </p>
          </div>
        </div>
        
      </div>
    </section>
    </main>
  </body>
</html>
