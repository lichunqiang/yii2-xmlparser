<?php
namespace Light;

use yii\web\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testRequest()
    {
        $_SERVER["CONTENT_TYPE"] = 'application/xml; UTF-8';

        $request = new Request([
            'parsers' => [
                'application/xml' => Light\XmlParser::className(),
            ],
        ]);

        $xml_body = <<<eof
<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>
eof;

        $xml_body = <<<eof
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<Voice>
<MediaId><![CDATA[media_id]]></MediaId>
</Voice>
</xml>
eof;
        $request->setRawBody($xml_body);

        var_dump($request->post());
    }


}
