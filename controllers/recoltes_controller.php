<?php
class RecoltesController extends AppController {

	var $name = 'Recoltes';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter');
var $paginate = array(
        'limit' => 100,
        'order' => array(
            'Recolte.date' => 'asc'
        )
    );
	function index()
	{
		$this->Recolte->recursive = 0;
		$this->set('recoltes', $this->paginate($this->Recolte, $this->AlaxosFilter->get_filter()));

	}

	function view($id = null)
	{
		
		$options=array('id'=>$id);
		$recolteslegumes = $this->Recolte->Recolteslegume->find('list',$options);
		$this->set(compact('recolteslegumes'));
		$this->_set_recolte($id);
		
	}

	function add()
	{
		if (!empty($this->data))
		{
			$this->Recolte->create();
				//date conversion
			    $mydatefield = $this->data['Recolte']['date'];
			    $mydatefield=explode(".",$mydatefield);
			    $mydatefield=$mydatefield[2]."-".$mydatefield[1]."-".$mydatefield[0];
				#echo "Date: " .$mydatefield; exit;
				$this->data['Recolte']['date']=$mydatefield;
			if ($this->Recolte->save($this->data))
			{
				$this->Session->setFlash(___('the recolte has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
#				$this->redirect(array('action' => '../recolteslegumes/add'));
#				$this->redirect(array('action' => '../recolteslegumes/add?recolte=' .$this->data['Recolte']['id']));

			}
			else
			{
				$this->Session->setFlash(___('the recolte could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		

	}

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid id for recolte', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
							//date conversion
			    $mydatefield = $this->data['Recolte']['date'];
			    $mydatefield=explode(".",$mydatefield);
			    $mydatefield=$mydatefield[2]."-".$mydatefield[1]."-".$mydatefield[0];
				#echo "Date: " .$mydatefield; exit;
				$this->data['Recolte']['date']=$mydatefield;
			
			if ($this->Recolte->save($this->data))
			{
				$this->Session->setFlash(___('the recolte has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the recolte could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$this->_set_recolte($id);

	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for recolte', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Recolte->delete($id))
		{
			$this->Session->setFlash(___('recolte deleted', true), 'flash_message', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('recolte was not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl))
	        {
	            if($this->Acl->check($this->Auth->user(), 'Recoltes/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Recolte/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Recolte->deleteAll(array('Recolte.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(___('recoltes deleted', true), 'flash_message', array('plugin' => 'alaxos'));
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(___('recoltes were not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(___('no recolte to delete was found', true), 'flash_error', array('plugin' => 'alaxos'));
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_recolte($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Recolte->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for recolte', true), 'flash_error', array('plugin' => 'alaxos'));
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('recolte', $this->data);
	}
	
	function all() {
		
	}
	
	


	

	
	
}
?>
