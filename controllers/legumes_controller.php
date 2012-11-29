<?php
class LegumesController extends AppController {

	var $name = 'Legumes';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter');
	var $paginate = array(
        'limit' => 100,
        'order' => array(
            'Legume.lib' => 'asc'
        )
    );
	function index()
	{
		$this->Legume->recursive = 0;

		$this->set('legumes', $this->paginate($this->Legume, $this->AlaxosFilter->get_filter()));
		
		$unites = $this->Legume->Unite->find('list');
		$classifications = $this->Legume->Classification->find('list');
		$this->set(compact('unites', 'classifications'));
	}

	function view($id = null)
	{
		$this->_set_legume($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Legume->create();
			if ($this->Legume->save($this->data))
			{
				$this->Session->setFlash(___('the legume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the legume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$unites = $this->Legume->Unite->find('list');
		$classifications = $this->Legume->Classification->find('list');
		$this->set(compact('unites', 'classifications'));
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid id for legume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Legume->save($this->data))
			{
				$this->Session->setFlash(___('the legume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the legume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$this->_set_legume($id);
		
		$unites = $this->Legume->Unite->find('list');
		$classifications = $this->Legume->Classification->find('list');
		$this->set(compact('unites', 'classifications'));
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for legume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Legume->delete($id))
		{
			$this->Session->setFlash(___('legume deleted', true), 'flash_message', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('legume was not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl))
	        {
	            if($this->Acl->check($this->Auth->user(), 'Legumes/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Legume/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Legume->deleteAll(array('Legume.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(___('legumes deleted', true), 'flash_message', array('plugin' => 'alaxos'));
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(___('legumes were not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(___('no legume to delete was found', true), 'flash_error', array('plugin' => 'alaxos'));
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_legume($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Legume->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for legume', true), 'flash_error', array('plugin' => 'alaxos'));
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('legume', $this->data);
	}
	
	
	function admin_index()
	{
		$this->Legume->recursive = 0;
		$this->set('legumes', $this->paginate($this->Legume, $this->AlaxosFilter->get_filter()));
		
		$unites = $this->Legume->Unite->find('list');
		$classifications = $this->Legume->Classification->find('list');
		$this->set(compact('unites', 'classifications'));
	}

	function admin_view($id = null)
	{
		$this->_set_legume($id);
	}

	function admin_add()
	{
		if (!empty($this->data))
		{
			$this->Legume->create();
			if ($this->Legume->save($this->data))
			{
				$this->Session->setFlash(___('the legume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the legume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$unites = $this->Legume->Unite->find('list');
		$classifications = $this->Legume->Classification->find('list');
		$this->set(compact('unites', 'classifications'));
	}

	function admin_edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid id for legume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Legume->save($this->data))
			{
				$this->Session->setFlash(___('the legume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the legume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$this->_set_legume($id);
		
		$unites = $this->Legume->Unite->find('list');
		$classifications = $this->Legume->Classification->find('list');
		$this->set(compact('unites', 'classifications'));
	}

	function admin_delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for legume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Legume->delete($id))
		{
			$this->Session->setFlash(___('legume deleted', true), 'flash_message', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('legume was not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
        	if(isset($this->Acl))
	        {
	            if($this->Acl->check($this->Auth->user(), 'Legumes/admin_' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Legume/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Legume->deleteAll(array('Legume.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(___('legumes deleted', true), 'flash_message', array('plugin' => 'alaxos'));
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(___('legumes were not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(___('no legume to delete was found', true), 'flash_error', array('plugin' => 'alaxos'));
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	
}
?>
