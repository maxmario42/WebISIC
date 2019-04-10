<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Questionnaire</h2>
        </div>

        <?php
            if (isset($questErrorText))
                echo '<span class="error">' . $questErrorText . '</span>';
        ?>

        <form action="<?php echo $this->linkTo('Questionnaire', 'newQuest'); ?>" method="post" class="needs-validation">
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <!-- debut bloc1 -->
                <div class="p-1"><strong class="mr-auto">Paramètre</strong></div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc1-1 -->
                        <label for="inTitre">Titre *</label>
                        <input type="text" class="form-control" name="titre" id="inTitre" placeholder="Titre " value="" required>
                        <div class="valid-feedback">
                           Saisir un titre!
                        </div>
                        <!-- fin bloc1-1  -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc1-2 -->
                        <label for="mode_acces">Mode d'acces</label>
                        <select class="form-control" name="mode_acces" id="mode_acces" size="1" required>
                            <option value="connecte">connecté</option>    
                            <option value="public">public</option>
                            <option value="lien">lien</option>
                        </select>
                        <div class="valid-feedback">
                           Sélectionner un mode de connexion!
                        </div>
                        <!-- fin bloc1-2  -->
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <!-- debut bloc description -->
                        <label for="inDescription">Description</label>
                        <textarea class="form-control" name="description" id="inDescription" placeholder="Description"></textarea>
                        <div class="valid-feedback">
                           Saisir une description!
                        </div>
                        <!-- fin bloc description  -->
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc date ouverture -->
                        <label for="inDate_Ouverture">Date Ouverture</label>
                        <input type="date" class="form-control" name="date_ouverture" id="inDate_Ouverture" placeholder="aaaa/mm/jj">
                        <div class="valid-feedback">
                           Saisir une date d'ouverture!
                        </div>
                        <!-- fin bloc date ouverture  -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc date ferméture -->
                        <label for="inDate_Fermeture">Date ferméture</label>
                        <input type="date" class="form-control" name="date_fermeture"  id="inDate_Fermeture" placeholder="aaaa/mm/jj">
                        <div class="valid-feedback">
                            Saisir une date de ferméture!
                        </div>
                        <!-- fin bloc date ferméture  -->
                    </div>
                </div>
                <!-- fin bloc1  -->
            </div>
            <div class="col-md-6 mb-3">
                <!-- debut bloc2 -->
                <div class="p-1"><strong class="mr-auto">Règles</strong></div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc durée -->
                        <label for="inTemps_total">Durée  (en minute)</label>
                        <input type="number" class="form-control" name="temps_total" id="inTemps_total" placeholder="MM">
                        <div class="valid-feedback">
                            Saisir une durée!
                        </div>
                        <!-- fin bloc durée  -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc2-2 -->
                        <label for="inlineRadio1">Retour arrière</label>
                        <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="revenir_arriere" id="inlineRadio1" checked="checked" value="oui">
                            <label class="form-check-label" for="inlineRadio1">Oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="revenir_arriere" id="inlineRadio2" value="non">
                            <label class="form-check-label" for="inlineRadio2">Non</label>
                        </div>
                        </div>
                        <!-- fin bloc2-2  -->
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc Titre Réponse fausse -->
                        <label for="">Réponse fausse <span class="text-danger">moins (-)</span></label>
                        <!-- fin bloc Titre Réponse fausse -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc valeur du point -->
                        <!-- <label for="inMoins">Nombre de point *</label> -->
                        <input type="number" class="form-control" name="moins" id="inMoins" value="0" placeholder="" required>
                        <div class="valid-feedback">
                            Saisir une valeur!
                        </div>
                        <!-- fin bloc valeur du point  -->
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc Titre Réponse juste -->
                        <label for="">Réponse juste <span class="text-success">plus (+)</span></label>
                        <!-- fin bloc Titre Réponse juste -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <!-- debut bloc valeur du point -->
                        <!-- <label for="inPlus">Nombre de point *</label> -->
                        <input type="number" class="form-control" name="plus" id="inPlus" value="1" placeholder="" required>
                        <div class="valid-feedback">
                            Saisir une valeur!
                        </div>
                        <!-- fin bloc valeur du point  -->
                    </div>
                </div>
                <!-- fin bloc2  -->
            </div>
        </div>
        
        <button type="submit" class="btn btn-warning text-dark">Creer mon Questionnaire </button>
        </form>

    </div>
</div> 