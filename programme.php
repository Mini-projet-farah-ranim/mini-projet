<?php
$cin = $_GET['cin'];

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

// Requête pour récupérer l'utilisateur avec le CIN et le mot de passe haché
$sql = "SELECT * FROM chef WHERE cin = :cin";
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

    <title>Chef département</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="logo.png" />

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
    <script> applyFilter() {
    var selectedFiliere = document.getElementById('filiere').value;
    console.log("Selected filiere:", selectedFiliere); // Debugging output
    document.getElementById('filter_filiere').value = selectedFiliere;
    document.getElementById('filterForm').submit();
}
</script>
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
            <div class="menu-item active">
              <a href="chef.php?cin=<?php echo $_GET['cin']; ?>&nom=<?php echo $user['nom']; ?>"  class="menu-link">
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
                href="programme.php?cin=<?php echo $_GET['cin']; ?>" 
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Calendar">Programmes d'études</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="gestionEnseignant.php?cin=<?php echo $_GET['cin']; ?>" 
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Calendar">Gestion enseignants</div>
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
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="uploads/<?php echo $user['photo'] ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                    <a class="dropdown-item" href="profil.php?cin=<?php echo $_GET['cin']; ?>">

                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="uploads/<?php echo $user['photo'] ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block">
                               <?php echo $user['nom'] ?>
                            </span>
                            <small class="text-muted">chef</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Bonjour,<?php echo $user['nom'] ?> </h5>
                          <p class="mb-4">
                          Bienvenue sur le site officiel d'ISSAT Sousse
                          </p>

                          <a href="news.php?cin=<?php echo $_GET['cin']; ?>" class="btn btn-sm btn-outline-primary">Voir actualités</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-7 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-medium d-block mb-1">Compte Rendu</span>
                          <h3 class="card-title mb-2">3</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span>Cours</span>
                          <h3 class="card-title text-nowrap mb-1">10</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
  <div class="card">
    <div class="row row-bordered g-0">
      <div class="col-md-18">
      <div class="card-body">
       

    <h1>Programme d'études:</h1>

     <!-- Button to filter by filiere -->
     <form action="" method="GET">
     <input type="hidden" name="cin" value="<?php echo $_GET['cin']; ?>">
    <input type="hidden" name="nom" value="<?php echo $_GET['nom']; ?>">
        <label for="filiere">Filter by Filiere:</label>
        <select name="filiere" id="filiere">
            <option value="">All</option>
            <!-- Add options dynamically from database -->
            <?php
            // Connect to the database
            $db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

            // Fetch distinct filiere values from the programme table
            $sql = "SELECT DISTINCT filiere FROM programme";
            $stmt = $db->query($sql);
            $filiereData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Output options for each filiere
            foreach ($filiereData as $filiere) {
                $selected = ($_GET['filiere'] == $filiere['filiere']) ? 'selected' : '';
                echo "<option value=\"" . htmlspecialchars($filiere['filiere']) . "\" $selected>" . htmlspecialchars($filiere['filiere']) . "</option>";
            }
            ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Display table of programme data -->
    <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th>Filiere</th>
                <th>Cours</th>
                <th>Enseignant</th>
                <th>Date Ajout</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database
            $db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

            // Prepare SQL query to fetch programme data
            $sql = "SELECT filiere, cours, enseignant, date_ajout FROM programme";

            // If filiere filter is applied, update the SQL query
            if (isset($_GET['filiere']) && !empty($_GET['filiere'])) {
                $sql .= " WHERE filiere = :filiere";
            }

            // Prepare and execute the SQL query
            $stmt = $db->prepare($sql);

            // If filiere filter is applied, bind the parameter and execute
            if (isset($_GET['filiere']) && !empty($_GET['filiere'])) {
                $stmt->execute(['filiere' => $_GET['filiere']]);
            } else {
                $stmt->execute();
            }

            // Fetch and display the results in the table
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['filiere']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cours']) . "</td>";
                echo "<td>" . htmlspecialchars($row['enseignant']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date_ajout']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
   

      </div>
    </div>
  </div>
</div>
                


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
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
