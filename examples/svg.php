<?php

/**
 * @created      21.12.2017
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 *
 * @noinspection PhpComposerExtensionStubsInspection
 */

namespace chillerlan\QRCodeExamples;

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Common\EccLevel;
use function gzencode, header;

require_once __DIR__.'/../vendor/autoload.php';

$data = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
$gzip = true;

$options = new QROptions([
	'version'             => 7,
	'outputType'          => QRCode::OUTPUT_MARKUP_SVG,
	'imageBase64'         => false,
	'eccLevel'            => EccLevel::L,
	'addQuietzone'        => true,
	// if set to true, the light modules won't be rendered
	'imageTransparent'    => false,
	// empty the default value to remove the fill* attributes from the <path> elements
	'markupDark'          => '',
	'markupLight'         => '',
	// draw the modules as circles isntead of squares
	'drawCircularModules' => true,
	'circleRadius'        => 0.4,
	// connect paths
	'svgConnectPaths'     => true,
	// keep modules of thhese types as square
	'keepAsSquare'        => [
		QRMatrix::M_FINDER|QRMatrix::IS_DARK,
		QRMatrix::M_FINDER_DOT,
		QRMatrix::M_ALIGNMENT|QRMatrix::IS_DARK,
	],
	// https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
	'svgDefs'             => '
	<linearGradient id="rainbow" x1="100%" y2="100%">
		<stop stop-color="#e2453c" offset="2.5%"/>
		<stop stop-color="#e07e39" offset="21.5%"/>
		<stop stop-color="#e5d667" offset="40.5%"/>
		<stop stop-color="#51b95b" offset="59.5%"/>
		<stop stop-color="#1e72b7" offset="78.5%"/>
		<stop stop-color="#6f5ba7" offset="97.5%"/>
	</linearGradient>
	<style><![CDATA[
		.dark{fill: url(#rainbow);}
		.light{fill: #eee;}
	]]></style>',
]);

$qrcode = (new QRCode($options))->render($data);

header('Content-type: image/svg+xml');

if($gzip){
	header('Vary: Accept-Encoding');
	header('Content-Encoding: gzip');
	$qrcode = gzencode($qrcode, 9);
}

echo $qrcode;
