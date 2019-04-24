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
                    <input type="text" class="form-control" name="inscLogin" id="inLogin" placeholder="Login" required>
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control" name="inscPassword" id="inPassword" placeholder="Mot de passe" required>
                    <label for="mdpVali">Confirmer Mot de passe</label>
                    <input type="password" class="form-control" name="inscPasswordVali" id="inPasswordVali" placeholder="Confirmer Mot de passe" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" id="inName" placeholder="Nom" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom" id="inPrenom" placeholder="Prenom" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email2">Email</label>
                    <input type="email" class="form-control" name="mail" id="inMail" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="matricule">Matricule</label>
                    <input type="text" class="form-control" name="matricule" id="inMatricule" placeholder="Matricule" required>
                </div>
                <div class="form-group">
                    <label for="statut">Statut</label><br>
                    <input type="radio" name="statut" value="interne" required>Interne<br>
                    <input type="radio" name="statut" value="externe">Externe<br>
                </div>

                <button type="submit" class="btn btn-dark" style="background-color: #1B5040;">Creer mon compte...</button>
            </form>
        </div>
    </div>
</div>