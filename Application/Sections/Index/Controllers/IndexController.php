<?php

/**
 * Index Controller
 * @package Application
 * @subpackage Controllers
 */
class IndexController implements IController
{
    private $_noticiaRepository;

    /**
     * IndexController Constructor
     * @param INoticiaRepository $noticiaRepository
     */
    public function __construct(INoticiaRepository $noticiaRepository)
    {
        $this->_noticiaRepository = $noticiaRepository;
    }

    /**
     * Default Action
     * @return IActionResult
     */
    public function index()
    {
        $noticia = $this->_noticiaRepository->getById(1);
        $noticia->titulo = rand(2, 999999);

        $this->_noticiaRepository->edit($noticia);

        var_dump($this->_noticiaRepository->toArray(QueryBuilder::get()));

        $actionResult = new BasePartialActionResult();
        $actionResult->title = 'Welcome!';
        $actionResult->actionResult = new ViewActionResult('Index', null, __FILE__);

        return $actionResult;
    }
}