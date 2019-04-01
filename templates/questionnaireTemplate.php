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
            <form action="<?php echo $this->path('add_Quiz');?>" method="post">

                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" name="questTitre" id="inTitre" placeholder="Titre">
                </div>
                <div class="form-group">

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dateOuverture">Date Ouverture</label>
                        <input type="text" class="form-control" name="dateOuverture" id="inDate_Ouverture" placeholder="Date_Ouverture">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_fermeture">Date_Fermeture</label>
                        <input type="text" class="form-control" name="date_fermuture" id="inDate_Fermeture" placeholder="Date_Fermeture">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mode_Acces</label>
                    <input type="email" class="form-control" name="mode_acces" id="inMode_Acces" placeholder="Mode_Acces">
                </div>
        
            </form>
        </div>
    </div>
</div> 