<!DOCTYPE html>
  <!--
    Part of this template was developed by https://blackrockdigital.github.io 
  -->
<html lang="en" class="gr__blackrockdigital_github_io"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Secure Coding CTF</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://hackerthemes.com/bootstrap-themes/demo/theme-machine/neon-glow/css/bootstrap4-neon-glow.min.css" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style>
      * {
   box-sizing: border-box;
  }
  *:before,
  *:after {
   box-sizing: border-box;
  }
  html,
  body {
   height: 100%;
   position: relative;
  }
  #main-container {
   min-height: 100vh; /* will cover the 100% of viewport */
   overflow: hidden;
   display: block;
   position: relative;
   padding-bottom: 100px; /* height of your footer */
  }
  footer {
   position: absolute;
   bottom: 0;
   width: 100%;
  }
    </style>
</head>
  </head>

  <body data-gr-c-s-loaded="true">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">Break it until you make IT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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

    <div id="main-container">
    <header class="masthead text-center text-white" style="padding-top: 6.5em; padding-bottom: 2.5em;"></header>
      <div class="masthead-content">
        <div class="container">
          <h1 class="masthead-heading mb-0" style="text-align:center;">Secure Coding CTF - The Winter Challenge</h1>
        </div>
      </div>
    </header>


    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 order-lg-2">
            <div class="p-5">
              <blockquote style="padding-top: 20px;">
              <p>Programming isn't about what you know; it's about what you can figure out.</p>
              <footer>&mdash; <cite>Chris Pine</cite></footer>
              </blockquote>
            </div>
          </div>
          <div class="col-lg-8 order-lg-1">
            <div class="p-5">
              <h2 class="display-4" style="color: #812990;">Client Destroyer</h2>
              <p>To receive the flag you have to enter correct password</p>
              <form method="POST" onsubmit="return validate()">
                <div class="form-group">
                  <textarea name="password" id="in" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </form>
              <?php
              if(isset($_POST['password'])){
                  $password=$_POST['password'];
                  if($password == 'Hel2.4dnx21j.sl/dfsz'){
                    include_once "flag.php"; 
                    echo $flag;
                }else{
                  echo "Sorry, the wrong password";
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5">
    <div class="container">
      <p class="m-0 text-center">Secure Coding CTF - The Winter Challenge&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-dragon"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Because We Care</p>
      <p class="m-0 text-center">Deployed by<br>Vitaly Ford && Alexandr Chebatarev</p>
    </div>
    <!-- /.container -->
  </footer>
            </div>
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    //const button = document.querySelector("#sub");
    //document.addEventListener(button, validate);
   function validate(){
     let input = document.querySelector("#in").value;
     console.log("I am here")
     input = input.replaceAll("." , "");

     if (input != "Hel2.4dnx21j.sl/dfsz"){
       alert("Given input is not correct, try again")
       return false;
     }
     return true;
   }
    </script>

</body>
