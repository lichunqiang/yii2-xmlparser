<?php
namespace light;

use yii\helpers\Json;
use yii\web\RequestParserInterface;

class XmlParser extends RequestParserInterface
{
    /**
     * Whether throw the [[BadRequestHttpException]] if the process error.
     * @var boolean
     */
    public $throwException = true;

    /**
     * @inheritdoc
     */
    public function parse($rawBody, $contentType)
    {
        try {
            return Json::decode(Json::encode(simplexml_load_string($rawBody, 'SimpleXMLElement', LIBXML_NOCDATA)));
        } catch (Exception $e) {
            if ($this->throwException) {
                throw new BadRequestHttpException($e->getMessage, 0, $e);
            }
            return null;
        }
    }
}