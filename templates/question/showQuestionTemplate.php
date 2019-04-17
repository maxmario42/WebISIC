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
                    <th scope="row">Intitule</th>
                    <td><?php echo $quiz->INTITULE; ?></td>
                </tr>
                <tr>
                    <th scope="row">IDQ</th>
                    <td><?php echo $quiz->IDQ; ?></td>
                </tr>
                <tr>
                    <th scope="row">TYPEQ</th>
                    <td><?php echo $quiz->TYPEQ; ?></td>
                </tr>

                <tr>
                    <th scope="row">TEMPS_MAX</th>
                    <td><?php echo $quiz->TEMPS_MAX; ?></td>
                </tr>
                <tr>
                    <th scope="row">TAG</th>
                    <td><?php echo $quiz->TAG; ?></td>
                </tr>
                
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Questionnaire', 'edit', array('idq' => $quiz->IDQ)); ?>';">
                    <span class="fa fa-pencil-square-o"></span> Edition
                </button>
            </tbody>
        </table>
    </div>
</div>