<?php if (empty($participations)) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2>C'est un peu vide ici...</h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Il faut des participants !</th>
                            <td>Prévenez du monde</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>

    <?php foreach ($participations as $uneparticipation) : ?>
        <div main class="container" style="flex-grow:1;">
            <div class="row justify-content-center">
                <div class="col-lg-6 jumbotron py-3">

                    <div class="text-center">
                        <h2><?php echo User::getWithId($uneparticipation->ID)->PRENOM; ?> <?php echo User::getWithId($uneparticipation->ID)->NOM; ?></h2>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Son score</th>
                                <td><?php echo $uneparticipation->SCORE; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Son classement</th>
                                <td><?php echo $uneparticipation->CLASSEMENT; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Date de participation</th>
                                <td><?php echo $uneparticipation->DATE_PARTICIPATION; ?></td>
                            </tr>
                            <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'deleteParticipation', array('idq' => $questionnaire->IDQ,'id' => $uneparticipation->ID)); ?>';">
                                <span class="fa fa-times"></span> Supprimer
                            </button>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>