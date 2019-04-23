<?php if (empty($questionnaires)) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2>C'est un peu vide ici...</h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Il faut créer un questionnaire !</th>
                            <td>Pour cela, cliquez sur le bouton</td>
                            <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire'); ?>';">
                                <span class="fa fa-plus-circle"></span> Créer un questionnaire
                            </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>

<?php foreach ($questionnaires as $unquestionnaire) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2><?php echo $unquestionnaire->TITRE; ?></h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Titre</th>
                            <td><?php echo $unquestionnaire->TITRE; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Description</th>
                            <td><?php echo $unquestionnaire->DESCRIPTION; ?></td>
                        </tr>

                        <?php if (isset($unquestionnaire)) : ?>
                                      
                                      <a class="aMenu" href="<?php echo $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $unquestionnaire->IDQ)); ?>"><?php echo $unquestionnaire->TITRE; ?></a>
                                          <ul class="dropdown">
                                              <li><a href="<?php echo $this->linkTo('Question', 'defaultAction', array('idq' => $unquestionnaire->IDQ)); ?>"><span class="fa fa-plus-circle"></span> Créer Question</a></li>
                                              <li><a href="<?php echo $this->linkTo('Question', 'showListQuestion', array('idq' => $unquestionnaire->IDQ)); ?>"><span class="fa fa-search"></span> Voir les Questions</a></li>
                                              <li><a href="<?php echo $this->linkTo('Questionnaire', 'edit', array('idq' => $unquestionnaire->IDQ)); ?>"><span class="fa fa-pencil-square-o"></span> Edition</a></li>
                                              <li><a href="<?php echo $this->linkTo('Questionnaire', 'deleteQuest', array('idq' => $unquestionnaire->IDQ)); ?>"><span class="fa fa-times"></span> Supprimer</a></li>
                                          </ul>
                                      
                                      
                        <?php endif ?>

                        <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $unquestionnaire->IDQ)); ?>';">
                            <span class="fa fa-search"></span>Détail
                        </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- ##### Popular Course Area Start ##### -->
    <section class="popular-courses-area section-padding-100">
        <div class="container">
            <div class="row">
                <?php foreach ($questionnaires as $unquestionnaire) : ?>
                    <!-- Single Popular Course -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                            <!-- Course Content -->
                            <div class="course-content">
                                <h4><?php echo $unquestionnaire->TITRE; ?></h4>
                                <div class="meta d-flex align-items-center">
                                    <a href="#"><?php echo User::getWithId($unquestionnaire->ID)->PRENOM;?> <?php echo User::getWithId($unquestionnaire->ID)->NOM;?></a>
                                </div>
                                <p><?php echo $unquestionnaire->DESCRIPTION; ?></p>
                            </div>
                            <!-- Seat Rating Fee -->
                            <div class="seat-rating-fee d-flex justify-content-between">
                                <div class="seat-rating h-100 d-flex align-items-center">
                                    <div class="seat">
                                        <i class="fa fa-user" aria-hidden="true"></i> 10
                                    </div>
                                </div>
                                <div class="course-fee h-100">
                                    <a href="<?php echo $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $unquestionnaire->IDQ)); ?>" class="free">Détails</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </section>
<?php endforeach ?>
<?php endif ?>
<!-- ##### Popular Course Area End ##### -->