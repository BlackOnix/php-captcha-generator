<?php
class CaptchaGeneratorTest extends PHPUnit_Framework_TestCase
{
  /**
   * @var CaptchaGenerator
   */
  protected $_captcha;

  protected $_phraselength = 5;

  /**
   * Prepares the environment before running a test.
   */
  protected function setUp()
  {
    parent::setUp();

    $this->_captcha = new CaptchaGenerator(
      dirname(dirname(__FILE__)) . '/tests/_drafts/arial.ttf',
      dirname(dirname(__FILE__)) . '/tests/_drafts/pwdimage.png',
      $this->_phraselength
    );
  }

  /**
   * Cleans up the environment after running a test.
   */
  protected function tearDown()
  {
    unset($this->_captcha);
    parent::tearDown();
  }

  public function testCreateNewCaptchageneratorObjectNoException()
  {
    $this->assertInstanceOf('CaptchaGenerator', $this->_captcha);
  }

  /**
   * @depends CaptchaGeneratorTest::testCreateNewCaptchageneratorObjectNoException
   * @expectedException InvalidArgumentException
   */
  public function testInvalidArgumentExceptionIfSetFont()
  {
    $this->_captcha->setFont('some/bad/font.ttf');
  }

  /**
   * @depends CaptchaGeneratorTest::testCreateNewCaptchageneratorObjectNoException
   * @expectedException InvalidArgumentException
   */
  public function testInvalidArgumentExceptionIfSetImage()
  {
    $this->_captcha->setImage('some/bad/image.png');
  }

  public function isIntDataProvider()
  {
    return array(
      array( 1.1 ),
      array( '1.1' ),
      array( true ),
      array( array() ),
      array( new stdClass() ),
      array( ' ' ),
      array( null ),
    );
  }

  /**
   * @depends CaptchaGeneratorTest::testCreateNewCaptchageneratorObjectNoException
   * @expectedException InvalidArgumentException
   * @provider isIntDataProvider
   */
  public function testInvalidArgumentExceptionIfSetFontsize($testData)
  {
    $this->_captcha->setFontSize($testData);
  }

  public function testSetFontsize()
  {
    $this->assertInstanceOf(
      'CaptchaGenerator', $this->_captcha->setFontSize(123)
    );
  }

  /**
   * @depends CaptchaGeneratorTest::testCreateNewCaptchageneratorObjectNoException
   * @expectedException InvalidArgumentException
   * @provider isIntDataProvider
   */
  public function testInvalidArgumentExceptionIfSetFontxmargin($testData)
  {
    $this->_captcha->setFontXmargin($testData);
  }

  public function testSetFontxmargin()
  {
    $this->assertInstanceOf(
      'CaptchaGenerator', $this->_captcha->setFontXmargin(13)
    );
  }

  /**
   * @depends CaptchaGeneratorTest::testCreateNewCaptchageneratorObjectNoException
   * @expectedException InvalidArgumentException
   * @provider isIntDataProvider
   */
  public function testInvalidArgumentExceptionIfSetFontymargin($testData)
  {
    $this->_captcha->setFontYmargin($testData);
  }

  public function testSetFontymargin()
  {
    $this->assertInstanceOf(
      'CaptchaGenerator', $this->_captcha->setFontYmargin(31)
    );
  }

  public function testSetFontcolor()
  {
    $this->assertInstanceOf(
      'CaptchaGenerator', $this->_captcha->setFontColor(CaptchaGenerator::FONT_COLOR_BLUE)
    );
  }

  /**
   * @depends CaptchaGeneratorTest::testCreateNewCaptchageneratorObjectNoException
   * @expectedException InvalidArgumentException
   * @provider isIntDataProvider
   */
  public function testInvalidArgumentExceptionIfSetPhraselength($testData)
  {
    $this->_captcha->setPhraseLength($testData);
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testInvalidArgumentExceptionIfSetFontymarginBiggerThanFour()
  {
    $this->_captcha->setPhraseLength(3);
  }

  public function testSetPhraselength()
  {
    $this->assertInstanceOf(
      'CaptchaGenerator', $this->_captcha->setPhraseLength(4)
    );
  }

  public function testGetPhraseHaseExpectedLength()
  {
    $this->assertEquals(
      $this->_phraselength, mb_strlen($this->_captcha->getPhrase())
    );
  }
}