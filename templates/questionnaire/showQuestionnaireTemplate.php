<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <div class="text-center">
                    <h2><span class="fa fa-question-circle"></span> <?php echo $questionnaire->TITRE; ?> </h2>
                </div>
                <tr class="no-wrap">
                    <th scope="col" class="align-middle">
                <tr>
                    <th scope="row">Titre</th>
                    <td><?php echo $questionnaire->TITRE; ?></td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td><?php echo $questionnaire->DESCRIPTION; ?></td>
                </tr>
                <tr>
                    <th scope="row">Etat</th>
                    <td><?php echo $questionnaire->ETAT; ?></td>
                </tr>

                <tr>
                    <th scope="row">Date Ouverture</th>
                    <td><?php echo $questionnaire->DATE_OUVERTURE; ?></td>
                </tr>
                <tr>
                    <th scope="row">Date Fermeture</th>
                    <td><?php echo $questionnaire->DATE_FERMETURE; ?></td>
                </tr>
                <tr>
                    <th scope="row">Mode d'acces</th>
                    <td><?php echo $questionnaire->MODE_ACCES; ?></td>
                </tr>
<<<<<<< HEAD
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'edit', array('idq' => $quiz->IDQ)); ?>';">
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'edit', array('idq' => $quiz->IDQ)); ?>';">
                    
=======
                <!--
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'showListQuestion', array('idq' => $questionnaire->IDQ)); ?>';">
                    <span class="fa fa-search"></span> Questions
                </button>
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'edit', array('idq' => $questionnaire->IDQ)); ?>';">
>>>>>>> b456a991218c82f494dde42db076642471517d20
                    <span class="fa fa-pencil-square-o"></span> Edition
                </button>
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'deleteQuest', array('idq' => $questionnaire->IDQ)); ?>';">
                    <span class="fa fa-times"></span> Supprimer
                </button>
                -->
            </tbody>
        </table>
    </div>
</div>
<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <div class="text-center">
                    <h2><span class="fa fa-bars"></span> Regles du quiz </h2>
                </div>
                <tr>
                    <th scope="row">Durée</th>
                    <td><?php echo $regles->TEMPS_TOTALE; ?></td>
                </tr>
                <tr>
                    <th scope="row">Revenir en arrière?</th>
                    <?php if ((int)$regles->REVENIR_ARRIERE != 1) : ?>
                        <td>NON</td>
                    <?php else : ?>
                        <td>OUI</td>
                    <?php endif ?>
                </tr>

                <tr>
                    <th scope="row">Points pour question correct</th>
                    <td><?php echo $regles->PLUS; ?></td>
                </tr>
                <tr>
                    <th scope="row">Points de penalisation</th>
                    <td><?php echo $regles->MOINS; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>