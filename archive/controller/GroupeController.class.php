<?php

class GroupeController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
    }

    public function defaultAction()
    {
        $view = new View($this, 'group/index');
        $view->setArg('groups', Groupe::findAll());
        $view->render();
    }

    public function addAction()
    {
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
        $view = new View($this, 'group/add');
        if ($this->request->isPost()) {
            $group = new Groupe(array(
                'NOM_GROUPE' => $this->request->POST('nom'),
            ));
            if ($group->isValid()) {
                $group->save();
                $this->redirect(Router::path('groups'));
            } else {
                $this->request->notify('danger', $group->getError());
            }
        }
        $view->render();
    }
    
    public function deleteAction()
    {
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
        $group = Groupe::find($this->request->GET('id'));
        if (GroupeUser::countBy('ID_GROUPE', $group->getId())==0) {
            $group->delete();
        } else {
            $this->request->notify('danger', 'Suppression impossible : au moins une personne est dans ce groupe.');
        }
        $this->redirect(Router::path('groups'));
    }

    public function joinAction()
    {
        $id = $this->request->GET('id', null);
        $user = $this->request->getUser();
        if ($user != null) {
            $group = Groupe::find($id);
            if ($user->isInGroup($group)) {
                $this->request->notify('info', 'Vous avez déjà rejoint ce groupe');
            } else {
                $groupeUser = new GroupeUser(array(
                    'ID_GROUPE' => $id,
                    'ID_USER' => $user->getId(),
                ));
                $groupeUser->save();
                $this->request->notify('info', 'Vous avez rejoint le groupe');
            }
        } else {
            $this->request->notify('info', 'Veuillez vous inscrire pour rejoindre un groupe');
        }
        return $this->redirect(Router::path('groups'));
    }

    public function leaveAction()
    {
        $id = $this->request->GET('id', null);
        $user = $this->request->getUser();
        if ($user != null) {
            $groupeUser = GroupeUser::findOneBy(array(
                'ID_GROUPE' => $id,
                'ID_USER' => $user->getId(),
            ));
            $groupeUser->delete();
            $this->request->notify('info', 'Vous avez quitté le groupe');
        }
        return $this->redirect(Router::path('groups'));
    }
}
