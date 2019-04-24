<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <h2>Reponse</h2>
        </div>

        <?php
        if (isset($questErrorText))
            echo '<span class="error">' . $questErrorText . '</span>';
        ?>

        <form action="<?php echo $this->linkTo('Reponse', 'newReponse', array('idq'=>$questionnaire->IDQ,'idquest' => $question->ID_QUEST)); ?>" method="post" class="needs-validation">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <!-- debut bloc1 -->
                    <div class="p-1"><strong class="mr-auto">Paramètre</strong></div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-1 -->
                            <label for="enonce">Enonce *</label>
                            <input type="text" class="form-control" name="enonce" id="inEnonce" placeholder="Enonce " value="" required>
                            <div class="valid-feedback">
                                Saisir un enonce!
                            </div>
                            <!-- fin bloc1-1  -->
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- debut bloc1-3 -->
                            <label for="correct">Correct</label>
                            <select class="form-control" name="correct" id="correct" size="1" required>
                                <option value="1">OUI</option>
                                <option value="0">NON</option>
                                
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
                
                <button type="submit" class="btn btn-warning text-dark">Creer ma Reponse </button>
                
             </div>
            </div>
        </form>

    </div>
</div>