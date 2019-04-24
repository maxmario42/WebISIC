                <div class="form-group">
                    <label for="spe1">Matricule</label>
                    <input type="text" class="form-control" name="spe1" id="spe1" placeholder="Matricule" value="<?php echo $user->MATRICULE; ?>" required>
                </div>
                <div class="form-group">
                    <label for="spe2">Statut</label><br>
                    <input type="radio" name="spe2" value="interne" checked required>Interne<br>
                    <input type="radio" name="spe2" value="externe">Externe<br>
                </div>