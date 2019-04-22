<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Question</h2>
        </div>

        <?php
        if (isset($questErrorText))
            echo '<span class="error">' . $questErrorText . '</span>';
        ?>

        <form action="<?php echo $this->linkTo('Question', 'edition', array('idq'=>$questionnaire->IDQ)); ?>" method="post" class="needs-validation">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <!-- debut bloc1 -->
                    <div class="p-1"><strong class="mr-auto">Paramètre</strong></div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-1 -->
                            <label for="inIntitule">Intitule *</label>
                            <input type="text" class="form-control" name="intitule" id="inIntitule" placeholder="Intitule " value="<?php echo $question->INTITULE;?>" required>
                            <div class="valid-feedback">
                                Saisir un intitule!
                            </div>
                            <!-- fin bloc1-1  -->
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-3 -->
                            <label for="typeq">TypeQ</label>
                            <select class="form-control" name="typeq" id="typeq" size="1" required>
                                <option <?php if($question->TYPEQ=="QCU") echo 'selected="selected"'; ?> value="QCU">QCU</option>
                                <option <?php if($question->TYPEQ=="QCM") echo 'selected="selected"'; ?> value="QCM">QCM</option>
                                <option <?php if($question->TYPEQ=="QRL") echo 'selected="selected"'; ?> value="QRL">QRL</option>
                            </select>
                            <div class="valid-feedback">
                                Sélectionner un type de question!
                            </div>
                            <!-- fin bloc1-3  -->
                        </div>
                    </div>
                    <!-- fin bloc1 -->
                </div>
                <div class="col-md-6 mb-3">
                    <!-- debut bloc2 -->
                    <div class="p-1"><strong class="mr-auto">Règles</strong></div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc durée -->
                            <label for="inTemps_max">Durée (en minute)</label>
                            <input type="number" class="form-control" name="temps_max" id="inTemps_max" value="<?php echo $question->TEMPS_MAXIMAL;?>" placeholder="MM">
                            <div class="valid-feedback">
                                Saisir une durée!
                            </div>
                            <!-- fin bloc durée  -->
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-4 -->
                            <label for="tag">Tag </label>
                            <input type="text" class="form-control" name="tag" id="tag" placeholder="tag">
                            <div class="valid-feedback">
                                Saisir un tag!
                            </div>
                            <!-- fin bloc1-4  -->
                        </div>
                    </div>
                    <!-- fin bloc2 -->
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3 text-center">
                
                <button type="submit" class="btn btn-warning text-dark">Creer ma Question </button>
                
             </div>
            </div>
        </form>

    </div>
</div>