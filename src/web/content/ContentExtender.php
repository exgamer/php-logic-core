<?php
namespace concepture\php\logic\core\web\content;

use concepture\php\data\core\transformer\DataTransformer;
use concepture\php\core\helper\StringHelper;
use concepture\php\logic\core\service\Service;
use ReflectionException;

/**
 * Класс для замены плеисхолдеров  контента на блоки
 * Класс вызывает методы установленного сервиса в зависимости от плеисхолдера
 * плеисхолдеры должны быть в формате __PLACE_HOLDER__
 * к примеру тогда вызовается метод сервиса $this->service->placeHolder()
 *
 * Class ContentExtender
 * @package concepture\php\logic\core\web\content
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
abstract class ContentExtender extends DataTransformer
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return Service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Возвращает результат
     *
     *
     * @return string
     * @throws ReflectionException
     */
    public function getResult() : string
    {
        $content = $this->getData();
        $blockPlaceholders = static::placeholders();
        foreach ($blockPlaceholders as $placeholder){
            if ( strpos($content, $placeholder) === false){
                continue;
            }

            $method = $this->getServiceMethodName($placeholder);
            $placeholderContent = $this->getService()->{$method}($this->getConfig());
            $content = str_replace($placeholder, $placeholderContent, $content);
        }

        return $content;
    }

    /**
     * Возвращает возможные плеисхолдеры дял замены контента
     *
     * @return array
     */
    protected static function placeholders() : array
    {
        return [];
    }

    /**
     * Возвращает название метода сервиса в зависимости от паттерна плеисхолдера в camelcase
     * плеисхолдеры должны быть в формате __PLACE_HOLDER__
     * к примеру тогда вызовается метод сервиса $this->service->placeHolder()
     *
     * @param $placeholder
     * @return mixed
     */
    protected function getServiceMethodName($placeholder)
    {
        $method = trim($placeholder, "__");

        return StringHelper::underscoreToCamelCase($method);
    }
}