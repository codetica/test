<?php
class ControllerCommonFooter extends Controller {
	public function index() {

		$data['version'] = $this->config->get('system_version');

		return $this->load->view('common/footer', $data);
	}
}
