<?php

class TrajetController extends Controller
{
    public function defaultAction()
    {
        $view = new View($this, 'trip/index');
        $view->setArg('trajets', array());
        $view->setArg('form', true);
        if (isset($_GET['submit'])) {
            $trajets = Trajet::findFromTo(
                $this->request->GET('start'),
                $this->request->GET('end'),
                new DateTime($this->request->GET('start-date').' '.$this->request->GET('start-time').':00'),
                new DateTime($this->request->GET('end-date').' '.$this->request->GET('end-time').':00')
            );
            $view->setArg('trajets', $trajets);
        }
        $places = Lieu::findAll();
        $view->setArg('places', $places);
        $view->render();
    }

    public function uniqueAction()
    {
        $trip = Trajet::find($this->request->GET('id', null));
        if (!$trip->isInDb()) {
            return $this->redirect(Router::path('search_trip'));
        }
        $user = $this->request->getUser();
        $view = new View($this, 'trip/unique');
        if ($this->request->isPost() && $user && $trip->isAdmin($user)) {
            $mod = User::findOneBy(array('EMAIL' => $this->request->POST('email')));
            if ($mod->getId() == null) {
                $this->request->notify('info', "Cet utilisateur n\'existe pas");
            } else {
                if ($trip->isModerator($mod)) {
                    $this->request->notify('info', 'Cet utilisateur est déjà modérateur');
                } else {
                    $moderator = new TrajetModerator(array(
                        'ID_TRAJET' => $trip->getId(),
                        'ID_USER' => $mod->getId(),
                    ));
                    $moderator->save();
                    $trip->setModerators(null);
                    $this->request->notify('info', 'Modérateur ajouté');
                }
            }
        }
        $view->setArg('trip', $trip);
        $view->setArg('isCreator', $user && $trip->isCreator($user));
        $view->setArg('isAdmin', $user && $trip->isAdmin($user));
        $view->setArg('isModerator', $user && $trip->isModerator($user));
        $view->setArg('isSignup', $user && $trip->isSignup($user));
        $view->render();
    }

    public function removeParticipantAction()
    {
        $id = $this->request->GET('id', null);
        $user = $this->request->getUser();
        if ($user != null) {
            $trip = Trajet::find($id);
            if (!$trip->isInDb()) {
                return $this->redirect(Router::path('search_trip'));
            }
            if ($trip->isModerator($user)) {
                $participant = Participants::findOneBy(array(
                    'ID_TRAJET' => $id,
                    'ID_USER' => $this->request->GET('id_user', null)
                ));
                $participant->delete();
                $this->request->notify('info', 'Le participant a été supprimé');
            }
        }
        return $this->redirect(Router::path('trip', array('id' => $id)));
    }

    public function removeModeratorAction()
    {
        $id = $this->request->GET('id', null);
        $user = $this->request->getUser();
        if ($user != null) {
            $trip = Trajet::find($id);
            if (!$trip->isInDb()) {
                return $this->redirect(Router::path('search_trip'));
            }
            if ($trip->isAdmin($user)) {
                $mod = TrajetModerator::findOneBy(array(
                    'ID_TRAJET' => $id,
                    'ID_USER' => $this->request->GET('id_user', null)
                ));
                $mod->delete();
                $this->request->notify('info', 'Le modérateur a été supprimé');
            }
        }
        return $this->redirect(Router::path('trip', array('id' => $id)));
    }

    public function lockAction()
    {
        $id = $this->request->GET('id', null);
        $user = $this->request->getUser();
        if ($user != null) {
            $trip = Trajet::find($id);
            if (!$trip->isInDb()) {
                return $this->redirect(Router::path('search_trip'));
            }
            if ($trip->isAdmin($user)) {
                if ($trip->getBloquer()) {
                    $this->request->notify('info', 'Le trajet est déjà bloqué');
                } else {
                    $trip->setBloquer(1);
                    $trip->save();
                    $this->request->notify('info', 'Le trajet a été bloqué');
                }
            }
        }
        return $this->redirect(Router::path('trip', array('id' => $id)));
    }

    public function unlockAction()
    {
        $id = $this->request->GET('id', null);
        $user = $this->request->getUser();
        if ($user != null) {
            $trip = Trajet::find($id);
            if (!$trip->isInDb()) {
                return $this->redirect(Router::path('search_trip'));
            }
            if ($trip->isAdmin($user)) {
                if ($trip->getBloquer()) {
                    $trip->setBloquer(1);
                    $trip->save();
                    $this->request->notify('info', 'Le trajet a été débloqué');
                } else {
                    $this->request->notify('info', 'Le trajet est déjà débloqué');
                }
            }
        }
        return $this->redirect(Router::path('trip', array('id' => $id)));
    }

    public function signupAction()
    {
        $id = $this->request->GET('id', null);
        $user = $this->request->getUser();
        if ($user != null) {
            $trip = Trajet::find($id);
            if ($trip->isSignup($user)) {
                $this->request->notify('info', 'Vous avez déjà rejoint ce trajet');
            } else {
                if ($trip->isFull()) {
                    $this->request->notify('info', 'Ce trajet est déjà complet');
                } else {
                    $participant = new Participants(array(
                        'ID_TRAJET' => $id,
                        'ID_USER' => $user->getId()
                    ));
                    $participant->save();
                    $this->request->notify('info', 'Vous avez rejoint ce trajet');
                }
            }
        } else {
            $this->request->notify('info', 'Veuillez vous inscrire pour rejoindre ce trajet');
        }
        return $this->redirect(Router::path('trip', array('id' => $id)));
    }

    public function signoutAction()
    {
        $id = $this->request->GET('id', null);
        $user = $this->request->getUser();
        if ($user != null) {
            $trip = Trajet::find($id);
            if (!$trip->isInDb()) {
                return $this->redirect(Router::path('search_trip'));
            }
            $participant = Participants::findOneBy(array(
                'ID_TRAJET' => $id,
                'ID_USER' => $user->getId()
            ));
            $participant->delete();
            $this->request->notify('info', 'Vous vous êtes désinscrit du trajet');
        }
        return $this->redirect(Router::path('trip', array('id' => $id)));
    }

    public function addAction()
    {
        $user = $this->request->getUser();
        if ($user == null) {
            throw new Error('Accès interdit.', 403);
        }
        if (count($user->getVehicles()) == 0) {
            $this->request->notify('info', 'Veuillez ajouter un véhicule avant de créer un trajet');
            $this->redirect(Router::path('add_vehicle'));
        }
        $view = new View($this, 'trip/add');
        $nbEtapes = (int) $this->request->get('nb_etapes', 2);
        if ($nbEtapes < 2) {
            $nbEtapes = 2;
        }
        $view->setArg('nbEtapes', $nbEtapes);
        if ($this->request->isPost() && $this->request->POST('submit')) {
            $type = TypeTrajet::find($this->request->POST('type'));
            if (!$type->isInDb()) {
                $typeInput = $this->request->POST('type-input');
                $type = new TypeTrajet(array('NOM_TYPE' => $typeInput));
                if ($type->isValid()) {
                    $type->save();
                }
            }
            if ($type->isValid()) {
                $places = $this->request->POST('places');
                if (Validator::range($places, array('min' => 1))) {
                    $vehicles = array_unique($this->request->POST('vehicules', array()));
                    if (count($vehicles) != 0) {
                        $allMyVehicles = true;
                        foreach ($vehicles as $key => $vehicle) {
                            $vehicles[$key] = Vehicule::find($vehicle);
                            $allMyVehicles = $allMyVehicles && $user->hasVehicle($vehicles[$key]);
                        }
                        if ($allMyVehicles) {
                            $etapes = $this->request->POST('etapes', array());
                            $etapesValid = count($etapes) != 0;
                            $lieux = array();
                            foreach ($etapes as $key => $etape) {
                                if ($etapesValid) { // Ajout d'une étape
                                    $lieu = Lieu::find($etape['lieu']);
                                    if (!in_array($etape['lieu'], $lieux) && $lieu->isInDb()) {
                                        $etapes[$key] = new Etape(array(
                                            'HEURE' => $etape['date'].' '.$etape['time'].':00',
                                            'ID_LIEU' => $lieu->getId(),
                                        ));
                                        $etapesValid = $etapes[$key]->isValid(); // Doesn't have trajet currently
                                    } else {
                                        $etapesValid = false;
                                    }
                                }
                            }

                            if ($etapesValid) {
                                $trajet = new Trajet(array(
                                    "ID_USER" => $this->request->getUser()->getId(),
                                    "ID_TYPE_TRAJET" => $type->getId(),
                                    "PLACE" => $places,
                                    "BLOQUER" => 0,
                                ));
                                $trajet->save();
                                foreach ($etapes as $etape) {
                                    $etape->setTrajet($trajet);
                                    $etape->save();
                                }
                                foreach ($vehicles as $vehicle) {
                                    $vehicleTrajet = new VehiculeTrajet(array(
                                        'ID_VEHICULE' => $vehicle->getId(),
                                        'ID_TRAJET' => $trajet->getId(),
                                    ));
                                    $vehicleTrajet->save();
                                }
                                return $this->redirect(Router::path('trip', array('id' => $trajet->getId())));
                            } else {
                                $this->request->notify('danger', "Étapes non valides");
                            }
                        } else {
                            $this->request->notify('danger', "Hum... Petit Malin, l'un des véhicules sélectionné n'est pas le tiens !");
                        }
                    } else {
                        $this->request->notify('danger', "Veuillez sélectitonner au moins un véhicule");
                    }
                } else {
                    $this->request->notify('danger', "Nombre de place invalide");
                }
            } else {
                $this->request->notify('danger', $type->getError());
            }
        }
        $view->setArg('vehicules', $user->getVehicles());
        $view->setArg('places', Lieu::findAll());
        $view->setArg('types', TypeTrajet::findAll());
        $view->render();
    }

    public function myTripsAction()
    {
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
        $trips = Trajet::findBy(array('ID_USER' => $this->request->getUser()->getId()));
        $view = new View($this, 'trip/index');
        $view->setArg('trajets', $trips);
        $view->render();
    }

    public function myBookingsAction()
    {
        $user = $this->request->getUser();
        if ($user == null) {
            throw new Error('Accès interdit.', 403);
        }
        $participations = Participants::findBy(array('ID_USER' => $user->getId()));
        $trips = array();
        foreach($participations as $participation) {
            $trips[] = $participation->getTrajet();
        }
        $view = new View($this, 'trip/index');
        $view->setArg('trajets', $trips);
        $view->render();
    }
}
