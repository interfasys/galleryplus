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

namespace OCA\Gallery\Controller;

require_once __DIR__ . '/FilesControllerTest.php';

/**
 * Class FilesPublicControllerTest
 *
 * @package OCA\Gallery\Controller
 */
class FilesPublicControllerTest extends FilesControllerTest {
	public function setUp(): void {
		parent::setUp();
		$this->controller = new FilesPublicController(
			$this->appName,
			$this->request,
			$this->urlGenerator,
			$this->searchFolderService,
			$this->configService,
			$this->searchMediaService,
			$this->downloadService,
			$this->logger
		);
	}
}
