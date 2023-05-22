<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("connection/connect.php");

if(isset($_POST['submit'] ))
{
    if(empty($_POST['Firstname']) || // Vérification du fait qu'aucun des champs d'inscription ne soient laissés vides.
        empty($_POST['username']) ||
        empty($_POST['email']) ||
        empty($_POST['phone'])||
        empty($_POST['password'])||
        empty($_POST['cpassword']))
    {
        $message = "Tous les champs doivent être remplis !";
    }
    else
    {

        $check_username = mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
        $check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");


        if($_POST['password'] != $_POST['cpassword']){
            $message = "Les mots de passe ne correspondent pas entre eux.";
        }
        elseif(strlen($_POST['password']) < 6)
        {
            $message = "Votre mot de passe doit contenir au minimum 6 caractères.";
        }
        elseif(strlen($_POST['phone']) < 10)
        {
            $message = "Ce numéro de téléphone est invalide.";
        }

        elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $message = "Cet adresse email est invalide. Veuillez saisir une autre adresse email.";
        }
        elseif(mysqli_num_rows($check_username) > 0)
        {
            $message = 'Ce nom est déjà utilisé.';
        }

        elseif(mysqli_num_rows($check_email) > 0)
        {
            $message = 'Cet email est déjà utilisé.';
        }
        else
        {
            // Insertion des données de l'utilisateur dans la base de donnée
            $mql = "INSERT INTO users(Firstname,username,email,phone,password) VALUES('".$_POST['Firstname']."','".$_POST['username']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."')";

            mysqli_query($db, $mql);

            $success = "Votre compte a bien été créé ! <p>Vous allez être redirigé dans <span id='counter'>3</span> secondes.</p>
                <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                  location.href = 'connexion.php';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
              }
              setInterval(function(){ countdown(); },1000);
              </script>'";

            header("refresh:3;url=connexion.php");
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="https://zupimages.net/up/21/04/xogm.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>

<header>
    <div class="wrap-menu-header gradient1 trans-0-4">
        <div class="container h-full">
            <div class="wrap_header trans-0-3">
                <!-- Logo -->
                <div class="logo">
                    <a href="accueil.php">
                        <img src="https://zupimages.net/up/21/04/xogm.png" alt="IMG-LOGO" data-logofixed="images/icons/Fan-Mian.png">
                    </a>
                </div>

                <!-- Menu -->
                <div class="wrap_menu p-l-45 p-l-0-xl">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li>
                                <a href="accueil.php">Accueil</a>
                            </li>

                            <li>
                                <a href="menus.php">Menus</a>
                            </li>

                            <li>
                                <a href="galerie.php">Galerie</a>
                            </li>

                            <li>
                                <a href="commander.php">Commander en ligne</a>
                            </li>

                            <li>
                                <a href="contact.php">Contact</a>
                            </li>

                            <?php
                            if(empty($_SESSION["user_id"]))
                            {
                                // Si l'utilisateur est déconnecté
                                echo '<li><a href="connexion.php">CONNEXION</a></li>';
                            }
                            else
                            {
                                //Si l'utilisateur est connecté
                                echo '<li><a href="deconnexion.php">DECONNEXION</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
                <!-- Social -->
                <div class="social flex-w flex-l-m p-r-20">
                    <a href="https://www.tripadvisor.fr/LocationPhotoDirectLink-g187147-d3607167-i62042559-New_Asia-Paris_Ile_de_France.html"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a>

                    <button class="btn-show-sidebar m-l-33 trans-0-4"></button>
                </div>
            </div>
        </div>
    </div>
</header>

<aside class="sidebar trans-0-4">

    <button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

    <ul class="menu-sidebar p-t-95 p-b-70">
        <li class="t-center m-b-13">
            <a href="accueil.php" class="txt19">Accueil</a>
        </li>

        <li class="t-center m-b-13">
            <a href="menus.php" class="txt19">Menus</a>
        </li>

        <li class="t-center m-b-13">
            <a href="galerie.php" class="txt19">Galerie</a>
        </li>

        <li class="t-center m-b-13">
            <a href="commander.php" class="txt19">Commander en ligne</a>
        </li>

        <li class="t-center m-b-33">
            <a href="contact.php" class="txt19">Contact</a>
        </li>

        <div class="gallery-sidebar t-center p-l-60 p-r-60 p-b-40">
            <!-- - -->
            <h4 class="txt20 m-b-33">
                Galerie
            </h4>

            <!-- Galerie -->
            <div class="wrap-gallery-footer flex-w">
                <a class="item-gallery-footer wrap-pic-w" href="images/repas-1.jpg" data-lightbox="gallery-footer">
                    <img src="images/repas-1.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-footer wrap-pic-w" href="images/Repas-2.jpg" data-lightbox="gallery-footer">
                    <img src="images/Repas-2.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-footer wrap-pic-w" href="images/Repas-3.jpg" data-lightbox="gallery-footer">
                    <img src="images/Repas-3.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-footer wrap-pic-w" href="images/Boisson-1.jpg" data-lightbox="gallery-footer">
                    <img src="images/Boisson-1.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-footer wrap-pic-w" href="images/Repas-10.jpg" data-lightbox="gallery-footer">
                    <img src="images/Repas-10.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-footer wrap-pic-w" href="images/Boisson-2.jpg" data-lightbox="gallery-footer">
                    <img src="images/Boisson-2.jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-footer wrap-pic-w" href="images/Repas-7%20(1).jpg" data-lightbox="gallery-footer">
                    <img src="images/Repas-7%20(1).jpg" alt="GALLERY">
                </a>

                <a class="item-gallery-footer wrap-pic-w" href="images/Dessert-2%20(1).jpg" data-lightbox="gallery-footer">
                    <img src="images/Dessert-2%20(1).jpg" alt="GALLERY">
                </a>
            </div>
        </div>
</aside>

<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/6127.jpg);">
    <h2 class="tit6 t-center">
        Inscription
    </h2>
</section>

<section id="contact">    
    <div class="container-fluid">
        <div class="col-md-12 my-3 mx-auto w-50 h-75 p-5">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="text-uppercase">Inscription</h1>
                </div>
                <div class="card-body head-text">
                   <span style="color:black;">
                    <?php 
                      echo $message; 
                    ?>  
                  </span>
            
                  <span style="color:black;">
                    <?php
                      echo $success; 
                    ?>
                  </span>

                    <form action="" method="post">

                        <div class="input-group my-3 align-self-center">
                            <div class="input-group-prepend">
                            </div>
                            <input type="text"class="form-control form-control-lg" placeholder="Prénom" name="Firstname">
                        </div>

                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="Nom" name="username">
                      </div>

                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                          </div>
                          <input type="text" class="form-control form-control-lg" placeholder="Email" name="email">
                      </div>

                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                          </div>
                          <input type="password" class="form-control form-control-lg" placeholder="Mot de passe" name="password">
                      </div>

                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                          </div>
                          <input type="password" class="form-control form-control-lg" placeholder="Confirmation du mot de passe" name="cpassword">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                          </div>
                          <input type="text" id="phone" class="form-control form-control-lg" placeholder="Téléphone" name="phone">
                      </div>
<!------------------------------------->
                       <button type="submit" class="btn3 flex-c-m size13 txt11 trans-0-4" name="submit" value="register"><i class="far fa-hand-point-right mr-2"></i>Inscription</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!------------------------------------------------------------------------------------------------------------->

<footer class="bg1">
    <div class="container p-t-40 p-b-70">
        <div class="row">
            <div class="col-sm-6 col-md-4 p-t-50">
                <!-- - -->
                <h4 class="txt13 m-b-33">
                    Nous contacter
                </h4>

                <ul class="m-b-70">
                    <li class="txt14 m-b-14">
                        <i class="fa fa-map-marker fs-16 dis-inline-block size19" aria-hidden="true"></i>
                        42 Rue Cler, 75007 Paris
                    </li>

                    <li class="txt14 m-b-14">
                        <i class="fa fa-phone fs-16 dis-inline-block size19" aria-hidden="true"></i>
                        01 45 50 24 62
                    </li>

                    <li class="txt14 m-b-14">
                        <i class="fa fa-envelope fs-13 dis-inline-block size19" aria-hidden="true"></i>
                        rongjiedaichen@gmail.com
                    </li>
                </ul>

                <!-- - -->
                <h4 class="txt13 m-b-32">
                    Horaires d'ouvertures
                </h4>

                <ul>
                    <li class="txt14">
                        10h30 - 22h00
                    </li>

                    <li class="txt14">
                        Ouvert tous les jours sauf le Dimanche
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-md-4 p-t-50">
                <!-- - -->
                <h4 class="txt13 m-b-38">
                    Galerie
                </h4>

                <!-- Gallery footer -->
                <div class="wrap-gallery-footer flex-w">
                    <a class="item-gallery-footer wrap-pic-w" href="images/repas-1.jpg" data-lightbox="gallery-footer">
                        <img src="images/repas-1.jpg" alt="GALLERY">
                    </a>

                    <a class="item-gallery-footer wrap-pic-w" href="images/Repas-2.jpg" data-lightbox="gallery-footer">
                        <img src="images/Repas-2.jpg" alt="GALLERY">
                    </a>

                    <a class="item-gallery-footer wrap-pic-w" href="images/Repas-3.jpg" data-lightbox="gallery-footer">
                        <img src="images/Repas-3.jpg" alt="GALLERY">
                    </a>

                    <a class="item-gallery-footer wrap-pic-w" href="images/Boisson-1.jpg" data-lightbox="gallery-footer">
                        <img src="images/Boisson-1.jpg" alt="GALLERY">
                    </a>

                    <a class="item-gallery-footer wrap-pic-w" href="images/Repas-10.jpg" data-lightbox="gallery-footer">
                        <img src="images/Repas-10.jpg" alt="GALLERY">
                    </a>

                    <a class="item-gallery-footer wrap-pic-w" href="images/Boisson-2.jpg" data-lightbox="gallery-footer">
                        <img src="images/Boisson-2.jpg" alt="GALLERY">
                    </a>

                    <a class="item-gallery-footer wrap-pic-w" href="images/Repas-7%20(1).jpg" data-lightbox="gallery-footer">
                        <img src="images/Repas-7%20(1).jpg" alt="GALLERY">
                    </a>

                    <a class="item-gallery-footer wrap-pic-w" href="images/Dessert-2%20(1).jpg" data-lightbox="gallery-footer">
                        <img src="images/Dessert-2%20(1).jpg" alt="GALLERY">
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="end-footer bg2">
        <div class="container">
            <div class="flex-sb-m flex-w p-t-22 p-b-22">
                <div class="p-t-5 p-b-5">
                    <a href="https://www.tripadvisor.fr/LocationPhotoDirectLink-g187147-d3607167-i62042559-New_Asia-Paris_Ile_de_France.html" class="fs-15 c-white"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a>
                </div>

                <div class="txt17 p-r-20 p-t-5 p-b-5">
                    Copyright &copy; 2021 All rights reserved
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>



<!--===============================================================================================-->
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/parallax100/parallax100.js"></script>
<script type="text/javascript">
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>


</body>
</html>