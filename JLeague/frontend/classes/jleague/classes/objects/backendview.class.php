<?php
/**
 * @version		$Id: backendview.class.php 319 2011-12-24 10:06:57Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2008-2012 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license See license.html
 * 
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'baseview.class.php');

/**
 * The JLBackendBaseView is the view that all backend views should extend from.
 *
 */
class JLBackendBaseView extends JLBaseView {

	protected $task=null;
	
	function __construct($task=null) {
		parent::__construct();
		$this->task=$task;
	}
	
	function display() {
		
		// Add CORE JLeague JS Libraries
// 		JLApplication::addScript(JURI::root() . 'components/com_jleague/js/jquery-ui-1.7.2.custom.min.js');
		JLApplication::addScript(JURI::root() . 'administrator/components/com_jleague/js/jleague.js');
			
// 		$this->addStylesheet(JLEAGUE_ASSETS_URL . '/jquery-theme/smoothness/jquery-ui-1.7.2.custom.css');
		
		$toolbarmethod = "get" . ucfirst($this->task) . "Toolbar";
		if ($this->task == "edit" || $this->task == "apply") {
			if( method_exists( $this , 'getEditToolbar') )
			{
				$this->getEditToolbar();
			}
		} else {
			if (method_exists( $this, $toolbarmethod ) ) {
				//call_user_func(array( $updater , 'update_'.$dbversion ) );
				call_user_func( array($this, $toolbarmethod),null);
			} else {
				if( method_exists( $this , 'getDefaultToolbar') )
				{
					$this->getDefaultToolbar();
				}
			}
		}
				
		if (count($this->objects) > 0) {
			extract($this->objects);	
		}
		
		if (!$this->getTitle() ==null) {
			JToolBarHelper::title( JLText::getText( $this->getTitle() ), 'jleague');			
		}
		$this->generateJavascriptLinks();
		$this->generateStylesheetLinks();

		if (method_exists($this, 'getSubmenu')) {
			$this->getSubmenu();	
		}
		
		//include(JLEAGUE_CLASSES_VIEW_PATH . DS. 'template'. DS . $this->template . '.php');
		if (!empty($this->templates)) {
			foreach ($this->templates as $template) {
				if (is_object($template)) {
					$template->parse();
				}
			} 
		} else {
			echo "No Templates Defined for view";
		}
	}
	
	function addIcon( $image , $url , $text , $newWindow = false )
	{
		$lang		=& JFactory::getLanguage();
		$newWindow	= ( $newWindow ) ? ' target="_blank"' : '';
?>
		<div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
			<div class="icon">
				<a href="<?php echo $url; ?>"<?php echo $newWindow; ?>>
					<?php echo JHTML::_('image', 'administrator/components/com_jleague/assets/images/' . $image , NULL, NULL, $text ); ?>
					<span><?php echo $text; ?></span></a>
			</div>
		</div>
<?php
	}
	
}

?>