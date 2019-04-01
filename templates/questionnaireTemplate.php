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
            <form action="index.php?action=newQuest" method="post">

                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" name="questTitre" id="inTitre" placeholder="Titre">
                </div>
                <div class="form-group">

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dateOuverture">DateOuverture</label>
                        <input type="text" class="form-control" name="dateOuverture" id="inDate_Ouverture" placeholder="jj/mm/aaaa">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_fermeture">Date_Fermeture</label>
                        <input type="text" class="form-control" name="date_fermuture" id="inDate_Fermeture" placeholder="jj/mm/aaaa">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mode_Acces</label>
                    <input type="email" class="form-control" name="mode_acces" id="inMode_Acces" placeholder="Mode_Acces">
                    <form>
                    <select name="Mode_Access" size=3>
                    <option>connecté
                    <option>public
                    <option>lien
                    </select>
                    <button type="submit" class="btn btn-dark" style="background-color: #1B5040;">Creer mon Questionnaire...</button>
                    </form>
                </div>
        
            </form>
        </div>
    </div>
</div> 