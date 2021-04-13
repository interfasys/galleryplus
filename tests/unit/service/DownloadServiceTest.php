<?php
/**
 * Gallery
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Olivier Paroz <galleryapps@oparoz.com>
 *
 * @copyright Olivier Paroz 2016
 */

namespace OCA\Gallery\Service;

use OCP\Files\File;

/**
 * Class DownloadServiceTest
 *
 * @package OCA\Gallery\Controller
 */
class DownloadServiceTest extends \Test\GalleryUnitTest {
	use Base64Encode;

	/** @var DownloadService */
	protected $service;

	/**
	 * Test set up
	 */
	public function setUp(): void {
		parent::setUp();

		$this->service = new DownloadService(
			$this->appName,
			$this->environment,
			$this->logger
		);
	}

	public function testDownloadRawFile() {
		/** @type File $file */
		$file = $this->mockJpgFile(12345);

		$download = [
			'preview'  => $file->getContent(),
			'mimetype' => $file->getMimeType()
		];

		$downloadResponse = $this->service->downloadFile($file);

		$this->assertSame($download['mimetype'], $downloadResponse['mimetype']);
		$this->assertSame($download['preview'], $downloadResponse['preview']);
	}

	public function testDownloadBase64EncodedFile() {
		/** @type File $file */
		$file = $this->mockJpgFile(12345);

		$download = [
			'preview'  => $this->encode($file->getContent()),
			'mimetype' => $file->getMimeType()
		];

		$downloadResponse = $this->service->downloadFile($file, true);

		$this->assertSame($download['mimetype'], $downloadResponse['mimetype']);
		$this->assertSame($download['preview'], $downloadResponse['preview']);
	}

	/**
	 */
	public function testDownloadNonExistentFile() {
		$this->expectException(\OCA\Gallery\Service\NotFoundServiceException::class);

		$file = $this->mockBadFile();

		$this->service->downloadFile($file);
	}
}
