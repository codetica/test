<?php
class ControllerErrorNotFound extends Controller {
	public function index() {

		$this->document->setTitle('Error 404');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Inicio',
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Error',
			'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], true)
		);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('error/not_found', $data));
	}
}