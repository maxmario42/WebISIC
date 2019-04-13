<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Inscription</h2>
        </div>
        <div class="card-body">

            <?php
            if (isset($inscErrorText))
                echo '<span class="error">' . $inscErrorText . '</span>';
            ?>
            <form action="<?php echo $this->linkTo(NULL, 'validateInscription'); ?>" method="post">

                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" name="inscLogin" id="inLogin" placeholder="Login">
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control" name="inscPassword" id="inPassword" placeholder="Mot de passe">
                    <label for="mdpVali">Confirmer Mot de passe</label>
                    <input type="password" class="form-control" name="inscPasswordVali" id="inPasswordVali" placeholder="Confirmer Mot de passe">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" id="inName" placeholder="Nom">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom" id="inPrenom" placeholder="Prenom">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email2">Email</label>
                    <input type="email" class="form-control" name="mail" id="inMail" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="promo">Promo</label>
                    <input type="text" class="form-control" name="promo" id="promo" placeholder="Promo">
                </div>
                <div class="form-group">
                    <label for="anneedesortie">Année de sortie</label>
                    <input type="number" class="form-control" name="anneedesortie" id="anneedesortie" placeholder="Année de sortie">
                </div>

                <button type="submit" class="btn btn-dark" style="background-color: #1B5040;">Creer mon compte...</button>
            </form>
        </div>
    </div>
</div>