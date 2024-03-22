<header> 
 <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="header_logo d-flex justify-content-center">
        <a href="/DOCUMENT_ROOT/index.php?site=homepage">
            <img src="/DOCUMENT_ROOT/pictures/wohlfuehloaseresortspablack.png" alt="Wohlfühloase Logo" id="navbar-image">
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item-divider d-none d-lg-block">
        <img src="/DOCUMENT_ROOT/pictures/dash-divider.png" alt="" id="navbar-social">
          <span class="nav-link">
            <span></span>
          </span>
        </li>
        <li class="nav-item-divider d-none d-lg-block">
          <span class="nav-link">
            <span></span>
          </span>
        </li>
        <li class="nav-item">
          <a href="https://github.com/SofiaHKG/WohlfuehlOase/" class="nav-link" target="_blank">
            <img src="/DOCUMENT_ROOT/pictures/github.svg" alt="Github Logo" id="navbar-social-logo">
            <i class="fab fa-github"></i> 
            <span class="d-xl-none d-lg-none ml-2">
              Github
            </span>
          </a>
        </li>
        <li class="nav-item-divider d-none d-lg-block">
          <span class="nav-link">
            <span></span>
          </span>
        </li>
        <li class="nav-item">
          <a href="https://youtu.be/aZxxYgiLdLs" class="nav-link" target="_blank">
          <img src="/DOCUMENT_ROOT/pictures/youtube.svg" alt="YouTube Logo" id="navbar-social-logo">
            <i class="fab fa-youtube"></i> 
            <span class="d-xl-none d-lg-none ml-2">
              YouTube
            </span>
          </a>
        </li>
        </li>
        <li class="nav-item-divider d-none d-lg-block">
          <span class="nav-link">
            <span></span>
          </span>
        </li>
        <li class="nav-item">
          <a href="https://cloud.technikum-wien.at/s/QQEzYR5sCtzSJ2n" class="nav-link" target="_blank">
          <img src="/DOCUMENT_ROOT/pictures/cloud-fill.svg" alt="Cloud Logo" id="navbar-social-logo">
            <i class="fab fa-cloud"></i> 
            <span class="d-xl-none d-lg-none ml-2">
              Cloud
            </span>
          </a>
        </li>
        <li class="nav-item-divider d-none d-lg-block">
          <span class="nav-link">
            <span></span>
          </span>
        </li>
        <li class="nav-item-divider d-none d-lg-block">
        <img src="/DOCUMENT_ROOT/pictures/dash-divider.png" alt="" id="navbar-social">
          <span class="nav-link">
            <span></span>
          </span>
        </li>
        <li class="nav-item-divider d-none d-lg-block">
          <span class="nav-link">
            <span></span>
          </span>
        </li>
      </ul>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link navigation-link" href="/DOCUMENT_ROOT/index.php?site=gebucht">Reservierungen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navigation-link" href="/DOCUMENT_ROOT/index.php?site=news">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navigation-link" href="/DOCUMENT_ROOT/index.php?site=CMS">CMS</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link navigation-link" href="/DOCUMENT_ROOT/index.php?site=users">Alle User</a>
        </li>
      </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <form action="index.php?site=homepage" method="post">
            <input hidden name="logOut" value="logOut">
            <button type="submit" class="button-text">Abmelden</button>
          </form>
        </li>
        <li class="nav-item">
            <a class="nav-link">Hallo, <?php echo $_SESSION["usernameLoggedIn"]?>!</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
</header>
