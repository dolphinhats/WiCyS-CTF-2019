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
    <link href="https://bootswatch.com/4/lumen/bootstrap.css" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  </head>

  <body data-gr-c-s-loaded="true">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">Break it until you make it</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="https://twitter.com/WiCySorg" target="_blank">Twitter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.instagram.com/wicys/" target="_blank">Instagram</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.facebook.com/wicys" target="_blank">Facebook</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead text-center text-white" style="padding-top: 6.5em; padding-bottom: 2.5em; background: linear-gradient(0deg,#C2CEAF 0,#B1D34A 100%);">
      <div class="masthead-content">
        <div class="container">
          <h1 class="masthead-heading mb-0" style="color: #231F20;">Steal The Steel CTF</h1>
          <h2 class="masthead-subheading mb-0">Will Rock Your Socks Off</h2>
        </div>
      </div>
      <div class="bg-circle-1 bg-circle" style="background: linear-gradient(0deg,#B1D34A 0,#C2CEAF 100%);"></div>
      <div class="bg-circle-2 bg-circle" style="background: linear-gradient(0deg,#B1D34A 0,#C2CEAF 100%);"></div>
      <div class="bg-circle-3 bg-circle" style="background: linear-gradient(0deg,#B1D34A 0,#C2CEAF 100%);"></div>
      <div class="bg-circle-4 bg-circle" style="background: linear-gradient(0deg,#B1D34A 0,#C2CEAF 100%);"></div>
    </header>

    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 order-lg-2">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="https://raw.githubusercontent.com/StartBootstrap/startbootstrap-one-page-wonder/master/img/01.jpg" alt="">
              <blockquote style="padding-top: 20px;">
                <p>Programming isn't about what you know; it's about what you can figure out.</p>
                <footer>&mdash; <cite>Chris Pine</cite></footer>
              </blockquote>
            </div>
          </div>
          <div class="col-lg-8 order-lg-1">
            <div class="p-5">
              <h2 class="display-4" style="color: #812990;">Compiling Trojan Candy 2... JK :)</h2>


              <?php
              if(!ini_get("file_uploads")){echo "<font color='red'>There is an issue with this flag. Contact CTF admins.</font>";}
              
              if(isset($_FILES["fileToUpload"]["name"])){
              
                $fileName=$_FILES["fileToUpload"]["name"];
                $target_dir = "./images/";
                $target_file = $target_dir . basename($fileName);
                
                
                $name=explode(".",$fileName);
                $newName=time() . '.' . end($name);
                //spaces cause issues with img tags
                $name=str_replace(" ","_",$name);
                
                
                //check file magic
                $type = mime_content_type($_FILES["fileToUpload"]["tmp_name"]);
                if(($type == "image/jpeg" or $type == "image/png" or $type == "image/gif")){
                  //   ¯\_(ツ)_/¯ 
                }
                else {
                  die("GO AWAY HACKER! Type: <b>".$type."</b> is not allowed!");
                }
                
                
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$name[0]."_".$newName)) {
                        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br/>";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
              
              }
              ?>

              <h3>Welcome to my image upload server! Please be nice!</h3>
              <h4><font color='green'>I had to refresh my whole server after it was hacked!<br/>I don't know how, but I got my friend from Webapp class who is super good at PHP to implement another security check. Good luck hackers!</font></h4>
              <form  method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Select image to upload:</label>
                </div>
                <div class="form-group">
                  <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="form-group">
                  <input type="submit" value="Upload Image" name="submit">
                </div>
              </form>
              <a href="gallery.php">Click here to go to the gallery</a>

              
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