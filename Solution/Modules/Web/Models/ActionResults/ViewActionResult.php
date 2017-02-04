<?php

/**
 * View ActionResult
 */
class ViewActionResult extends ActionResult
{
    /** @var View */
    private $_view;

    /**
     * ViewActionResult Constructor
     * @param string $viewPath View path
     * @param null|IModel $model ViewModel
     * @param null|string $baseDir Path where to search
     * @throws ViewNotFoundException
     */
    public function __construct($viewPath, IModel $model = null, $baseDir = null)
    {
        $this->_view = new View($viewPath, $model, $baseDir);
    }

    /**
     * Render content
     */
    public function render()
    {
        $this->_view->render();
    }
}