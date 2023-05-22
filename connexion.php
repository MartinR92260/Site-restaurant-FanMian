<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();


?>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Connexion</title>

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

<?php

include ("connection/connect.php");
error_reporting(0);
session_start();
if(isset($_POST['submit']))
{
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $firstname1 = $_POST['firstname'];

    if(!empty($_POST["submit"]))   		// Si les champs de connexion n'étaient pas vide
    {
        $loginquery ="SELECT * FROM users WHERE username='$username' && Firstname='$firstname1' && password='".md5($password)."'"; //Sélection de l'utilisateur dans la base de donnée
        $result=mysqli_query($db, $loginquery);
        $row=mysqli_fetch_array($result);

        if(is_array($row))  // Si l'utilisateur a été trouvée
        {
            $_SESSION["user_id"] = $row['Firstname'];
            header("location: commander.php"); // Redirection
        }
        else
        {
            $message = "Connexion impossible. Veuillez vérifier que les informations saisies sont correctes."; // Si l'utilisateur n'a pas été trouvé
        }
    }
}
?>


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

<!------------------------------------------------------------------------------------------------------------->
<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/6127.jpg);">
    <h2 class="tit6 t-center">
       Connexion
    </h2>
</section>
  
<section id="contact">    
    <div class="container-fluid">
        <div class="col-md-12 my-3 mx-auto w-50 h-75 p-5">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="text-uppercase">Veuillez vous connecter</h1>
                </div>
                <div class="card-body head-text">
				          	<span style="color:black;">
        						<?php 
        							echo $message; 
        						?>	
          					</span>

          					</span>

                    <form action="" method="post">

                        <div class="input-group my-3 align-self-center">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                              </span>
                            </div>
                            <input type="text"class="form-control form-control-lg" placeholder="Prénom" name="firstname">
                        </div>

                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                              </span>
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="Nom" name="user">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                              </span>
                          </div>
                          <input type="password" class="form-control form-control-lg" placeholder="Mot de passe" name="pass">
                      </div>
<!------------------------------------->
                       <button type="submit" class="btn3 flex-c-m size13 txt11 trans-0-4" name="submit" value="login">Connexion</button>

                </div>
                <div class="flex-col-c-m">
                <a href="inscription.php" class="btn3 flex-c-m size13 txt11 trans-0-4">
                    Créer un nouveau compte
                </a>
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