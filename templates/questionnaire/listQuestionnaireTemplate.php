<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <div class="text-center">
                    <h2><span class="fa fa-user-circle"></span>QUESTIONNAIRES </h2>
                </div>
                <?php foreach ($this->getArg('questionnaire') as $questionnaire) : ?>
                    <tr class="no-wrap">
                        <th scope="col" class="align-middle">
                            <a href="<?php echo $this->linkToID('Questionnaire', 'showQuiz', $questionnaire->IDQ); ?>">
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

                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>