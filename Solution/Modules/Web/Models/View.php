<?php

/**
 * View
 * @package Core
 * @subpackage Models\BusinessObjects
 */
class View implements IModel
{
    /** @var string */
    private $view;

    /** @var null|IModel */
    private $model;

    /**
     * View Constructor
     * @param string $viewPath View path
     * @param null|IModel $model ViewModel
     * @param null|string $basePath Path where to search. Default: __FILE__
     * @throws ViewNotFoundException
     */
    public function __construct($viewPath, IModel $model = null, $basePath = null)
    {
        if ($basePath !== null)
        {
            $basePath = dirname($basePath);
        }
        else
        {
            $basePath = Configuration::$staticPath;
        }

        $view = dirname($basePath) . "/Views/{$viewPath}.phtml";

        if (!file_exists($view))
        {
            throw new ViewNotFoundException($view);
        }

        $this->view = $view;
        $this->model = $model;
    }

    /**
     * Render
     */
    public function render()
    {
        /** @noinspection PhpUnusedLocalVariableInspection */
        $model = $this->model; // Make model accessible from the template

        /** @noinspection PhpIncludeInspection */
        require $this->view;
    }
}