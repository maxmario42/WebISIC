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
        $view->render();
    }
    
}