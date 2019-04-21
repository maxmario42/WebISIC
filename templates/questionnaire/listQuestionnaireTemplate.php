<?php if (empty($this->getArg('questionnaires'))) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2>C'est un peu vide ici...</h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Il faut créer un questionnaire !</th>
                            <td>Pour cela, cliquez sur le bouton</td>
                        <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire'); ?>';">
                            <span class="fa fa-plus-circle"></span> Créer un questionnaire
                        </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>
<?php foreach ($this->getArg('questionnaires') as $questionnaires) : ?>
    <div main class="container" style="flex-grow:1;">
        <div class="row justify-content-center">
            <div class="col-lg-6 jumbotron py-3">

                <div class="text-center">
                    <h2><?php echo $questionnaires->TITRE; ?></h2>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Titre</th>
                            <td><?php echo $questionnaires->TITRE; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Description</th>
                            <td><?php echo $questionnaires->DESCRIPTION; ?></td>
                        </tr>
                        <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'showQuiz', array('idq' => $questionnaires->IDQ)); ?>';">
                            <span class="fa fa-search"></span> Détail
                        </button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php endif ?>