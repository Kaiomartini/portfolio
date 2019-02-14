<?php
require_once 'autoload.php';
?>
<!DOCTYPE html>
<html class="no-js" lang="pt">
<head>
  <meta charset="utf-8">
  <title>Portifolio</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
  <link rel="stylesheet" href="thumbnail-gallery.css">

  <!-- Favicons -->
  <link href="img/logo.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">




</head>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#hero">
          <img src="Logo.png" alt="" title="" /></img>
        </a>
        
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active">
            <a href="#hero">Pagina</a>
          </li>

          <li>
            <a href="#services">metas</a>
          </li>
          <li>
            <a href="#portfolio">Protifolio</a>
          </li>
          
          <li>
            <a href="#contact">Contato</a>
          </li>

        </ul>
        </li>

        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  <section id="hero">
    <div class="hero-container">

    </div>
  </section>
  <!-- #hero -->

  <main id="main">

    <!--==========================
      Services Section
    ============================-->
    <section id="services">
      <div class="container wow fadeIn">
        <div class="section-header">
          <h3 class="section-title"></h3>
          
        </div>
        <div class="row">
          
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
            <div class="box">
              <div class="icon">
                <a href="">
                  <i class="fa fa-bar-chart"></i>
                </a>
              </div>
              <h4 class="title">
                <a href="">MISSÃO</a>
              </h4>
              <p class="description">Entregar este trabalho no ultimo minuto e conseguir passar na materia sem exame ou sub.</p>
            </div>
          </div>
         

          
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
            <div class="box">
              <div class="icon">
                <a href="">
                  <i class="fa fa-road"></i>
                </a>
              </div>
              <h4 class="title">
                <a href="">VISÃO</a>
              </h4>
              <p class="description">Acreditar que serpre vai dar tempo de fazer na ultima hora</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
            <div class="box">
              <div class="icon">
                <a href="">
                  <i class="fa fa-shopping-bag"></i>
                </a>
              </div>
              <h4 class="title">
                <a href="">VALORES</a>
              </h4>
              <p class="description"><br/>
                •	Deus em primeiro lugar;
                <br/>•	Trabalhar merlhor sobre preção;
                <br/>•	Contradizer os profesores que não acreditavão;
                <br/>•	De vagar e sempre;                
                <br/>•	Qualidade top;
                
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- #services -->

    <!--==========================
    Call To Action Section
    ============================-->
    <section id="call-to-action">
      <div class="container wow fadeIn">
        <div class="row">
          <div class="col-lg-12 text-center text-lg-left">
              <h3 class="cta-title">Sobre</h3>
            
              <p  class="cta-text">Este site foi elaborado por um aluno de sistemas para internet tem como finaliade a exibição de um portifolio de trabalhos academicos como sites, seminarios, artigos, artes visuais entre outros. </p>
      
          </div>
          
        </div>

      </div>
    </section>
    <!-- #call-to-action -->

    <!--==========================
      Portfolio Section
    ============================-->
    <section id="portfolio">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Planos</h3>
          
        </div>
        <div class="row">

          <div class="col-lg-12">
            <ul id="portfolio-flters">
              
              <?php
                $categorias = (new \controller\CategoriaController())->getTopFive();
            if ($categorias) {
                echo "<li class=\"active\" data-filter=\"*\">Todos</li>";
            } else {
                echo 'Nenhum projeto à exibir.';
            }

            foreach ($categorias as $categoria) {
                ?>
                <li data-filter=".<?= $categoria->getIdCategoria() ?>"><?= $categoria->getNomeCategoria() ?></li>
                <?php
            }
            ?>
        </ul>
              
            </ul>
          </div>
        </div>
        <div class="tz-gallery">

          <div class="row">

            
                                <?php
            foreach ($categorias as $categoria) {
                $projetos = (new controller\ProjetoController())->getTopFiveByCategory($categoria);
                foreach ($projetos as $projeto) {
                   
            echo "<div class=\"col-sm-12 col-md-4 portfolio-item all {$categoria->getIdCategoria()}\">
            <div class=\"thumbnail\"> 
            <a class=\"\" href=\"".str_replace('../', '', $projeto->getImagemProjeto())."\">
                <img src=\"".str_replace('../', '', $projeto->getImagemProjeto())."\">                
              </a>
                <div class=\"caption\">
                    <h3>{$projeto->getNomeProjeto()}</h3>
                    <p>{$categoria->getNomeCategoria()}</p>
                </div>
            </div>
            </div>";
                }
            }

            ?>
                               
                                

          </div>

        </div>
      </div>

      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
      <script>
        baguetteBox.run('.tz-gallery');
      </script>

      </div>

      </div>
    </section>
    <!-- #portfolio -->

  
    <!--==========================
      Contact Section
    ============================-->
    <section id="contact">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Contato</h3>
          
        </div>
      </div>

      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3729.65221288156!2d-49.38387844970855!3d-20.805353471427768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94bdad43ea29313d%3A0xd9b7afee31b8d8f5!2sR.+Pedro+Amaral%2C+2456+-+Boa+Vista%2C+S%C3%A3o+Jos%C3%A9+do+Rio+Preto+-+SP%2C+15010-010!5e0!3m2!1spt-BR!2sbr!4v1536529447170" width="100%" height="300" frameborder="0" style="border:0; margin: 10px 0 20px 0" allowfullscreen></iframe>

      <div class="container wow fadeInUp">
        <div class="row justify-content-center">

          <div class="col-lg-4 col-md-5">

            <div class="info">
              <div>
                <i class="fa fa-map-marker"></i>
                <p>Rua Pedro Amaral 2456, Parque Industrial
                  <br>São José do Rio Preto- SP</p>
              </div>

              <div>
                <i class="fa fa-envelope"></i>
                <p>caiomartiniaq@fatec.sp.gov.br</p>
              </div>

              <div>
                <i class="fa fa-phone"></i>
                <p>(17) 99269-2014 </p>
              </div>
            </div>

            <div class="social-links">
              <a href="#" class="twitter">
                <i class="fa fa-twitter"></i>
              </a>
              <a href="#" class="facebook">
                <i class="fa fa-facebook"></i>
              </a>
              <a href="#" class="instagram">
                <i class="fa fa-instagram"></i>
              </a>
              <a href="#" class="google-plus">
                <i class="fa fa-google-plus"></i>
              </a>
              <a href="#" class="linkedin">
                <i class="fa fa-linkedin"></i>
              </a>
            </div>

          </div>

          
          </div>

        </div>

      </div>
    </section>
    <!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Desenvolvedor
        <strong>Caio martini</strong>. Protifolio
      </div>
      <div class="credits">
          </div>
    </div>
  </footer>
  <!-- #footer -->

  <a href="#" class="back-to-top">
    <i class="fa fa-chevron-up"></i>
  </a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>

  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>

</html>