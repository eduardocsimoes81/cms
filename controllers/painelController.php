<?php 
	class painelController extends controller{

		public function __construct(){


		}

		public function index(){

			$u = new Usuarios();
			$u->verificarLogin();

			$dados = array();

			$p = new Paginas();
			$dados['paginas'] = $p->getPaginas();

			$this->loadTemplateInPainel('painel/home', $dados);
		}

		public function menus(){

			$u = new Usuarios();
			$u->verificarLogin();

			$dados = array();

			$m = new Menu();
			$dados['menus'] = $m->getMenu();

			$this->loadTemplateInPainel('painel/menus', $dados);
		}

		public function menus_del($id){

			$u = new Usuarios();
			$u->verificarLogin();

			$m = new Menu();
			$m->delete($id);

			header("Location: ".BASE_URL."painel/menus");
			exit;
		}

		public function menus_edit($id_menu){

			$u = new Usuarios();
			$u->verificarLogin();

			$dados = array();
			$m = new Menu();

			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$url = addslashes($_POST['url']);

				$m->update($id_menu, $nome, $url);
				header("Location: ".BASE_URL."painel/menus");
				exit;
			}

			$dados['menu'] = $m->getMenu($id_menu);

			$this->loadTemplateInPainel('painel/menus_edit', $dados);
		}

		public function menus_add(){

			$u = new Usuarios();
			$u->verificarLogin();

			$dados = array();
			$m = new Menu();

			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$url = addslashes($_POST['url']);

				$m->insert($nome, $url);
				header("Location: ".BASE_URL."painel/menus");
				exit;
			}

			$this->loadTemplateInPainel('painel/menus_add', $dados);
		}

		public function pagina_del($id_pagina){

			$u = new Usuarios();
			$u->verificarLogin();

			$p = new Paginas();
			$p->delete($id_pagina);

			header("Location: ".BASE_URL."painel");
			exit;
		}

		public function pagina_edit($id_pagina){

			$u = new Usuarios();
			$u->verificarLogin();

			$dados = array();

			$p = new Paginas();

			if(isset($_POST['titulo']) && !empty($_POST['titulo'])){

				$titulo = addslashes($_POST['titulo']);
				$url = addslashes($_POST['url']);
				$corpo = addslashes($_POST['corpo']);

				$p->update($id_pagina, $titulo, $url, $corpo);
				header("Location: ".BASE_URL."painel");
				exit;
			}

			$dados['pagina'] = $p->getPaginaById($id_pagina);

			$this->loadTemplateInPainel('painel/pagina_edit', $dados);
		}

		public function pagina_add(){

			$u = new Usuarios();
			$u->verificarLogin();

			$dados = array();
			
			$p = new Paginas();

			if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
				$titulo = addslashes($_POST['titulo']);
				$url = addslashes($_POST['url']);
				$corpo = addslashes($_POST['corpo']);
				$p->insert($titulo, $url, $corpo);

				if(isset($_POST['add_menu']) && !empty($_POST['add_menu'])){
					
					$m = new Menu();
					$m->insert($titulo, $url);
				}

				header("Location: ".BASE_URL."painel");
				exit;
			}

			$this->loadTemplateInPainel('painel/pagina_add', $dados);
		}


		public function config(){

			$u = new Usuarios();
			$u->verificarLogin();

			$dados = array();

			if(isset($_POST['site_title']) && !empty($_POST['site_title'])){
				
				$site_title = addslashes($_POST['site_title']);
				$home_welcome = addslashes($_POST['home_welcome']);

				$c = new Config();
				$c->setPropriedade('site_title', $site_title);
				$c->setPropriedade('home_welcome', $home_welcome);

				header("Location: ".BASE_URL."painel/config");
				exit;
			}

			$this->loadTemplateInPainel('painel/config', $dados);
		}

		public function login(){

			$dados = array(
				'erro' => ''
			);

			if(isset($_POST['email']) && !empty($_POST['email'])){
				$email = addslashes($_POST['email']);
				$senha = md5($_POST['senha']);

				$u = new Usuarios();
				$dados['erro'] = $u->logar($email, $senha);
			}

			$this->loadView("painel/login", $dados);
		}

		public function logout(){

			unset($_SESSION['lgsystem']);
			header("Location: ".BASE_URL."painel/login");
			exit;
		}		
	}
 ?>