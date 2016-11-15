<?php

namespace Training2\Specific404Page\Controller;

use Magento\Framework\App\RequestInterface as Request;

class NoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    /**
     * @param Request $request
     * @return bool
     */
    public function process(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $parts = explode('/', trim($pathInfo, '/'));

        $moduleName = isset($parts[0]) ? $parts[0] : '';
        $actionPath = isset($parts[1]) ? $parts[1] : '';
        $actionName = isset($parts[2]) ? $parts[2] : '';

        if($moduleName == 'catalog' && $actionPath == 'product' && $actionName == 'view') {
            $request->setModuleName('specific404page')
                    ->setControllerName('noroute')
                    ->setActionName('product');
        }elseif($moduleName == 'catalog' && $actionPath == 'category' && $actionName == 'view'){
            $request->setModuleName('specific404page')
                ->setControllerName('noroute')
                ->setActionName('category');
        } else {
            $request->setModuleName('specific404page')
                ->setControllerName('noroute')
                ->setActionName('other');
        }
        return false;
    }
}