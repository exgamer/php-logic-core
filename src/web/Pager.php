<?php
namespace concepture\php\logic\core\web;

use concepture\php\logic\core\web\pager\Pager as Base;

/**
 * Class Pager
 * @package Legal\SymfonyCore\Pager
 * @author citizenzet <exgamer@live.ru>
 */
class Pager extends Base
{
    protected $route;
    protected $queryParams = [];
    /**
     * callback для генерации урл
     *
     *      'urlGenCallback' => function($route, $queryParams){
     *
     *             return $this->generateUrl($route, $queryParams);
     *       }
     */
    protected $urlGenCallback;

    /**
     * @return string
     */
    protected function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    protected function setRoute(string $route): void
    {
        $this->route = $route;
    }

    /**
     * @return array
     */
    protected function getQueryParams() : array
    {
        return $this->queryParams;
    }

    /**
     * @param array $queryParams
     */
    protected function setQueryParams(array $queryParams): void
    {
        $this->queryParams = $queryParams;
    }

    /**
     * @return callable
     */
    public function getUrlGenCallback() : callable
    {
        return $this->urlGenCallback;
    }

    /**
     * @param callable $urlGenCallback
     */
    public function setUrlGenCallback(callable $urlGenCallback): void
    {
        $this->urlGenCallback = $urlGenCallback;
    }

    /**
     * Возвращает массив с данными пагинатора
     *
     * [
     *      page => [
     *        'label' => 1,
     *        'url' => '/someurl/?page=1'
     *     ]
     * ]
     *
     * @return array
     */
    public function getPagesToShow() : array
    {
        $pagesToShow = parent::getPagesToShow();
        foreach ($pagesToShow as $page => &$props){
            $url = "unknown";
            $queryParams = $this->getQueryParams();
            $queryParams['page'] = $page;
            if (is_callable($this->getUrlGenCallback())) {
                $url = call_user_func($this->getUrlGenCallback(), $this->getRoute(), $queryParams);
            }
            $props['url'] = $url;
        }

        return $pagesToShow;
    }

}