<?php
class ControllerCommonForgotten extends Controller {
	private $error = array();

	public function index() {
		if ($this->user->isLogged() && isset($this->request->get['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			$this->response->redirect($this->url->link('common/dashboard', '', true));
		}

		if (!$this->config->get('config_password')) {
			$this->response->redirect($this->url->link('common/login', '', true));
		}

		$this->document->setTitle('Recuperar contraseña');

		$this->load->model('user/user');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$code = token(40);

			$this->model_user_user->editCode($this->request->post['email'], $code);

			$subject = sprintf('Recuperar contraseña', html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

			$message  = sprintf("Usted está recibiendo este correo ya que recibimos una solicitud de restablecimiento de contraseña para su cuenta", html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";
			$message .= "Haga click en el enlace inferior para actualizar su contraseña. \n\n";
			$message .= $this->url->link('common/reset', 'code=' . $code, true) . "\n\n";
			$message .= sprintf("Si no solicitó restablecer la contraseña, haga caso omiso de este mensaje. \n\n");

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->request->post['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
			$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			$mail->send();

			$this->session->data['success'] = "Se ha enviado un enlace para reestablecer su contraseña";

			$this->response->redirect($this->url->link('common/login', '', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Inicio',
			'href' => $this->url->link('common/dashboard', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Recuperar contraseña',
			'href' => $this->url->link('common/forgotten', 'token=' . '', true)
		);

		$data['action'] = $this->url->link('common/forgotten', '', true);

		$data['cancel'] = $this->url->link('common/login', '', true);

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('common/forgotten', $data));
	}

	protected function validate() {
		if (!isset($this->request->post['email'])) {
			$this->error['warning'] = "Debes ingresar un correo electrónico";
		} elseif (!$this->model_user_user->getTotalUsersByEmail($this->request->post['email'])) {
			$this->error['warning'] = "El correo electrónico no es válido";
		}

		return !$this->error;
	}
}
