<!DOCTYPE html>
  <!--
    Part of this template was developed by https://blackrockdigital.github.io 
  -->
<html lang="en" class="gr__blackrockdigital_github_io"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Steal The Steel CTF</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://hackerthemes.com/bootstrap-themes/demo/theme-machine/neon-glow/css/bootstrap4-neon-glow.min.css" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  </head>

  <body data-gr-c-s-loaded="true">

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html"><img style="width: 100px"src="https://www.cyberstudents.org/wp-content/uploads/2016/01/NCC-NCSA-Logo-1.svg" alt=""></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="https://twitter.com/CyberStudents" target="_blank">Twitter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.linkedin.com/groups/8477102//" target="_blank">Linkedin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.facebook.com/CyberStudents.org/s" target="_blank">Facebook</a>
            </li>
          </ul>
        </div>
    </div>
  </nav>

    <header class="masthead text-center" style="padding-top: 6.5em; padding-bottom: 2.5em;">
      <div class="masthead-content">
        <div class="container">
          <h1 class="masthead-heading mb-0" style="color: #231F20;">Secure Coding CTF - The Winter Challenge</h1>
          <!-- <h2 class="masthead-subheading mb-0"></h2> -->
        </div>
      </div>
    </header>

    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 order-lg-2">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="https://raw.githubusercontent.com/StartBootstrap/startbootstrap-one-page-wonder/master/img/01.jpg" alt="">
              <blockquote style="padding-top: 20px;">
                <p>Good code is its own best documentation.</p>
                <footer>&mdash; <cite>Steve McConnell</cite></footer>
              </blockquote>
            </div>
          </div>
          <div class="col-lg-8 order-lg-1">
            <div class="p-5">
              <h2 class="display-4" style="color: #812990;">Compiling Juggling 2... JK :)</h2>


              <?php
              require "settings.php";
              
              if (isset($_GET['password'])) {

                if(strcmp($_GET['password'],$actualPass)==0)
                {
                  echo $flag;
                }
                else
                {
                  echo "<h2 class='display-4' style='color: #628FFF;'>Nope</h2>";
                }

              }
              ?>

              <h3>This site is password protected!</h3>
              <!-- Hint: no sql is needed... -->
              <form method='get'>
                <div class='form-group'>
                  <label>Password:</label><br>
                </div>
                <div class='form-group'>
                  <input type='text' name='password' id='password'><br>
                </div>
                <div class='form-group'>
                  <button class='btn btn-primary' type='submit'>Submit</button>
                </div>
              </form>

              
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Steal The Steal CTF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-dragon"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Because We Care</p>
        <p class="m-0 text-center text-white">Developed by<br>Amela Gjishti | Daniel Tyler | Konstantin Menako | Vitaly Ford</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body><span class="gr__tooltip"><span class="gr__tooltip-content"></span><i class="gr__tooltip-logo"></i><span class="gr__triangle"></span></span></html>