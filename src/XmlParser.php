<?php
namespace Light;

use yii\base\Object;
use yii\web\RequestParserInterface;
use yii\web\BadRequestHttpException;

class XmlParser extends Object implements RequestParserInterface
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
            return json_decode(json_encode(simplexml_load_string($rawBody, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        } catch (Exception $e) {
            if ($this->throwException) {
                throw new BadRequestHttpException($e->getMessage, 0, $e);
            }
            return null;
        }
    }
}
