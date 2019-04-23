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
                    <th scope="row">Votre score</th>
                    <td><?php echo $participation->SCORE; ?></td>
                </tr>
                <tr>
                    <th scope="row">Votre classement</th>
                    <td><?php echo $participation->CLASSEMENT; ?></td>
                </tr>
                <tr>
                    <th scope="row">Date de participation</th>
                    <td><?php echo $participation->DATE_PARTICIPATION; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>