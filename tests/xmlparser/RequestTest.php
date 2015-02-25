<?php
namespace light\yii2;

use yii\web\Request;

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

        $this->assertEquals('media_id', $result['Voice']['MediaId']);
    }

    public function testNoCData()
    {
        $request = new Request([
            'parsers' => [
                'application/xml' => XmlParser::className(),
            ],
        ]);

        $xml_body = '<xml><ToUserName>test</ToUserName></xml>';
        $request->setRawBody($xml_body);

        $result = $request->post();

        $this->assertArrayHasKey('ToUserName', $result);
    }

    // /**
    //  * @expectedException \yii\web\BadRequestHttpException
    //  */
    // public function testException()
    // {
    //     $request = new Request([
    //         'parsers' => [
    //             'application/xml' => XmlParser::className(),
    //         ],
    //     ]);

    //     $request->setRawBody('<!DOCTYPE html>');

    //     $request->post();
    // }

    // public function testNotThrowException()
    // {
    //     $request = new Request([
    //         'parsers' => [
    //             'application/xml' => ['class' => XmlParser::className(), 'throwException' => false],
    //         ],
    //     ]);

    //     $request->setRawBody('test');

    //     $this->assertEquals(null, $request->post());
    // }
}
