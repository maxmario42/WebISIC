<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <div class="text-center">
                    <h2><span class="fa fa-question-circle"></span><?php echo $reponse->ENONCE; ?> </h2>
                </div>
                <tr class="no-wrap">
                    <th scope="col" class="align-middle">
                <tr>
                    <th scope="row">Enonce</th>
                    <td><?php echo $reponse->ENONCE; ?></td>
                </tr>
                <tr>
                    <th scope="row">CORRECT</th>
                    <td><?php echo $reponse->CORRECT; ?></td>
                </tr>
               
                <!--
                <button class="btn btn-lg btn-primary btn-block" onclick="window.location.href = '<?php echo $this->linkTo('Reponse', 'edit', array('idq' => $question->ID_QUEST)); ?>';">
                    <span class="fa fa-pencil-square-o"></span> Edition
                </button>-->
            </tbody>
        </table>
    </div>
</div>