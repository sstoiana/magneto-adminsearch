<?php

class Magneto_Adminsearch_Block_Search extends Mage_Adminhtml_Block_Widget
{
	public function getFullPath($node)
	{
		$path = $node->getName();
		$parent = $node;
		while($parent)
		{
			
			try{
				$x = $parent->xpath('..');
				if(isset($x[0])) { $parent = $x[0]; } else { throw new Exception(); }
			} catch (Exception $e) { $parent = null; continue;}
			
			$path = $parent->getName().'/'.$path;	
		}
		return '/'.$path;
	}
	
	public function getConfigsObject()
	{
		$config = Mage::getSingleton('adminhtml/config');
		
		$results = $config->getSections()->xpath("//fields/*/label");
		
		$return['fields'] = array();
		foreach($results as $node)
		{
			$helperName = $config->getAttributeModule($node->getParent()->getParent()->getParent()->getParent()->getParent(), $node->getParent()->getParent()->getParent(), $node->getParent());
			
			$return['fields'][$this->getFullPath($node)] = Mage::helper($helperName)->__( (string)$node );
			// $return['fields'][$this->getFullPath($node)] = $this->__( (string)$node );
		}
		
		$results = $config->getSections()->xpath("//groups/*/label");
		
		$return['groups'] = array();
		foreach($results as $node)
		{
			$helperName = $config->getAttributeModule($node->getParent()->getParent()->getParent(), $node->getParent() );
			
			$return['groups'][$this->getFullPath($node)] = Mage::helper($helperName)->__( (string)$node );
			//$return['groups'][$this->getFullPath($node)] = $this->__( (string)$node );
		}
		
		return json_encode($return);
	} 
}
