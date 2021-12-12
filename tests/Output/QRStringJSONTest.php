<?php
/**
 * Class QRStringJSONTest
 *
 * @created      11.12.2021
 * @author       smiley <smiley@chillerlan.net>
 * @copyright    2021 smiley
 * @license      MIT
 */

namespace chillerlan\QRCodeTest\Output;

use chillerlan\QRCode\QRCode;
use function extension_loaded;

/**
 *
 */
final class QRStringJSONTest extends QRStringTestAbstract{

	protected string $type = QRCode::OUTPUT_STRING_JSON;

	/**
	 * @inheritDoc
	 */
	protected function setUp():void{
		// just in case someone's running this on some weird disto that's been compiled without ext-json
		if(!extension_loaded('json')){
			$this::markTestSkipped('ext-json not loaded');
		}

		parent::setUp();
	}


	public function testSetModuleValues():void{
		$this::markTestSkipped('N/A');
	}

}