<?php

class UserController extends Controller
{
    public function defaultAction()
    {
        $view = new View($this);
        $view->render();
    }
    public function profileAction()
    {
        $id = $this->request->GET('id');
        if ($id) {
            $user = User::find($this->request->GET('id'));
        } else {
            $user = $this->request->getUser();
        }
        if (!$user || !$user->isInDb()) {
            throw new Error('Ce profil n\'existe pas', 404);
        }
        $view = new View($this, 'profile/view');
        $view->setArg('user', $user);
        $view->setArg('trajets', Trajet::findCurrentForUser($user->getId()));
        $view->setArg('nbTrajets', Trajet::countBy('ID_USER', $user->getId()));
        $view->render();
    }
    public function editAction()
    {
        $user = $this->request->getUser();
        if ($user == null) {
            throw new Error('Accès interdit.', 403);
        }
        $view = new View($this, 'profile/edit');
        if ($this->request->isPost()) {
            $user->load();
            $user->setNom($this->request->POST('nom'));
            $user->setPrenom($this->request->POST('prenom'));
            $user->setPseudo($this->request->POST('pseudo'));
            $user->setEmail($this->request->POST('email'));
            $user->setTelephone($this->request->POST('telephone'));
            if ($user->isValid()) {
                $user->save();
                $this->request->notify('info', "Les modifications ont bien été enregistrées.");
            } else {
                $this->request->notify('danger', $user->getError());
            }
        }
        $view->setArg('user', $user);
        $view->render();
    }
    public function inscriptionAction()
    {
        $view = new View($this, 'inscription');
        $view->render();
    }
    public function loginAction()
    {
        if ($this->request->getUser()!=null) {
            $this->redirect(Router::path('profile'));
        } else {
            if ($this->request->isPost()) {
                $email = $this->request->POST('email');
                $password = $this->request->POST('password');
                $user = User::findOneBy(array('EMAIL' => $email));
                if ($user->getPassword() == hash('sha256', $password) && !$user->getBanni()) {
                    $this->request->setUser($user);
                    $this->redirect(Router::path('profile'));
                } else {
                    $this->request->notify('danger', 'Identifiants invalides');
                    $view = new View($this, 'login');
                }
            } else {
                $view = new View($this, 'login');
            }
        }
        $view->render();
    }
    public function logoutAction()
    {
        $this->request->setUser(null);
        $this->redirect(Router::path('home'));
    }
    public function validateInscriptionAction()
    {
        if (LogConnection::countNumberAccountCreation($this->request->getConnection()->getIdIp(), (new DateTime())->setTime(0, 0)) > 3) {
            $view = new View($this, 'inscription');
            $this->request->notify('danger', 'Too many account creation for today');
            $view->render();
            return;
        }
        $pseudo = $this->request->POST('pseudo');
        $password = $this->request->POST('password');
        $passwordConfirm = $this->request->POST('passwordConfirm');
        $nom = $this->request->POST('nom');
        $prenom = $this->request->POST('prenom');
        $email = $this->request->POST('email');
        $telephone = $this->request->POST('telephone');
        if (User::countBy('EMAIL', $email) != 0) {
            $view = new View($this, 'inscription');
            $this->request->notify('danger', 'Cet email existe déjà.');
            $view->render();
        } elseif ($password != $passwordConfirm) {
            $view = new View($this, 'inscription');
            $this->request->notify('danger', 'Les mots de passe ne correspondent pas.');
            $view->render();
        } else {
            $user = User::create($nom, $prenom, $email, $telephone, $password, $pseudo);
            $user->setIdLogConnection($this->request->getConnection()->getId());
            if ($user->isValid()) {
                $user->save();
                if (!isset($user)) {
                    $view = new View($this, 'inscription');
                    $this->request->notify('danger', 'L\'inscription a échouée');
                    $view->render();
                } else {
                    $this->request->set('user', $user->getId());
                    $this->redirect(Router::path('profile'));
                }
            } else {
                $view = new View($this, 'inscription');
                $this->request->notify('danger', $user->getError());
                $view->render();
            }
        }
    }
}
