<?php

// Définir les variables
$cin = $_GET['cin'];

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

// Requête pour récupérer l'utilisateur avec le CIN saisi
$sql = "SELECT * FROM etudiant WHERE cin = :cin";
$stmt = $db->prepare($sql);
$stmt->execute(['cin' => $cin]);
// Vérifier si l'utilisateur existe
$user = $stmt->fetch();

?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Etudiant</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <img style=" margin-left:10px; width:150px;" src="logo.png">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <div class="menu-item">
              <a href="etudiant.php?cin=<?php echo $_GET['cin']; ?>&nom=<?php echo $user['nom']; ?>"  class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboard</div>
              </a>
              
            </div>
            <li class="menu-item">
              <a
              href="news.php?cin=<?php echo $_GET['cin']; ?>"                
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div data-i18n="Calendar">Actualités</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="emploi.php?cin=<?php echo $_GET['cin']; ?>" 
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Calendar">Emploi du temps</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="groupe.php?cin=<?php echo $_GET['cin']; ?>" 
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Calendar">Liste des groupes</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="cours.php?cin=<?php echo $_GET['cin']; ?>" 
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Calendar">Cours</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="note.php?cin=<?php echo $_GET['cin']; ?>" 
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-file-blank"></i>
                <div data-i18n="Calendar">Notes</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="exams.php?cin=<?php echo $_GET['cin']; ?>" 
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Calendar">Calendrier des examens</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="event.php?cin=<?php echo $_GET['cin']; ?>" 
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Calendar">Evénements</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="reclamation.php?cin=<?php echo $_GET['cin']; ?>" 
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-edit"></i>
                <div data-i18n="Calendar">Réclamations</div>
              </a>
            </li>
            <!-- Pages -->
            
            <li class="menu-item">
              <a
                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-calendar.html"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Calendar">Logout</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
         

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>Profil</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="profilset.php?cin=<?php echo $_GET['cin']; ?>"
                        ><i class="bx bx-wrench me-1"></i> Paramètres</a
                      >
                    </li>
                    
                  </ul>
                  <div class="card mb-4">
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="uploads/<?php echo $user['photo'] ?>"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar" />
                        <div class="button-wrapper">
                          <h1><?php echo $user['nom'] ?> <?php echo $user['prenom'] ?></h1>
                          <p class="text-muted mb-0">Etudiant</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="formAccountSettings">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nom</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $user['nom'] ?>" readonly />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Prénom</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $user['prenom'] ?>" readonly />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $user['email'] ?>" readonly />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Numero de téléphone</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">TN (+216)</span>
                              <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $user['telephone'] ?>" readonly />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Groupe</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $user['groupe'] ?>" readonly />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Filière</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $user['filiere'] ?>" readonly />
                          </div>
                          
                        </div>
                        
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- / Content -->

           
            <div class="content-backdrop fade"></div>
          </div>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
