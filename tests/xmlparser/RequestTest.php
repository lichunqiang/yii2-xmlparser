<?php
namespace Light;

use yii\web\Request;
use yii\web\BadRequestHttpException;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $_SERVER["CONTENT_TYPE"] = 'application/xml; UTF-8';
    }

    public function testOnelevel()
    {
        $request = new Request([
            'parsers' => [
                'application/xml' => XmlParser::className(),
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

        $request->setRawBody($xml_body);

        $result = $request->post();

        $this->assertArrayHasKey('MsgId', $result);

        $this->assertEquals('1234567890123456', $result['MsgId']);
    }

    public function testMultiLevel()
    {
        $request = new Request([
            'parsers' => [
                'application/xml' => XmlParser::className(),
            ],
        ]);

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

        $result = $request->post();

        $this->assertArrayHasKey('ToUserName', $result);

        $this->assertEquals('toUser', $result['ToUserName']);

        $this->assertEquals(['MediaId' => 'media_id'], $result['MediaId']);
    }

    /**
     * @expectedException BadRequestHttpException
     */
    public function testException()
    {
        $request = new Request([
            'parsers' => [
                'application/xml' => XmlParser::className(),
            ],
        ]);

        $request->setRawBody('test');

        $request->post();
    }

    public function testNotThrowException()
    {
        $request = new Request([
            'throwException' => false,
            'parsers' => [
                'application/xml' => XmlParser::className(),
            ],
        ]);

        $request->setRawBody('test');

        $this->assertEquals(null, $request->post());
    }
}
