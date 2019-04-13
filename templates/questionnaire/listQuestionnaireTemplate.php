<?php foreach ($this->getArg('questionnaire') as $questionnaire) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2><?php echo $questionnaire->TITRE; ?></h2>
                </div>
                <table class="table">
                    <tbody>
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
                        <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $questionnaire->IDQ)); ?>';">
                            <span class="fa fa-search"></span>Détail
                        </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endforeach ?>