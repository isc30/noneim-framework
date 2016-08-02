<?php

/**
 * Index Controller
 * @package Application
 * @subpackage Controllers
 */
class IndexController implements IController {

    /** @var IClassFactory */
    private $_classFactory;
    /** @var IConnectionContainer */
    private $_connectionContainer;
    /** @var ILogService */
    private $_logService;
    /** @var IRegionRepository */
    private $_regionRepository;

    /**
     * IndexController Constructor
     * @param IClassFactory $classFactory
     * @param IConnectionContainer $connectionContainer
     * @param ILogService $logService
     * @param IRegionRepository $regionRepository
     * @param ILanguageService $languageService
     */
    public function __construct(
        IClassFactory $classFactory,
        IConnectionContainer $connectionContainer,
        ILogService $logService,
        IRegionRepository $regionRepository,
        ILanguageService $languageService
    ) {
        $this->_classFactory = $classFactory;
        $this->_connectionContainer = $connectionContainer;
        $this->_logService = $logService;
        $this->_regionRepository = $regionRepository;
        var_dump($languageService->getLanguage());
    }

    /**
     * Main Action
     * @return IActionResult
     */
    public function index()
    {
        $this->_logService->log('SALUDANDOOOO');

        $viewModel = new DynamicViewModel();
        $viewModel->nombre = 'ISC';
        $viewModel->regions = array();

        for ($i = 0; $i < 5; $i++)
        {
            $region = new Region();
            $region->id = $i;
            $region->name = "Region {$i}";
            $viewModel->regions[] = $region;
        }

        $pdo = $this->_connectionContainer->PDO();
        $prepared = $pdo->prepare('SELECT name FROM tbLocation__Region');
        $prepared->execute();
        var_dump($prepared->fetchAll());

        return $this->_classFactory->call('BaseController', 'index', array(
            'title' => 'Index Page',
            'content' => new ViewActionResult('Index', $viewModel, __FILE__)
        ));
    }
}