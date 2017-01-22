<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 22/01/2017
 * Time: 1:20
 */
class UnitTestsInstaller implements IProjectInstaller
{
    private $_installerContainer;

    /**
     * UnitTestsInstaller constructor.
     * @param IInstallerContainer $installerContainer
     */
    public function __construct(
        IInstallerContainer $installerContainer
    )
    {
        $this->_installerContainer = $installerContainer;
    }

    /**
     * Install
     */
    public function install()
    {
        if (Configuration::$project === 'UnitTests')
        {
            $this->_installerContainer->registerDefinition('ICookieService', 'CookieServiceMock');
        }
    }
}