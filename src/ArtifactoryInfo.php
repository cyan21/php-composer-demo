<?php

namespace Ych\ArtifactoryInfo;

class ArtifactoryInfo {

	private $ay_host = "192.168.41.41:8081/artifactory";

	public function hello() {
		return "hello";
	}

	public function isOk() {
		return true;
	}

	public function getLicense() {

		$uri = "http://$this->ay_host/api/system/license";
			
		$response = \Httpful\Request::get($uri)
				->expectsJson()
				->authenticateWith('admin', 'password')
				->send();


		return "Aloha, you are running Artifactory under a {$response->body->type} license which will expired on {$response->body->validThrough}";
	}
}

?>
