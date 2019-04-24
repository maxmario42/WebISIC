<?php if (empty($reponses)) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2>C'est un peu vide ici...</h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Il faut créer une reponse !</th>
                            <td>Pour cela, cliquez sur le bouton</td>
                        <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Reponse', 'defaultAction', array('idq' => $questionnaire->IDQ, 'idquest' => $question->ID_QUEST)); ?>';">
                            <span class="fa fa-plus-circle"></span> Créer une reponse
                        </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php foreach ($reponses as $reponse) : ?>
        <div main class="container" style="flex-grow:1;">
            <div class="row justify-content-center">
                <div class="col-lg-6 jumbotron py-3">

                    <div class="text-center">
                        <h2><?php echo $reponse->ENONCE; ?></h2>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Enonce</th>
                                <td><?php echo $reponse->ENONCE; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Correct</th>
                                <td><?php echo $reponse->CORRECT; ?></td>
                            </tr>
                            <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Reponse', 'showReponse', array('idq' => $questionnaire->IDQ, 'idquest' => $reponse->ID_QUEST, 'idR' => $reponse->ID_REPONSE)); ?>';">
                                <span class="fa fa-search"></span> Détail
                            </button>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>