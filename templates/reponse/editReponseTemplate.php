<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Reponse</h2>
        </div>

        <?php
        if (isset($questErrorText))
            echo '<span class="error">' . $questErrorText . '</span>';
        ?>

        <form action="<?php echo $this->linkTo('Reponse', 'edition', array('idq'=>$questionnaire->IDQ)); ?>" method="post" class="needs-validation">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <!-- debut bloc1 -->
                    <div class="p-1"><strong class="mr-auto">Paramètre</strong></div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-1 -->
                            <label for="inEnonce">Enonce *</label>
                            <input type="text" class="form-control" name="enonce" id="inEnonce" placeholder="Enonce " value="<?php echo $reponse->ENONCE;?>" required>
                            <div class="valid-feedback">
                                Saisir un enonce!
                            </div>
                            <!-- fin bloc1-1  -->
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-3 -->
                            <label for="correct">Correct</label>
                            <select class="form-control" name="typeq" id="typeq" size="1" required>
                                <option <?php if($reponse->CORRECT=="1") echo 'selected="selected"'; ?> value="QCU">QCU</option>
                                <option <?php if($reponse->CORRECT=="0") echo 'selected="selected"'; ?> value="QCM">QCM</option>
                                
                            </select>
                            <div class="valid-feedback">
                                Sélectionner un type de reponse!
                            </div>
                            <!-- fin bloc1-3  -->
                        </div>
                    </div>
                    <!-- fin bloc1 -->
                </div>
                
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3 text-center">
                
                <button type="submit" class="btn btn-warning text-dark">Modifier ma Question </button>
                
             </div>
            </div>
        </form>

    </div>
</div>