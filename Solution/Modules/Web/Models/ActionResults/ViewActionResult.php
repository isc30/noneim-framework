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
     * @param null|string $basePath Path where to search
     * @throws ViewNotFoundException
     */
    public function __construct($viewPath, IModel $model = null, $basePath = null) {
        
        $this->view = new View($viewPath, $model, $basePath);
        
    }
    
    /**
     * Render content
     */
    public function render() {
        
        $this->view->render();
        
    }
    
}