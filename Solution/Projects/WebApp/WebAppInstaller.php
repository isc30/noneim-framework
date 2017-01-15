<?php

/**
 * Solution Installer
 * @package Solution
 */
class WebAppInstaller implements IInstaller
{
    /** @var IInstallerContainer */
    private $_installerContainer;

    /**
     * ApplicationInstaller Constructor
     * @param IInstallerContainer $installerContainer
     */
    public function __construct(IInstallerContainer $installerContainer)
    {
        $this->_installerContainer = $installerContainer;
    }

    /**
     * Install
     */
    public function install()
    {
        switch ($this->_installerContainer->getType())
        {
            case 'WebApp':
            {
                echo 'WebApp installer!';
                break;
            }
        }
    }
}
