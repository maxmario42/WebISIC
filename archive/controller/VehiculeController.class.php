<?php

class VehiculeController extends Controller
{
    public function defaultAction()
    {
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
        $vehicles = $this->request->getUser()->getVehicles();
        $view = new View($this, 'vehicule/index');
        $view->setArg('vehicules', $vehicles);
        $view->render();
    }

    public function addAction()
    {
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
        $view = new View($this, 'vehicule/add');
        $view->setArg('marques', Marque::findAll());
        $view->setArg('marque', null);

        if ($this->request->isPost()) {
            $marque = Marque::find($this->request->POST('marque'));
            if (!$marque->isInDb()) {
                $marqueInput = $this->request->POST('marque-input');
                $marque = new Marque(array('NOM_MARQUE' => $marqueInput));
                if (!$marque->isValid()) {
                    $this->request->notify('danger', $marque->getError());
                    return $view->render();
                }
                $marque->save();
            }
            $view->setArg('marque', $marque);

            $view->setArg('modeles', Modele::findBy(array('ID_MARQUE' => $marque->getId())));
            $view->setArg('modele', null);
            $modele = $this->request->POST('modele');
            if ($modele !== false) {
                $modele = Modele::find($modele);
                if (!$modele->isInDb()) {
                    $modeleName = $this->request->POST('modele-name');
                    $modeleYear = $this->request->POST('modele-year');
                    $modele = new Modele(array(
                        'ID_MARQUE' => $marque->getId(),
                        'NOM_MODELE' => $modeleName,
                        'ANNEE' => (int) $modeleYear,
                    ));
                    if (!$modele->isValid()) {
                        $this->request->notify('danger', $modele->getError());
                        return $view->render();
                    }
                    $modele->save();
                }
                $view->setArg('modele', $modele);

                $view->setArg('couleurs', Couleur::findAll());
                $couleur = $this->request->POST('couleur');
                if ($couleur !== false) {
                    $couleur = Couleur::find($couleur);
                    if (!$couleur->isInDb()) {
                        $colorInput = $this->request->POST('couleur-input');
                        $couleur = new Couleur(array('NOM_COULEUR' => $colorInput));
                        if (!$couleur->isValid()) {
                            $this->request->notify('danger', $couleur->getError());
                            return $view->render();
                        }
                        $couleur->save();
                    }

                    $vehicle = new Vehicule(array(
                        "ID_COULEUR" => $couleur->getId(),
                        "ID_MODELE" => $modele->getId(),
                        "USER" => $this->request->getUser(),
                    ));
                    if (!$vehicle->isValid()) {
                        $this->request->notify('danger', $vehicule->getError());
                        return $view->render();
                    }

                    $vehicle->save();
                    $this->request->notify('info', "Le véhicule a bien été ajouté");
                    return $this->redirect(Router::path('my_vehicles'));
                }
            }
        }
        $view->render();
    }

    public function deleteAction()
    {
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
        $vehicle = Vehicule::find($this->request->GET('id'));
        if ($vehicle->getIdUser() == $this->request->getUser()->getId()) {
            if (VehiculeTrajet::countBy('ID_VEHICULE', $vehicle->getId())==0) {
                $vehicle->delete();
            } else {
                $vehicles = $this->request->getUser()->getVehicles();
                $view = new View($this, 'vehicule/index');
                $view->setArg('vehicules', $vehicles);
                $this->request->notify('danger', 'Suppression impossible : le véhicule est utilisé dans un trajet.');
                return $view->render();
            }
        }
        $this->redirect(Router::path('my_vehicles'));
    }
}
