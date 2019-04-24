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
                    <label for="consigne">Cochez les réponses qui vous semblent juste</label><br>
                    <?php foreach ($reponses as $unereponse):?>
                        <input type="checkbox" name="reponse[]" value="<?php echo $unereponse->ID_REPONSE; ?>"> <?php echo $unereponse->ENONCE; ?><br>
                    <?php endforeach ?>
                </div>

                <button type="submit" class="btn btn-dark" style="background-color: #FF8100;">Valider ma réponse</button>
            </form>
        </div>
    </div>
</div>