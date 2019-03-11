<?php

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        if ($this->request->getUser() == null || !$this->request->getUser()->getAdmin()) {
            throw new Error('Accès interdit.', 403);
        }
    }

    public function defaultAction()
    {
        $view = new View($this, 'admin/index');
        $view->setArg('nbTrajets', array(
            'jour' => Etape::nbTrajetByDay(new \DateTime('-7day')),
            'mois' => Etape::nbTrajetByMonth(new \DateTime('-3month')),
            'annee' => Etape::nbTrajetByYear(new \DateTime('-3year')),
        ));
        $topCreators = Trajet::topCreators();
        foreach ($topCreators as $key => $user) {
            $topCreators[$key]['user'] = User::find($user['ID_USER']);
        }
        $view->setArg('topCreators', $topCreators);
        $topSites = Etape::topSites();
        foreach ($topSites as $key => $site) {
            $topSites[$key]['lieu'] = Lieu::find($site['ID_LIEU']);
        }
        $view->setArg('topSites', $topSites);
        $view->render();
    }

    public function usersAction()
    {
        $view = new View($this, 'admin/users');
        $view->setArg('users', User::listByName());
        $view->render();
    }

    public function tripsAction()
    {
        $view = new View($this, 'trip/index');
        $view->setArg('trajets', Trajet::findAll());
        $view->render();
    }

    public function vehiclesAction()
    {
        $view = new View($this, 'admin/vehicles');
        $view->setArg('vehicles', Vehicule::findAll());
        $view->render();
    }

    public function banUserAction()
    {
        if ($this->request->GET('id')) {
            $user = User::find($this->request->GET('id'));
            $user->setBanni(1);
            $user->save();
            $this->request->notify('info', 'Utilisateur banni');
            $this->redirect(Router::path('profile', array('id' => $user->getId())));
        }
    }

    public function unBanUserAction()
    {
        if ($this->request->GET('id')) {
            $user = User::find($this->request->GET('id'));
            $user->setBanni(0);
            $user->save();
            $this->request->notify('info', 'Utilisateur débanni');
            $this->redirect(Router::path('admin_ip', array('id' => $user->getId())));
        }
    }

    public function promoteUserAction()
    {
        if ($this->request->GET('id')) {
            $user = User::find($this->request->GET('id'));
            $user->setAdmin(1);
            $user->save();
            $this->request->notify('info', 'Utilisateur promu au rang d\'administrateur');
            $this->redirect(Router::path('profile', array('id' => $user->getId())));
        }
    }

    public function ipAction()
    {
        $view = new View($this, 'admin/ip');
        $view->setArg('ips', Ip::findAll());
        $view->render();
    }

    public function banIpAction()
    {
        if ($this->request->GET('id')) {
            $user = Ip::find($this->request->GET('id'));
            $user->setIpBanni(1);
            $user->save();
            $this->request->notify('info', 'Ip banni');
            $this->redirect(Router::path('admin_ip'));
        }
    }

    public function unbanIpAction()
    {
        if ($this->request->GET('id')) {
            $user = Ip::find($this->request->GET('id'));
            $user->setIpBanni(0);
            $user->save();
            $this->request->notify('info', 'Ip débanni');
            $this->redirect(Router::path('admin_ip'));
        }
    }
}
