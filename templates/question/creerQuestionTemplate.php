<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Question</h2>
        </div>

        <?php
        if (isset($questErrorText))
            echo '<span class="error">' . $questErrorText . '</span>';
        ?>

        <form action="<?php echo $this->linkTo('Question', 'newQuest', array('idq'=>$questionnaire->IDQ)); ?>" method="post" class="needs-validation">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <!-- debut bloc1 -->
                    <div class="p-1"><strong class="mr-auto">Paramètre1</strong></div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-1 -->
                            <label for="inIntitule">Intitule *</label>
                            <input type="text" class="form-control" name="intitule" id="inIntitule" placeholder="Intitule " value="" required>
                            <div class="valid-feedback">
                                Saisir un intitule!
                            </div>
                            <!-- fin bloc1-1  -->
                        </div>
                      <!--  <div class="col-md-6 mb-3">
                            debut bloc1-2
                            <label for="idq">Idq *</label>
                            <input type="text" class="form-control" name="idq" id="idq" placeholder="Idq" value="" required>
                            <div class="valid-feedback">
                                Saisir un idq!
                            </div>
                             fin bloc1-2 
                        </div>  -->

                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-3 -->
                            <label for="typeq">TypeQ</label>
                            <select class="form-control" name="typeq" id="typeq" size="1" required>
                                <option value="QCU">QCU</option>
                                <option value="QCM">QCM</option>
                                <option value="QRL">QRL</option>
                            </select>
                            <div class="valid-feedback">
                                Sélectionner un type de question!
                            </div>
                            <!-- fin bloc1-3  -->
                        </div>
                    </div>

                    <div class="p-1"><strong class="mr-auto">Règles</strong></div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc durée -->
                            <label for="inTemps_max">Durée (en minute)</label>
                            <input type="number" class="form-control" name="temps_max" id="inTemps_max" placeholder="MM">
                            <div class="valid-feedback">
                                Saisir une durée!
                            </div>
                            <!-- fin bloc durée  -->
                        </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-4 -->
                            <label for="tag">Tag *</label>
                            <input type="text" class="form-control" name="tag" id="tag" placeholder="tag">
                        
                                Saisir un idq!
                            </div>
                            <!-- fin bloc1-4  -->
                        </div>

            <button type="submit" class="btn btn-warning text-dark">Creer ma Question </button>
        </form>

    </div>
</div>