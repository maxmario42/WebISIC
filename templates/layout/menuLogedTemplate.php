  <!-- Navbar Area -->
  <div class="clever-main-menu">
      <div class="classy-nav-container breakpoint-off">
          <!-- Menu -->
          <nav class="classy-navbar justify-content-between" id="cleverNav">

              <!-- Logo -->
              <a class="nav-brand" href="<?php echo $this->path('homeUser');?>"><img src="css/img/quiz.png" alt=""></a>

              <!-- Navbar Toggler -->
              <div class="classy-navbar-toggler">
                  <span class="navbarToggler"><span></span><span></span><span></span></span>
              </div>

              <!-- Menu -->
              <div class="classy-menu">

                  <!-- Close Button -->
                  <div class="classycloseIcon">
                      <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                  </div>

                  <!-- Nav Start -->
                  <div class="classynav">
                      <ul>
                          <li><a href="<?php echo $this->path('homeUser');?>">Accueil</a></li>
                          <li><a href="<?php echo $this->path('aboutUser');?>">À propos</a></li>
                          <?php if ($user->TYPE_UTILISATEUR == 'Enseignant') : ?>
                          <li>
                              <a href="<?php echo $this->path('add_Quiz'); ?>">
                                  <!-- aller vers la page creation questionnaire-->
                                  Créer Questionnaire</a>
                          </li>
                          <li>
                              <a href="<?php echo $this->path('my_Quiz'); ?>">
                                  <!-- aller vers la page creation questionnaire-->
                                  Mes Questionnaires</a>
                          </li>

                          <?php elseif ($user->TYPE_UTILISATEUR == 'Etudiant') : ?>
                          <li class="nav-item text-center">
                              <a href="<?php echo $this->path('my_EQuiz'); ?>">
                                  Mes Questionnaires
                              </a>
                          </li>
                          <li>
                              <a href="<?php echo $this->path('my_EQuiz'); ?>">
                                  Resultats
                              </a>
                          </li>
                          <?php else : ?>
                          <a>
                              ERROR
                          </a>
                          <?php endif ?>

                      </ul>

                      <!-- Search Button -->
                      <div class="search-area">
                          <form action="#" method="post">
                              <input type="search" name="search" id="search" placeholder="Search">
                              <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                          </form>
                      </div>

                      <!-- Register / Login -->
                      <div class="login-state d-flex align-items-center">
                          <div class="user-name mr-30">
                              <div class="dropdown">
                                  <a class="dropdown-toggle" href="#" role="button" id="userName" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user->LOGIN ?></a>
                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userName">
                                      <a class="dropdown-item" href="<?php echo $this->path('profile'); ?>">Profil</a>
                                      <a class="dropdown-item" href="<?php echo $this->path('edit'); ?>">Modifier Infos</a>
                                      <a class="dropdown-item" href="<?php echo $this->path('logout'); ?>">Déconnexion</a>
                                  </div>
                              </div>
                          </div>
                          <div class="userthumb">
                              <img src="img/bg-img/t1.png" alt="">
                          </div>
                      </div>

                  </div>
                  <!-- Nav End -->
              </div>
          </nav>
      </div>
  </div>
  </header>
  <div id="page"> 