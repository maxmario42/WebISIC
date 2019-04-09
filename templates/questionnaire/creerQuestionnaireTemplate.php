<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Questionnaire</h2>
        </div>
        <div class="card-body">

            <?php
            if (isset($questErrorText))
                echo '<span class="error">' . $questErrorText . '</span>';
            ?>
            <form action="<?php echo $this->linkTo('Questionnaire', 'newQuest'); ?>" method="post">

                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" name="titre" id="inTitre" placeholder="Titre " size="10">
                </div>
                <label for="description">Description</label>
                </label><br />
                <textarea name="description" id="inDescription" placeholder="Description"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date_Ouverture">Date Ouverture</label>
                <input type="text" class="form-control" name="date_ouverture" id="inDate_Ouverture" placeholder="aaaa/mm/jj">
            </div>
            <div class="form-group col-md-6">
                <label for="date_fermeture">Date Fermeture</label>
                <input type="text" class="form-control" name="date_fermeture"  id="inDate_Fermeture" placeholder="aaaa/mm/jj">
            </div>
            <div class="form-group">
                <label for="">Mode_Acces</label>
                <select class="form-control" name="mode_acces" size=1>
                    <option  value="public">public</option>
                    <option value="connecté">connecté</option>
                    <option value="lien">lien</option>
                </select>
            
<br>
            <button type="submit" class="btn btn-dark" style="background-color: #1B5040;"> Creer mon Questionnaire...</button>
            </div>


            </form>
        </div>
    </div>
</div>