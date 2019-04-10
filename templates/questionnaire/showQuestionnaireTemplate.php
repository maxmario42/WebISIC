
<div class="container">
  
  

    <div class="row">
        
    <?php
    // à adapter avec les données venant de la BD
    for($i=1 ; $i<=4; $i++){
    ?>

        <div class="col">
            <!-- debut -->
            <div class="card mb-3 p-4" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title font-weight-bold"><!-- dynamique --> Titre</h3>
                    <p class="card-text">" <!-- dynamique -->Description...."This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <hr />
                    <div class="font-weight-bold">Mode d'acces</div>
                    <p class="card-text"><small class="text-muted"><!-- dynamique -->Connecté</small></p>
                    <div class="font-weight-bold">Date Ouverture</div>
                    <p class="card-text"><small class="text-muted"><!-- dynamique -->20/04/2019</small></p>
                    <div class="font-weight-bold">Date ferméture</div>
                    <p class="card-text"><small class="text-muted"><!-- dynamique -->25/04/2019</small></p>
                </div>
                </div>
                <div class="col-md-4 p-3 text-nowrap bg_dark1">
                <!-- debut règle -->
                <div class="font-weight-bold">Durée</div>
                    <p class="card-text"><small class="text-muted"><!-- dynamique -->120</small>Minutes</p>
                    <div class="font-weight-bold">Retour arrière</div>
                    <p class="card-text"><small class="text-muted"><!-- dynamique -->Oui</small></p>
                    <div class="font-weight-bold d-flex">Réponse fausse</div>
                    <p class="card-text"><span class="text-danger">moins (-) </span><small class="text-muted"><!-- dynamique -->0</small></p>
                    <div class="font-weight-bold">Réponse juste</div>
                    <p class="card-text"><span class="text-success">plus (+) </span><small class="text-muted"><!-- dynamique -->1</small></p>
                <!-- fin règle -->
                </div>
            </div>
            </div>
            <!-- fin -->
        </div>

        <?php
        if(($i%2)==0){
            echo '<div class="w-100"></div>';
        }
        ?>

        <?php
        }//fin for
        ?>
    </div>

  


  
</div>





