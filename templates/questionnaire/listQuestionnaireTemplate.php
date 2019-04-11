<div main class="container" style="flex-grow:1;">

    <div class="row justify-content-center">
		<div class="col-lg-6 jumbotron py-3">
	
            <div class="text-center">
                    <h2><span class="fa fa-user-circle"></span>QUESTIONNAIRES </h2>
                    <?php // ($questionnaire->IDQ);?>
                </div>
                <?php foreach ($this->getArg('questionnaire') as $questionnaire) : ?>
        <table class="table">
            <tbody>
                <tr>             
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
                </a>
                </tr>
               
            </tbody>
        </table>
        <?php endforeach ?>
    </div>
</div>