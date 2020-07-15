  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Mon Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" name="recherche" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ml-auto">
        <?php if($getid!=""){;?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="r.php">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="r.php">Mon file d'Actualité</a>
          </li>
        <?php } else {?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="register.php">S'inscrire</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="login.php">Se connecter</a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
