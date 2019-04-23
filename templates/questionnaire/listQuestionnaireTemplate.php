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

                            <div class="btn-group">
                                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $unquestionnaire->IDQ)); ?>';">
                                    <span class="fa fa-search"></span> Détail
                                </button>
                                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'defaultAction', array('idq' => $unquestionnaire->IDQ)); ?>';">
                                    <span class="fa fa-plus-circle"></span> Créer Question
                                </button>
                                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'showListQuestion', array('idq' => $unquestionnaire->IDQ)); ?>';">
                                    <span class="fa fa-search"></span> Voir les Questions
                                </button>
                                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'edit', array('idq' => $unquestionnaire->IDQ)); ?>';">
                                    <span class="fa fa-pencil-square-o"></span> Edition
                                </button>
                                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'deleteQuest', array('idq' => $unquestionnaire->IDQ)); ?>';">
                                    <span class="fa fa-times"></span> Supprimer
                                </button>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>