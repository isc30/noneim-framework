<?php

/**
 * View
 */
class View implements IModel
{
    /** @var string */
    private $_view;

    /** @var null|IModel */
    private $_model;

    /**
     * View Constructor
     * @param string $viewPath View path
     * @param null|IModel $model ViewModel
     * @param null|string $baseDir Dir where to search. Default: __FILE__
     * @throws ViewNotFoundException
     */
    public function __construct($viewPath, IModel $model = null, $baseDir = null)
    {
        if ($baseDir !== null)
        {
            $baseDir = dirname($baseDir);
        }
        else
        {
            $baseDir = SolutionConfiguration::$staticDir;
        }

        $view = dirname($baseDir) . "/Views/{$viewPath}.phtml";

        if (!file_exists($view))
        {
            throw new ViewNotFoundException($view);
        }

        $this->_view = $view;
        $this->_model = $model;
    }

    /**
     * Render
     */
    public function render()
    {
        /** @noinspection PhpUnusedLocalVariableInspection */
        $model = $this->_model; // Make model accessible from the template

        /** @noinspection PhpIncludeInspection */
        require $this->_view;
    }

    /**
     * Render to string
     * @return string
     */
    public function renderToString()
    {
        OutputBufferHelper::start();
        {
            $this->render();
            $content = OutputBufferHelper::getContent();
        }
        OutputBufferHelper::end();

        return $content;
    }
}