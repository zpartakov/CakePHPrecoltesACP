<?php
class PrixlegumesController extends AppController {

	var $name = 'Prixlegumes';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter');

	function index()
	{
		$this->Prixlegume->recursive = 0;
		$this->set('prixlegumes', $this->paginate($this->Prixlegume, $this->AlaxosFilter->get_filter()));
		
		$legumes = $this->Prixlegume->Legume->find('list');
		$unites = $this->Prixlegume->Unite->find('list');
		$this->set(compact('legumes', 'unites'));
	}

	function view($id = null)
	{
		$this->_set_prixlegume($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Prixlegume->create();
			if ($this->Prixlegume->save($this->data))
			{
				$this->Session->setFlash(___('the prixlegume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the prixlegume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$legumes = $this->Prixlegume->Legume->find('list');
		$unites = $this->Prixlegume->Unite->find('list');
		$this->set(compact('legumes', 'unites'));
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid id for prixlegume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Prixlegume->save($this->data))
			{
				$this->Session->setFlash(___('the prixlegume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the prixlegume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$this->_set_prixlegume($id);
		
		$legumes = $this->Prixlegume->Legume->find('list');
		$unites = $this->Prixlegume->Unite->find('list');
		$this->set(compact('legumes', 'unites'));
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for prixlegume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Prixlegume->delete($id))
		{
			$this->Session->setFlash(___('prixlegume deleted', true), 'flash_message', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('prixlegume was not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl))
	        {
	            if($this->Acl->check($this->Auth->user(), 'Prixlegumes/' . $this->data['_Tech']['action']))
	            {
	                $this->setAction($this->data['_Tech']['action']);
	            }
	            else
	            {
	                $this->Session->setFlash(___d('alaxos', 'not authorized', true), 'flash_error', array('plugin' => 'alaxos'));
	                $this->redirect($this->referer());
	            }
	        }
	        elseif(isset($this->Auth) && $this->Auth->user() == null)
	        {
	            /*
	             * Manually check permission, as the setAction() method does not check for permission rights
	             */
                if(in_array(strtolower($this->data['_Tech']['action']), $this->Auth->allowedActions))
                {
                    $this->setAction($this->data['_Tech']['action']);
                }
                else
	            {
	                $this->Session->setFlash(___d('alaxos', 'not authorized', true), 'flash_error', array('plugin' => 'alaxos'));
					$this->redirect($this->referer());
	            }
	        }
	        else
	        {
	        	/*
	             * neither Auth nor Acl, or Auth + logged user
	             * -> grant access
	             */
	        	$this->setAction($this->data['_Tech']['action']);
	        }
	    }
	    else
	    {
	        $this->Session->setFlash(___d('alaxos', 'the action to perform is not defined', true), 'flash_error', array('plugin' => 'alaxos'));
	        $this->redirect($this->referer());
	    }
	}
	
	function deleteAll()
	{
	    $ids = Set :: extract('/Prixlegume/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Prixlegume->deleteAll(array('Prixlegume.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(___('prixlegumes deleted', true), 'flash_message', array('plugin' => 'alaxos'));
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(___('prixlegumes were not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(___('no prixlegume to delete was found', true), 'flash_error', array('plugin' => 'alaxos'));
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_prixlegume($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Prixlegume->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for prixlegume', true), 'flash_error', array('plugin' => 'alaxos'));
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('prixlegume', $this->data);
	}
	
	
	function admin_index()
	{
		$this->Prixlegume->recursive = 0;
		$this->set('prixlegumes', $this->paginate($this->Prixlegume, $this->AlaxosFilter->get_filter()));
		
		$legumes = $this->Prixlegume->Legume->find('list');
		$unites = $this->Prixlegume->Unite->find('list');
		$this->set(compact('legumes', 'unites'));
	}

	function admin_view($id = null)
	{
		$this->_set_prixlegume($id);
	}

	function admin_add()
	{
		if (!empty($this->data))
		{
			$this->Prixlegume->create();
			if ($this->Prixlegume->save($this->data))
			{
				$this->Session->setFlash(___('the prixlegume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the prixlegume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$legumes = $this->Prixlegume->Legume->find('list');
		$unites = $this->Prixlegume->Unite->find('list');
		$this->set(compact('legumes', 'unites'));
	}

	function admin_edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid id for prixlegume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Prixlegume->save($this->data))
			{
				$this->Session->setFlash(___('the prixlegume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the prixlegume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$this->_set_prixlegume($id);
		
		$legumes = $this->Prixlegume->Legume->find('list');
		$unites = $this->Prixlegume->Unite->find('list');
		$this->set(compact('legumes', 'unites'));
	}

	function admin_delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for prixlegume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Prixlegume->delete($id))
		{
			$this->Session->setFlash(___('prixlegume deleted', true), 'flash_message', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('prixlegume was not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
        	if(isset($this->Acl))
	        {
	            if($this->Acl->check($this->Auth->user(), 'Prixlegumes/admin_' . $this->data['_Tech']['action']))
	            {
	                $this->setAction('admin_' . $this->data['_Tech']['action']);
	            }
	            else
	            {
	                $this->Session->setFlash(___d('alaxos', 'not authorized', true), 'flash_error', array('plugin' => 'alaxos'));
	                $this->redirect($this->referer());
	            }
	        }
	        elseif(isset($this->Auth) && $this->Auth->user() == null)
	        {
	            /*
	             * Manually check permission, as the setAction() method does not check for permission rights
	             */
                if(in_array(strtolower('admin_' . $this->data['_Tech']['action']), $this->Auth->allowedActions))
                {
                    $this->setAction('admin_' . $this->data['_Tech']['action']);
                }
                else
	            {
	                $this->Session->setFlash(___d('alaxos', 'not authorized', true), 'flash_error', array('plugin' => 'alaxos'));
					$this->redirect($this->referer());
	            }
	        }
	        else
	        {
	        	/*
	             * neither Auth nor Acl, or Auth + logged user
	             * -> grant access
	             */
	        	$this->setAction($this->data['_Tech']['action']);
	        }
	    }
	    else
	    {
	        $this->Session->setFlash(___d('alaxos', 'the action to perform is not defined', true), 'flash_error', array('plugin' => 'alaxos'));
	        $this->redirect($this->referer());
	    }
	}
	
	function admin_deleteAll()
	{
	    $ids = Set :: extract('/Prixlegume/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Prixlegume->deleteAll(array('Prixlegume.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(___('prixlegumes deleted', true), 'flash_message', array('plugin' => 'alaxos'));
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(___('prixlegumes were not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(___('no prixlegume to delete was found', true), 'flash_error', array('plugin' => 'alaxos'));
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	
}
?>