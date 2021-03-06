<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <div class="text-center">
                    <h2><span class="fa fa-question-circle"></span><?php echo $question->INTITULE; ?> </h2>
                </div>
                <tr class="no-wrap">
                    <th scope="col" class="align-middle">
                <tr>
                    <th scope="row">Intitule</th>
                    <td><?php echo $question->INTITULE; ?></td>
                </tr>
                <tr>
                    <th scope="row">TYPEQ</th>
                    <td><?php echo $question->TYPEQ; ?></td>
                </tr>
                <tr>
                    <th scope="row">TEMPS_MAX</th>
                    <td><?php echo $question->TEMPS_MAX; ?></td>
                </tr>
                <tr>
                    <th scope="row">TAG</th>
                    <td><?php echo $question->TAG; ?></td>
                </tr>

                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Reponse', 'defaultAction', array('idq' => $questionnaire->IDQ, 'idquest' => $question->ID_QUEST)); ?>';">
                    <span class="fa fa-plus-circle"></span> Ajouter reponse
                </button>
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Reponse', 'showListReponse', array('idq' => $questionnaire->IDQ, 'idquest' => $question->ID_QUEST)); ?>';">
                    <span class="fa fa-search"></span> Voir reponses ajoutés
                </button>

            </tbody>
        </table>
    </div>
</div>