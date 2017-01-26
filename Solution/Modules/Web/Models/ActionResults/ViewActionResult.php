<?php

/**
 * View ActionResult
 * @package Core
 * @subpackage Models\ActionResults
 */
class ViewActionResult implements IActionResult {

    /** @var View */
    private $view;

    /**
     * ViewActionResult Constructor
     * @param string $viewPath View path
     * @param null|IModel $model ViewModel
     * @param null|string $baseDir Path where to search
     * @throws ViewNotFoundException
     */
    public function __construct($viewPath, IModel $model = null, $baseDir = null) {
        
        $this->view = new View($viewPath, $model, $baseDir);
        
    }
    
    /**
     * Render content
     */
    public function render() {
        
        $this->view->render();
        
    }
    
}