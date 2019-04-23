<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2><?php echo $question->INTITULE; ?></h2>
        </div>
        <div class="card-body">

            <?php
            if (isset($inscErrorText))
                echo '<span class="error">' . $inscErrorText . '</span>';
            ?>
            <form action="<?php echo $this->linkTo('Participer', 'reponse'); ?>" method="post">
                <div class="form-group">
                    <label for="consigne">Ecrivez la bonne réponse</label><br>
                    <input type="text" class="form-control" name="reponse" id="reponse" placeholder="Votre réponse">
                </div>

                <button type="submit" class="btn btn-dark" style="background-color: #1B5040;">Valider ma réponse</button>
            </form>
        </div>
    </div>
</div>