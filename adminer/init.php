<?php
/**
 * Adminer Extension
 */

function adminer_object() {
	class AdminerSoftware extends Adminer {
		private $creds = [
			'host' => 'database',
			'name' => 'laravel',
			'user' => 'laravel',
			'pass' => 'password',
		];

		function name() {
			return $this->creds['name'];
		}

		function credentials() {
			return [
				$this->creds['host'],
				$this->creds['user'],
				$this->creds['pass']
			];
		}

		function database() {
			return $this->creds['name'];
		}

	}
	
	return new AdminerSoftware;
}

include './adminer.php';
