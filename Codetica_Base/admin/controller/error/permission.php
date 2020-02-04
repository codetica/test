<?php
class ControllerErrorPermission extends Controller {
	public function index() {

		$this->document->setTitle("Error, Permiso");

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Inicio',
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Error',
			'href' => $this->url->link($this->request->get['route'], 'token=' . $this->session->data['token'], true)
		);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('error/permission', $data));
	}
}
