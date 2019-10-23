<?php
namespace concepture\php\logic\core\web\content;

/**
 * Interface ContentExtenderInterface
 * @package App\Controller\Test
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
interface ContentExtenderInterface
{
    public function getResult() : string;
    public static function placeholders() : array;
}
