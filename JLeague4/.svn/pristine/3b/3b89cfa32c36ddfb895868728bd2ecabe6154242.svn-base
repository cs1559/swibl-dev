<?php 
	defined( '_JEXEC' ) or die( 'Restricted access' );
	
	abstract class JLBaseController extends JControllerBase
	{
		
		var $_task = null;
		var $_redirect = null;
		var $_message = null;
		var $_messageType = null;
		
		function __construct() {
			parent::__construct();
			if (isset($_REQUEST["task"])) {
				$this->setTask($_REQUEST["task"]);
			} 
		}
		
		public function getApplication() {
			$app = &JFactory::getApplication();
			return $app;
		}
	
		public function getDocument() {
			$doc = &JFactory::getDocument();
			return $doc;
		}
		
		public function execute() {
			$app = &JFactory::getApplication();
			
			// Require specific controller if requested
			if($task = $app->input->get('task','display')) {
				call_user_func(array($this,$task));
			}
		}
		
		function setTask($val) {
			$this->_task = $val;
		}
		function getTask() {
			return $this->_task;
		}
		
		function redirect()
		{
	        if ($this->_redirect) {
	                $app = &JFactory::getApplication();
	                $app->redirect($this->_redirect, $this->_message, $this->_messageType);
	        }
	        return false;
		}
		
		public function setRedirect($url, $msg = null, $type = null)
		{
			$this->_redirect = $url;
			if ($msg !== null)
			{
				// Controller may have set this directly
				$this->_message = $msg;
			}
	
			// Ensure the type is not overwritten by a previous call to setMessage.
			if (empty($type))
			{
				if (empty($this->_messageType))
				{
					$this->_messageType = 'message';
				}
			}
			// If the type is explicitly set, set it.
			else
			{
				$this->_messageType = $type;
			}
	
			return $this;
		}
		
	}
	
 
?>