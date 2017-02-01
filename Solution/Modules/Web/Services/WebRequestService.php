<?php

/**
 * WebRequest Service
 */
class WebRequestService implements IWebRequestService
{
    /** @var IHeaderService */
    private $_headerService;

    /**
     * WebRequestService Constructor
     * @param IHeaderService $headerService
     */
    public function __construct(IHeaderService $headerService)
    {
        $this->_headerService = $headerService;
    }

    /**
     * @return IFrameworkRequest
     */
    public function getCurrent()
    {
        $request = new IFrameworkRequest();
        $request->parameters = new IFrameworkRequestParameters($_GET, $_POST);
        $request->section = $this->getSection($request->parameters);
        $request->type = $this->getType();
        $request->headers = new WebRequestHeaders($this->_headerService->getAll());

        return $request;
    }

    /**
     * @param IFrameworkRequestParameters $parameters
     * @return string
     */
    private function getSection(IFrameworkRequestParameters $parameters)
    {
        $section = $parameters->get(WebConfiguration::$sectionRequest);

        if (!ValidationHelper::isNullOrEmpty($section))
        {
            return $section;
        }

        return WebConfiguration::$defaultSection;
    }

    /**
     * @return string
     */
    private function getType()
    {
        if (isset($_SERVER['REQUEST_METHOD']))
        {
            return $_SERVER['REQUEST_METHOD'];
        }

        return RequestType::Get;
    }
}