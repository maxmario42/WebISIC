<?php

class LieuController extends Controller
{
    public function defaultAction()
    {
        $view = new View($this, 'lieu/index');
        $view->setArg('places', Lieu::findAll());
        $view->render();
    }

    public function addAction()
    {
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
        $view = new View($this, 'lieu/add');
        if ($this->request->isPost()) {
            $lieu = new Lieu(array(
                'LAT' => $this->request->POST('lat'),
                'LON' => $this->request->POST('lon'),
                'ADRESSE' => $this->request->POST('addr'),
                'NOM_LIEU' => $this->request->POST('nom'),
            ));
            if ($lieu->isValid()) {
                $lieu->save();
                $this->redirect(Router::path('lieu'));
            } else {
                $this->request->notify('danger', $lieu->getError());
            }
        }
        $view->render();
    }
    
    public function deleteAction()
    {
        if ($this->request->getUser() == null) {
            throw new Error('Accès interdit.', 403);
        }
        $lieu = Lieu::find($this->request->GET('id'));
        if (Etape::countBy('ID_LIEU', $lieu->getId())==0) {
            $lieu->delete();
        } else {
            $this->request->notify('danger', 'Suppression impossible : le lieu est associé à un trajet.');
        }
        $this->redirect(Router::path('lieu'));
    }
}
