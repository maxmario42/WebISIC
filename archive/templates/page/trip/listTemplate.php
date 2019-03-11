<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Etape(s)</th>
                    <th scope="col">Heure</th>
                    <th scope="col">Véhicule(s)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->getArg('trajets') as $trajet): ?>
                    <tr class="no-wrap">
                        <th scope="col" class="align-middle">
                            <a href="<?php echo $this->path('trip', array('id' => $trajet->getId())); ?>">
                                <button class="btn btn-info">
                                    <span class="fa fa-info-circle"></span> Détail
                                </button>
                            </a>
                        </th>
                        <td>
                            <?php foreach ($trajet->getEtapes() as $etape): ?>
                                <p><?php echo $this->safe($etape->getLieu()); ?></p>
                            <?php endforeach ?>
                        </td>
                        <td>
                            <?php foreach ($trajet->getEtapes() as $etape): ?>
                                <p><?php echo (new DateTime($etape->getHeure()))->format("m/d/Y H\hi"); ?></p>
                            <?php endforeach ?>
                        </td>
                        <td class="align-middle">
                            <?php foreach ($trajet->getVehicules() as $vehicule): ?>
                                <p><?php echo $this->safe($vehicule->getVehicule()->getModele()); ?> de couleur <?php echo $this->safe($vehicule->getVehicule()->getCouleur()); ?></p>
                            <?php endforeach ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
