<?php if (empty($questions)) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2>C'est un peu vide ici...</h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Il faut créer une question !</th>
                            <td>Pour cela, cliquez sur le bouton</td>
                            <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'defaultAction', array('idq' => $questionnaire->IDQ)); ?>';">
                                <span class="fa fa-plus-circle"></span> Créer une question
                            </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php foreach ($questions as $unequestion) : ?>
        <div main class="container" style="flex-grow:1;">
            <div class="row justify-content-center">
                <div class="col-lg-6 jumbotron py-3">

                    <div class="text-center">
                        <h2><?php echo $unequestion->INTITULE; ?></h2>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Intitule</th>
                                <td><?php echo $unequestion->INTITULE; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">TypeQ</th>
                                <td><?php echo $unequestion->TYPEQ; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Temps_Max</th>
                                <td><?php echo $unequestion->TEMPS_MAX; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tag</th>
                                <td><?php echo $unequestion->TAG; ?></td>
                            </tr>

                            <div class="btn-group">
                                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'showQuestion', array('idq' => $questionnaire->IDQ, 'idquest' => $unequestion->ID_QUEST)); ?>';">
                                    <span class="fa fa-search"></span> Détail
                                </button>
                                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'edit', array('idq' => $questionnaire->IDQ, 'idquest' => $unequestion->ID_QUEST)); ?>';">
                                    <span class="fa fa-pencil-square-o"></span> Edition
                                </button>
                                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Question', 'deleteQuestion', array('idq' => $questionnaire->IDQ, 'idquest' => $unequestion->ID_QUEST)); ?>';">
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