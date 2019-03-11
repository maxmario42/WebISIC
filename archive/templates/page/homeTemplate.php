<main>
    <div class="home">
    </div>
	<div class="jumbotron">
        <div class="col-sm-8 mx-auto">
        <h1>Bienvenue</h1>
        <p>Vous êtes sur Dracar, le site de covoiturage de l'IMT Lille Douai !</p>
            <?php if ($this->getUser() == null): ?>
                <p>N'hésitez pas à créer un compte pour profiter de nos services :</p>
                <p><a class="btn btn-primary" href="<?php echo $this->path('inscription'); ?>" role="button">S'inscrire »</a></p>
            <?php endif ?>
        </div>
    </div>
</main>