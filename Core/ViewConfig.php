<?php

namespace Nnapiconfigure\Core;

use OxidEsales\Eshop\Core\Registry;


class ViewConfig extends ViewConfig_parent
{

 
    public function getNovalnetShopUrl()
    {
        $oConfig = \OxidEsales\Eshop\Core\Registry::getConfig();
    
        $sURL = $oConfig->getConfigParam('sShopURL') . $oConfig->getConfigParam('sAdminDir') . "/";

        if ($oConfig->getConfigParam('sAdminSSLURL')) {
            $sURL = $oConfig->getConfigParam('sAdminSSLURL');
        }

        return $sURL;
    }



 
    public function getShopTheme()
    {
        $oTheme = oxNew('oxTheme');
        return $oTheme->getActiveThemeId();
    }


    public function getConfig()
    {
        return Registry::getConfig();
    }

    public function getSession()
    {
        return Registry::getSession();
    }


  
    public function getShopUrl()
    {
        return rtrim(Registry::getConfig()->getSslShopUrl(), '/').'/';
    }



   
    public function getTimeStamp()
    {
        return time();
    }
}

