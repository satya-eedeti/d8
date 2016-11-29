<?php

namespace Drupal\mycustom;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\HttpFoundation\Request;

class QueryChecker implements AccessInterface {
	public function access(Request $request) {//print_r($request);
		$req_params = $request->getQueryString();//print_r($req_params);
		if (!empty($req_params)) {
			return AccessResult::allowed();
		}
		return AccessResult::forbidden();
	}
}