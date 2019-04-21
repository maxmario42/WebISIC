<!--<button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'defaultAction', array('idq' => $questionnaire->IDQ)); ?>';">
    <span class="fa fa-plus-circle"></span> Créer une question
</button>-->
<?php foreach ($this->getArg('question') as $question) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2><?php echo $question->INTITULE; ?></h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Intitule</th>
                            <td><?php echo $question->INTITULE; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">TypeQ</th>
                            <td><?php echo $question->TYPEQ; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Temps_Max</th>
                            <td><?php echo $question->TEMPS_MAX; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tag</th>
                            <td><?php echo $question->TAG; ?></td>
                        </tr>

                        <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'showQuestion', array('idq' => $questionnaire->IDQ, 'idquest' => $question->ID_QUEST)); ?>';">
                            <span class="fa fa-search"></span> Détail
                        </button>
                        <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'deleteQuestion', array('idq' => $questionnaire->IDQ, 'idquest' => $question->ID_QUEST)); ?>';">
                            <span class="fa fa-times"></span> Supprimer
                        </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endforeach ?>