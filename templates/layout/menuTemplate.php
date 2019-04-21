  <!-- Navbar Area -->
  <div class="clever-main-menu">
      <div class="classy-nav-container breakpoint-off">
          <!-- Menu -->
          <nav class="classy-navbar justify-content-between" id="cleverNav">

              <!-- Logo -->
              <a class="nav-brand" href="<?php echo $this->linkTo(NULL); ?>"><img src="css/img/quiz.png" alt=""></a>

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
                          <li><a class="aMenu" href="<?php echo $this->linkTo(NULL); ?>">Accueil</a></li>
                          <?php if (isset($user)) :
                                ?>
                              <li><a class="aMenu" href="<?php echo $this->linkTo('User', 'aPropos'); ?>">À propos</a></li>
                              <?php if ($user->TYPE_UTILISATEUR == 'Enseignant') : ?>
                                  <li>
                                      <a class="aMenu" href="<?php echo $this->linkTo('Questionnaire'); ?>">
                                          <!-- aller vers la page creation questionnaire-->
                                          Créer Questionnaire</a>
                                  </li>
                                  <li>
                                      <a class="aMenu" href="<?php echo $this->linkTo('Questionnaire', 'showQuest'); ?>">
                                          <!-- aller vers la page creation questionnaire-->
                                          Mes Questionnaires</a>
                                  </li>
                                  <?php if (isset($questionnaire)) : ?>
                                      <li><a class="aMenu" href="<?php echo $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $questionnaire->IDQ)); ?>">Gestion du Questionnaire</a>
                                          <ul class="dropdown">
                        
                                            <li><a href="<?php echo $this->linkTo('Question', 'defaultAction', array('idq' => $questionnaire->IDQ)); ?>"><span class="fa fa-plus-circle"></span> Créer Question</a></li>
                                              <li><a href="<?php echo $this->linkTo('Question', 'showListQuestion', array('idq' => $questionnaire->IDQ));?>"><span class="fa fa-search"></span> Voir les Questions</a></li>
                                              <li><a href="<?php echo $this->linkTo('Questionnaire', 'edit', array('idq' => $questionnaire->IDQ));?>"><span class="fa fa-pencil-square-o"></span> Edition</a></li>
                                              <li><a href="<?php echo $this->linkTo('Questionnaire', 'deleteQuest', array('idq' => $questionnaire->IDQ));?>"><span class="fa fa-times"></span> Supprimer</a></li>
                                          </ul>
                                      </li>
                                  <?php endif ?>

                              <?php elseif ($user->TYPE_UTILISATEUR == 'Etudiant') : ?>
                                  <li class="nav-item text-center">
                                      <a class="aMenu" href="<?php echo $this->linkTo('Questionnaire', 'etuQuiz'); ?>">
                                          Mes Questionnaires
                                      </a>
                                  </li>
                                  <li>
                                      <a class="aMenu" href="<?php echo $this->linkTo('Questionnaire', 'etuResultats'); ?>">
                                          Resultats
                                      </a>
                                  </li>
                              <?php else : ?>
                                  <a>
                                      ERROR
                                  </a>
                              <?php endif ?>
                          <?php else :
                            ?>
                              <li><a class="aMenu" href="<?php echo $this->linkTo(NULL, 'aPropos'); ?>">À propos</a></li>
                              <li><a class="aMenu" href="Quest.php">Questionnaire</a></li>
                              <!-- <li><a href="blog.html"></a></li>
                                                        <li><a href="contact.html">Contact</a></li> -->
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
                      <?php if (isset($user)) : ?>
                          <div class="login-state d-flex align-items-center">
                              <div class="user-name mr-30">
                                  <div class="dropdown">
                                      <a class="dropdown-toggle" href="#" role="button" id="userName" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user->LOGIN ?></a>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userName">
                                          <a class="dropdown-item" href="<?php echo $this->linkTo('User', 'profile'); ?>">Profil</a>
                                          <a class="dropdown-item" href="<?php echo $this->linkTo('User', 'edit'); ?>">Modifier Infos</a>
                                          <a class="dropdown-item" href="<?php echo $this->linkTo('User', 'disconnect'); ?>">Déconnexion</a>
                                      </div>
                                  </div>
                              </div>
                              <div class="userthumb">
                                  <img src="img/bg-img/t1.png" alt="">
                              </div>
                          </div>
                      <?php else : ?>
                          <div class="register-login-area">
                              <a href="<?php echo $this->linkTo(NULL, 'inscriptionEtu'); ?>" class="btn">Inscription Etudiant</a>
                              <a href="<?php echo $this->linkTo(NULL, 'inscriptionProf'); ?>" class="btn">Inscription Professeur</a>
                              <a href="<?php echo $this->linkTo(NULL, 'login'); ?>" class="btn active">Connexion</a>
                          </div>
                      <?php endif ?>

                  </div>
                  <!-- Nav End -->
              </div>
          </nav>
      </div>
  </div>
  </header>
  <div id="page">