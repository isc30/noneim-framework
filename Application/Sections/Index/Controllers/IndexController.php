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
        $noticia = new Noticia();
        $noticia->titulo = 'Nueva Noticia';
        $noticia->contenido = 'Contenido de la nueva noticia';

        $this->_noticiaRepository->add($noticia);

        $noticias = $this->_noticiaRepository->toArray(QueryBuilder::get());
        var_dump($noticias);

        $actionResult = new BasePartialActionResult();
        $actionResult->title = 'Welcome!';
        $actionResult->actionResult = new ViewActionResult('Index', null, __FILE__);

        return $actionResult;
    }
}