<?php
class ArticlesController extends AppController {

	var $name = 'Articles';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter');

	function index()
	{
		$this->Article->recursive = 0;
		$this->set('articles', $this->paginate($this->Article, $this->AlaxosFilter->get_filter()));
		
	}

	function view($id = null)
	{
		$this->_set_article($id);
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Article->create();
			if ($this->Article->save($this->data))
			{
				$this->Session->setFlash(___('the article has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the article could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid id for article', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Article->save($this->data))
			{
				$this->Session->setFlash(___('the article has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the article could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$this->_set_article($id);
		
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for article', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Article->delete($id))
		{
			$this->Session->setFlash(___('article deleted', true), 'flash_message', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('article was not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl))
	        {
	            if($this->Acl->check($this->Auth->user(), 'Articles/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Article/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Article->deleteAll(array('Article.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(___('articles deleted', true), 'flash_message', array('plugin' => 'alaxos'));
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(___('articles were not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(___('no article to delete was found', true), 'flash_error', array('plugin' => 'alaxos'));
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_article($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Article->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for article', true), 'flash_error', array('plugin' => 'alaxos'));
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('article', $this->data);
	}
	
	
}
?>