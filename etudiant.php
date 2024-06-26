<?php
$cin = "111";

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

// Requête pour récupérer l'utilisateur avec le CIN et le mot de passe haché
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
    <link rel="icon" type="image/x-icon" href="logo.png" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0"
    />
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
body {
  background-color: #bdc3c7;
  font-family: 'Poppins', sans-serif;
}
.chatbot__button {
  position: fixed;
  bottom: 35px;
  right: 40px;
  width: 50px;
  height: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #227ebb;
  color: #f3f7f8;
  border: none;
  border-radius: 50%;
  outline: none;
  cursor: pointer;
}
.chatbot__button span {
  position: absolute;
}
.show-chatbot .chatbot__button span:first-child,
.chatbot__button span:last-child {
  opacity: 0;
}
.show-chatbot .chatbot__button span:last-child {
  opacity: 1;
}
.chatbot {
  position: fixed;
  bottom: 100px;
  right: 40px;
  width: 350px;
  background-color: #f3f7f8;
  border-radius: 15px;
  box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1) 0 32px 64px -48px rgba(0, 0, 0, 0.5);
  transform: scale(0.5);
  transition: transform 0.3s ease;
  overflow: hidden;
  opacity: 0;
  pointer-events: none;
}
.show-chatbot .chatbot {
  opacity: 1;
  pointer-events: auto;
  transform: scale(1);
}
.chatbot__header {
  position: relative;
  background-color: #227ebb;
  text-align: center;
  padding: 16px 0;
}
.chatbot__header span {
  display: none;
  position: absolute;
  top: 50%;
  right: 20px;
  color: #202020;
  transform: translateY(-50%);
  cursor: pointer;
}
.chatbox__title {
  font-size: 1.4rem;
  color: #f3f7f8;
}
.chatbot__box {
  height: 350px;
  overflow-y: auto;
  padding: 30px 20px 100px;
  
}
.chatbot__chat {
  display: flex;
}
.chatbot__chat p {
  max-width: 75%;
  font-size: 0.95rem;
  white-space: pre-wrap;
  color: #202020;
  background-color: #019ef9;
  border-radius: 10px 10px 0 10px;
  padding: 12px 16px;
}
.chatbot__chat p.error {
  color: #721c24;
  background: #f8d7da;
}
.incoming p {
  color: #202020;
  background: #bdc3c7;
  border-radius: 10px 10px 10px 0;
}
.incoming span {
  width: 32px;
  height: 32px;
  line-height: 32px;
  color: #f3f7f8;
  background-color: #227ebb;
  border-radius: 4px;
  text-align: center;
  align-self: flex-end;
  margin: 0 10px 7px 0;
}
.outgoing {
  justify-content: flex-end;
  margin: 20px 0;
}
.incoming {
  margin: 20px 0;
}
.chatbot__input-box {
  position: absolute;
  bottom: 0;
  width: 100%;
  display: flex;
  gap: 5px;
  align-items: center;
  border-top: 1px solid #227ebb;
  background: #f3f7f8;
  padding: 5px 10px;
}
.chatbot__textarea {
  width: 100%;
  min-height: 55px;
  max-height: 180px;
  font-size: 0.95rem;
  padding: 16px 15px 16px 0;
  color: #202020;
  border: none;
  outline: none;
  resize: none;
  background: transparent;
}
.chatbot__textarea::placeholder {
  font-family: 'Poppins', sans-serif;
}
.chatbot__input-box span {
  font-size: 1.75rem;
  color: #202020;
  cursor: pointer;
  visibility: hidden;
}
.chatbot__textarea:valid ~ span {
  visibility: visible;
}

@media (max-width: 490px) {
  .chatbot {
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    border-radius: 0;
  }
  .chatbot__box {
    height: 90%;
  }
  .chatbot__header span {
    display: inline;
  }
}


    </style>
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
            <div class="menu-item active">
              <!-- <a href="etudiant.php?cin=<?php ////echo $_GET['cin']; ?>&nom=<?php ////echo $user['nom']; ?>"  class="menu-link"> -->
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
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Calendar">Liste des groupes</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="cours.php?cin=<?php echo $_GET['cin']; ?>" 
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Calendar">Cours</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="note.php?cin=<?php echo $_GET['cin']; ?>" 
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-file-blank"></i>
                <div data-i18n="Calendar">Notes</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="exams.php?cin=<?php echo $_GET['cin']; ?>" 
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Calendar">Calendrier des examens</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="event.php?cin=<?php echo $_GET['cin']; ?>" 
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
                href="home.php"
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
                            <small class="text-muted">Etudiant</small>
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
                          <h5 class="card-title text-primary">Bonjour,<?php echo $_GET['nom'] ?> </h5>
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
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Présence</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                            <div class="dropdown">
                              <button
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="growthReportId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Semestre 1
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                <a class="dropdown-item" href="javascript:void(0);">Semestre 1</a>
                                <a class="dropdown-item" href="javascript:void(0);">Semestre 2</a>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="growthChart"></div>
                        <button class="chatbot__button">
                        <span class="material-symbols-outlined">mode_comment</span>
                        <span class="material-symbols-outlined">close</span>
                      </button>
                      <div class="chatbot">
                        <div class="chatbot__header">
                          <h3 class="chatbox__title">Chatbot</h3>
                          <span class="material-symbols-outlined">close</span>
                        </div>
                        <ul class="chatbot__box">
                          <li class="chatbot__chat incoming">
                            <span class="material-symbols-outlined">smart_toy</span>
                            <p>Hi there. How can I help you today?</p>
                          </li>
                          <li class="chatbot__chat outgoing">
                            <p>...</p>
                          </li>
                        </ul>
                        <div class="chatbot__input-box">
                          <textarea
                            class="chatbot__textarea"
                            placeholder="Enter a message..."
                            required
                          ></textarea>
                          <input type="file" id="thefile">
                          <span id="fileName"></span>
                          <span id="send-btn" class="material-symbols-outlined">send</span>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
            <!-- / Content -->

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
    <script>
      const chatbotToggle = document.querySelector('.chatbot__button');
      const sendChatBtn = document.querySelector('.chatbot__input-box span');
      const chatInput = document.querySelector('.chatbot__textarea');
      const chatBox = document.querySelector('.chatbot__box');
      const chatbotCloseBtn = document.querySelector('.chatbot__header span');
      const fileUpload = document.getElementById('thefile');
      const fileNameElement = document.getElementById('fileName');
      


let userMessage;
const inputInitHeight = chatInput.scrollHeight;


const createChatLi = (message, className) => {
  const chatLi = document.createElement('li');
  chatLi.classList.add('chatbot__chat', className);
  let chatContent =
    className === 'outgoing'
      ? `<p></p>`
      : `<span class="material-symbols-outlined">smart_toy</span> <p></p>`;
  chatLi.innerHTML = chatContent;
  chatLi.querySelector('p').textContent = message;
  return chatLi;
};

const generateResponse = async (incomingChatLi) => {
    const API_URL = 'https://0574-35-227-137-171.ngrok-free.app/upload'; // Update with your server's URL
    const messageElement = incomingChatLi.querySelector('p');
    const file = fileUpload.files[0]; // Retrieve the uploaded file
    const reader = new FileReader();

    reader.onload = async function(event) {
        const fileContent = event.target.result;
        //console.log(fileContent)
        let filecont = atob(fileContent.split(',')[1]);

        const fileData = {
          context: userMessage.toString(),
          question: filecont.toString()
        };
        console.log(fileData);

        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Send as JSON
            },
            body: JSON.stringify(fileData), // Encode as JSON string
        };

        try {
            const response = await fetch(API_URL, requestOptions);
            if (!response.ok) {
                throw new Error('Failed to upload file');
            }
            console.log(response)
            const data = await response.json();
            console.log(data);
            messageElement.textContent = data.result;
        } catch (error) {
            messageElement.classList.add('error');
            messageElement.textContent = 'Oops! Please try again!';
            console.error(error);
        } finally {
            chatBox.scrollTo(0, chatBox.scrollHeight);
        }
    };

    reader.readAsDataURL(file); // Read the file content as Data URL (Base64)
};


const handleChat = () => {
  userMessage = chatInput.value.trim();
  if (!userMessage) return;
  chatInput.value = '';
  chatInput.style.height = `${inputInitHeight}px`;

  chatBox.appendChild(createChatLi(userMessage, 'outgoing'));
  chatBox.scrollTo(0, chatBox.scrollHeight);

  setTimeout(() => {
    const incomingChatLi = createChatLi('Thinking...', 'incoming');
    chatBox.appendChild(incomingChatLi);
    chatBox.scrollTo(0, chatBox.scrollHeight);
    generateResponse(incomingChatLi);
  }, 600);
};

chatInput.addEventListener('input', () => {
  chatInput.style.height = `${inputInitHeight}px`;
  chatInput.style.height = `${chatInput.scrollHeight}px`;
});
chatInput.addEventListener('keydown', (e) => {
  if (e.key === 'Enter' && !e.shiftKey && window.innerWidth > 800) {
    e.preventDefault();
    handleChat();
  }
});
chatbotToggle.addEventListener('click', () =>
  document.body.classList.toggle('show-chatbot')
);
chatbotCloseBtn.addEventListener('click', () =>
  document.body.classList.remove('show-chatbot')
);
sendChatBtn.addEventListener('click', handleChat);


    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
