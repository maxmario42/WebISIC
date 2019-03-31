<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Mise à jour des infos</h2>
        </div>
        <div class="card-body">

            <?php
            if (isset($inscErrorText))
                echo '<span class="error">' . $inscErrorText . '</span>';
            ?>
            <form action="<?php echo $this->path('edition'); ?>" method="post">

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

                <button type="submit" class="btn btn-dark" style="background-color: #1B5040;">Mettre à jour</button>
                <!--<table>
                    <tr>
                        <th>mail* :</th>
                        <td><input type="text" name="mail" /></td>
                    </tr>
                    <tr>
                        <th>Mot de passe* :</th>
                        <td><input type="password" name="inscPassword" /></td>
                    </tr>
                    <tr>
                        <th>Nom:</th>
                        <td><input type="text" name="nom" /></td>
                    </tr>
                    <tr>
                        <th>Prenom :</th>
                        <td><input type="text" name="prenom" /></td>
                    </tr>
                    <tr>

                        <th>Type user :</th>
                        <td><input type="radio" name="radio" value="0">Étudiant</td>
                        <td><input type="radio" name="radio" value="1">Professeur</td>
                    </tr>
                    <tr>
                        <th>Promo :</th>
                        <td><input type="text" name="promo" /></td>
                    </tr>
                    <tr>
                        <th>Anne de sortie:</th>
                        <td><input type="text" name="anne-sortie" /></td>
                    </tr>
                    <tr>
                    <tr>
                        <th>Matricule :</th>
                        <td><input type="text" name="matricule" /></td>
                    </tr>
                    <tr>
                        <th>Statut:</th>
                        <td><input type="text" name="statut" /></td>
                    </tr>
                    <tr>    
                        <th>
                        <td><input type="submit" value="Creer mon compte..." /></td> 
                    </tr>
                </table> -->
            </form>
        </div>
    </div>
</div> 