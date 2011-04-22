<?php
class Magneto_Adminsearch_Adminhtml_Adminsearch_IndexController extends Mage_Adminhtml_Controller_Action
{
	protected function _construct()
    {
        // Define module dependent translate
        $this->setUsedModuleName('Magneto_Adminsearch');
    }
	
	public function getFullPath($node)
	{
		$path = $node->getName();
		$parent = $node;
		while($parent)
		{
			
			try{
				$parent = $parent->getParent();
			} catch (Exception $e) { $parent = null; continue;}
			
			$path = $parent->getName().'/'.$path;	
		}
		return '/'.$path;
	}
	
	public function getFullPaths($nodes) {
		$paths = array();
		foreach($nodes as $node)
		{
			$paths[] = $this->getFullPath($node);
		}
		
		return array_values(array_unique($paths));
	}
	
	public function getGroupIds($nodes) {
		$paths = array();
		foreach($nodes as $node)
		{
			$t = explode('/',$this->getFullPath($node));
			$paths[] = $t[3].'_'.$t[5];
		}
		
		return array_values(array_unique($paths));
	}
	
	public function getLabelIds($nodes) {
		$paths = array();
		foreach($nodes as $node)
		{
			$t = explode('/',$this->getFullPath($node));
			$paths[] = $t[3].'_'.$t[5].'_'.$t[7];
		}
		
		return array_values(array_unique($paths));
	}
	
	public function getSections($nodes) {
		$sections = array();
		foreach($nodes as $node)
		{
			$sections[] = $node->getParent()->getParent()->getParent()->getParent()->getParent()->getName();
		}
		
		return array_values(array_unique($sections));
	}
	
    public function searchAction() {
    	
        if( $this->getRequest()->isPost() ){
            $result['error'] = 0;

            $query = $this->getRequest()->getPost('query');
            if( !empty($query) ){
            	$query = trim($query);
                $configs = Mage::getSingleton('adminhtml/config')->getSections();
                $items = array();
                Magneto_Debug_Block_Config::xml2array($configs, $items, $query);
                $result['items'] = $items;
                
				$results = $configs->xpath("//fields/*/label[contains(translate(., 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'),'".$query."')]"); 
				
				$return = array();
				
				// var_dump($items);
				$return['sections'] = $this->getSections($results);
				$return['paths'] = $this->getFullPaths($results);
				$return['group_ids'] = $this->getGroupIds($results);
				$return['label_ids'] = $this->getLabelIds($results);
				
				$this->getResponse()->setBody(json_encode($return));
                // $block = new Mage_Core_Block_Template(); //Is this the correct way?
                // $block->setTemplate('debug/configsearch.phtml');
                // $block->assign('items', $items);
                // echo $block->toHtml();

            } else {
                $result['error'] = 1;
                $result['message'] = 'Search query cannot be empty.';
            }
        }
    }
}
