<?php
class RecolteslegumesController extends AppController {

	var $name = 'Recolteslegumes';
	var $helpers = array('Form', 'Alaxos.AlaxosForm', 'Alaxos.AlaxosHtml');
	var $components = array('Alaxos.AlaxosFilter');
	function index()
	{
		$this->Recolteslegume->recursive = 0;
		$this->set('recolteslegumes', $this->paginate($this->Recolteslegume, $this->AlaxosFilter->get_filter()));
		
		$recoltes = $this->Recolteslegume->Recolte->find('list');
		$terrains = $this->Recolteslegume->Terrain->find('list');
		$legumes = $this->Recolteslegume->Legume->find('list');
		$unites = $this->Recolteslegume->Unite->find('list');
		$this->set(compact('recoltes', 'terrains', 'legumes', 'unites'));
	}

	function view($id = null)
	{
		$this->_set_recolteslegume($id);
	}

	/* ##############################
	 * #### add1 and add2 are quick'n'dirty ajax styles for getting the price of the vegetable, extracting form first previous price ######## */
	function add1()
	{
		if (!empty($this->data))
		{
			$this->Recolteslegume->create();
		}
		$recoltes = $this->Recolteslegume->Recolte->find('list');
		$options=array("order"=>"lib");
		$terrains = $this->Recolteslegume->Terrain->find('list',$options);
		$options=array("order"=>"lib");
		$legumes = $this->Recolteslegume->Legume->find('list',$options);
		$unites = $this->Recolteslegume->Unite->find('list');
		$this->set(compact('recoltes', 'terrains', 'legumes', 'unites'));
	}
	function add2()
	{
		//do not display layout
		$this->layout = '';
		$recolte=$_POST['data'][Recolteslegume][recolte];
		$legume=$_POST['data'][Recolteslegume][legume_id];

		echo "legume: " .$legume ." recolte: " .$recolte;
		#echo $legume;
	$sql="SELECT * FROM recolteslegumes as rl  	 
	WHERE rl.legume_id=" .$legume ." AND rl.prixminPER > 0 ORDER BY rl.id DESC";
	#echo "<pre>" .nl2br($sql) ."</pre>"; exit; //tests

	$sql=mysql_query($sql);

	if(!$sql) {
		echo "<br>SQL error: ".mysql_error() ."<br>"; exit;
		} else {
		$prixminPER=mysql_result($sql, 0, 'prixminPER');
		$prixmaxPER=mysql_result($sql,0,'prixmaxPER');
		$prixminBIO=mysql_result($sql,0,'prixminBIO');
		$prixmaxBIO=mysql_result($sql,0,'prixmaxBIO');
		$url="add?recolte=" .$recolte ."&legume=" .$legume ."&prixminPER=" .$prixminPER ."&prixmaxPER=" .$prixmaxPER ."&prixminBIO=" .$prixminBIO ."&prixmaxBIO=".$prixmaxBIO;
	//echo $url; exit;
				
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';

		?>
		<?php
		}
	}
	/* ##############################
	 * #### add1 and add2 are quick'n'dirty ajax styles for getting the price of the vegetable, extracting form first previous price END ######## */
	 
	function add()
	{
		if (!empty($this->data))
		{
			$this->Recolteslegume->create();
			if ($this->Recolteslegume->save($this->data))
			{
				$this->Session->setFlash(___('the recolteslegume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
#				$this->redirect(array('action' => 'index'));
				$this->redirect(array('action' => 'add1?recolte=' .$this->data['Recolteslegume']['recolte_id']));

			}
			else
			{
				$this->Session->setFlash(___('the recolteslegume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		$options=array("order"=>"lib");
		$recoltes = $this->Recolteslegume->Recolte->find('list');
		$options=array("order"=>"lib");
		$terrains = $this->Recolteslegume->Terrain->find('list',$options);
		$options=array("order"=>"lib");
		$legumes = $this->Recolteslegume->Legume->find('list',$options);
		$unites = $this->Recolteslegume->Unite->find('list');
		$this->set(compact('recoltes', 'terrains', 'legumes', 'unites'));
	}
	

	function edit($id = null)
	{
		if (!$id && empty($this->data))
		{
			$this->Session->setFlash(___('invalid id for recolteslegume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data))
		{
			if ($this->Recolteslegume->save($this->data))
			{
				$this->Session->setFlash(___('the recolteslegume has been saved', true), 'flash_message', array('plugin' => 'alaxos'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(___('the recolteslegume could not be saved. Please, try again.', true), 'flash_error', array('plugin' => 'alaxos'));
			}
		}
		
		$this->_set_recolteslegume($id);
		
		$recoltes = $this->Recolteslegume->Recolte->find('list');
		$terrains = $this->Recolteslegume->Terrain->find('list');
		$legumes = $this->Recolteslegume->Legume->find('list');
		$unites = $this->Recolteslegume->Unite->find('list');
		$this->set(compact('recoltes', 'terrains', 'legumes', 'unites'));
	}

	function delete($id = null)
	{
		if (!$id)
		{
			$this->Session->setFlash(___('invalid id for recolteslegume', true), 'flash_error', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Recolteslegume->delete($id))
		{
			$this->Session->setFlash(___('recolteslegume deleted', true), 'flash_message', array('plugin' => 'alaxos'));
			$this->redirect(array('action'=>'index'));
		}
			
		$this->Session->setFlash(___('recolteslegume was not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
		$this->redirect(array('action' => 'index'));
	}
	
	function actionAll()
	{
	    if(!empty($this->data['_Tech']['action']))
	    {
            if(isset($this->Acl))
	        {
	            if($this->Acl->check($this->Auth->user(), 'Recolteslegumes/' . $this->data['_Tech']['action']))
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
	    $ids = Set :: extract('/Recolteslegume/id[id > 0]', $this->data);
	    if(count($ids) > 0)
	    {
    	    if($this->Recolteslegume->deleteAll(array('Recolteslegume.id' => $ids), false, true))
    	    {
    	        $this->Session->setFlash(___('recolteslegumes deleted', true), 'flash_message', array('plugin' => 'alaxos'));
    			$this->redirect(array('action'=>'index'));
    	    }
    	    else
    	    {
    	        $this->Session->setFlash(___('recolteslegumes were not deleted', true), 'flash_error', array('plugin' => 'alaxos'));
    	        $this->redirect(array('action' => 'index'));
    	    }
	    }
	    else
	    {
	        $this->Session->setFlash(___('no recolteslegume to delete was found', true), 'flash_error', array('plugin' => 'alaxos'));
    	    $this->redirect(array('action' => 'index'));
	    }
	}
	
	
	
	function _set_recolteslegume($id)
	{
		if(empty($this->data))
	    {
    	    $this->data = $this->Recolteslegume->read(null, $id);
            if($this->data === false)
            {
                $this->Session->setFlash(___('invalid id for recolteslegume', true), 'flash_error', array('plugin' => 'alaxos'));
                $this->redirect(array('action' => 'index'));
            }
	    }
	    
	    $this->set('recolteslegume', $this->data);
	}
	
	/* function to extract vegetable statistics */
	function statistiques()
	{
		$options=array("order"=>"date");		
		$recoltes = $this->Recolteslegume->Recolte->find('list',$options);
		$recoltesF = $this->Recolteslegume->Recolte->find('list',$options);
		$options=array("order"=>"lib");
		$terrains = $this->Recolteslegume->Terrain->find('list',$options);
		$legumes = $this->Recolteslegume->Legume->find('list',$options);
		$unites = $this->Recolteslegume->Unite->find('list',$options);
		#$classifications = $this->Recolteslegume->Classification->find('list');
		#$classifications = $this->Legume->Classification->find('list');
		#$this->set(compact('recoltes', 'terrains', 'legumes', 'unites', 'classifications'));
		$this->set(compact('recoltes', 'recoltesF', 'terrains', 'legumes', 'unites'));
	}
	
}
?>
