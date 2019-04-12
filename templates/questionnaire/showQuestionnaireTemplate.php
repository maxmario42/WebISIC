<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <div class="text-center">
                    <h2><span class="fa fa-question-circle"></span><?php echo $quiz->TITRE; ?> </h2>
                </div>
                <tr class="no-wrap">
                    <th scope="col" class="align-middle">
                <tr>
                    <th scope="row">Titre</th>
                    <td><?php echo $quiz->TITRE; ?></td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td><?php echo $quiz->DESCRIPTION; ?></td>
                </tr>
                <tr>
                    <th scope="row">Etat</th>
                    <td><?php echo $quiz->ETAT; ?></td>
                </tr>

                <tr>
                    <th scope="row">Date Ouverture</th>
                    <td><?php echo $quiz->DATE_OUVERTURE; ?></td>
                </tr>
                <tr>
                    <th scope="row">Date Fermeture</th>
                    <td><?php echo $quiz->DATE_FERMETURE; ?></td>
                </tr>
                <tr>
                    <th scope="row">Mode d'acces</th>
                    <td><?php echo $quiz->MODE_ACCES; ?></td>
                </tr>
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'edit'); ?>';">
                    <span class="fa fa-pencil-square-o"></span> Edition
                </button>
            </tbody>
        </table>
    </div>
</div>