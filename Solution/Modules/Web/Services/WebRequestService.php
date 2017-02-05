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
     * @return WebRequest
     */
    public function getCurrent()
    {
        $request = new WebRequest();
        $request->parameters = new WebRequestParameters($_GET, $_POST);
        $request->section = $this->getSection($request->parameters);
        $request->type = $this->getType();
        $request->headers = new WebRequestHeaders($this->_headerService->getAll());

        return $request;
    }

    /**
     * @param WebRequestParameters $parameters
     * @return string
     */
    private function getSection(WebRequestParameters $parameters)
    {
        $section = $parameters->get(WebConfiguration::$sectionRequest);

        if (!StringHelper::isNullOrEmpty($section))
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