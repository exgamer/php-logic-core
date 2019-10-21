<?php
namespace concepture\php\logic\core\web;

use concepture\php\core\helper\ArrayHelper;
use concepture\php\logic\core\db\DataProvider;

/**
 * Class WebDataProvider
 * @package concepture\php\logic\core\web
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class WebDataProvider extends DataProvider
{
    protected $pagerConfig = [];
    protected $pager;

    /**
     * executes data provider
     */
    protected function execute()
    {
        parent::execute();
        $this->createPager();
    }

    /**
     * @return Pager
     */
    public function getPager()
    {
        return $this->pager;
    }

    /**
     * @return array
     */
    public function getPagerConfig(): array
    {
        return $this->pagerConfig;
    }

    /**
     * @param array $pagerConfig
     */
    public function setPagerConfig(array $pagerConfig)
    {
        $this->pagerConfig = $pagerConfig;
    }

    /**
     * Создание Pager
     */
    protected function createPager()
    {
        $pagerConfig = $this->getPagerConfig();
        $exConfig = [
            'totalCount' => $this->getTotalCount(),
            'page' => $this->getPage(),
            'pageSize' => $this->getPageSize(),
            'queryParams' => $this->getQueryParams(),
        ];
        $pagerConfig = ArrayHelper::merge($pagerConfig, $exConfig);
        $this->pager = new Pager($pagerConfig);
    }
}