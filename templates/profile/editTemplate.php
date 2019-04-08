<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Edition du profil</h2>
        </div>
        <div class="card-body">

            <?php
            if (isset($inscErrorText))
                echo '<span class="error">' . $inscErrorText . '</span>';
            ?>
            <form action="<? echo $this->linkTo('User','edition');?>" method="post">

                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" name="inscLogin" id="inLogin" placeholder="Login" value="<?php echo $user->LOGIN;?>">
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
                        <input type="text" class="form-control" name="nom" id="inName" placeholder="Nom" value="<?php echo $user->NOM;?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom" id="inPrenom" placeholder="Prenom" value="<?php echo $user->PRENOM;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email2">Email</label>
                    <input type="email" class="form-control" name="mail" id="inMail" placeholder="Email" value="<?php echo $user->MAIL_ENSEIGNANT; echo $user->MAIL_ETUDIANT;?>">
                </div>
<?php require_once ("editType/edit".$user->TYPE_UTILISATEUR."Template.php"); ?>
                <button type="submit" class="btn btn-dark" style="background-color: #1B5040;">Mise à jour</button>
            </form>
        </div>
    </div>
</div> 