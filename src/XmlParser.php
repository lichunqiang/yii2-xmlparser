<?php
namespace Light;

use yii\base\Object;
use yii\web\BadRequestHttpException;
use yii\web\RequestParserInterface;

class XmlParser extends Object implements RequestParserInterface
{
    /**
     * If parser result as array, this is default
     * @var boolean
     */
    public $asArray = true;
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
        libxml_use_internal_errors(true);

        $result = simplexml_load_string($rawBody, 'SimpleXMLElement', LIBXML_NOCDATA);

        if ($result === false) {
            $errors = libxml_get_errors();
            $latestError = array_pop($errors);
            $error = array(
                'message' => $latestError->message,
                'type' => $latestError->level,
                'code' => $latestError->code,
                'file' => $latestError->file,
                'line' => $latestError->line,
            );
            if ($this->throwException) {
                throw new BadRequestHttpException($error);
            }
            return $error;
        }

        if (!$this->asArray) {
            return $result;
        }

        return json_decode(json_encode($result), true);
    }
}
