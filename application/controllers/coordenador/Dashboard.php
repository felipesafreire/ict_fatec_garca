<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

function __construct(){

        parent::__construct();
        $this->load->model('coordenador/Dashboard_model', 'dashboard');

    }

    public function index(){

        if($this->session->userdata('id_cood')){

            $data['nome']       = $this->session->userdata('nome_cood');
            $data['page']       = 'blank';

            $this->load->view('coordenador/body_view',$data);

        }else{

            redirect(base_url('coordenador/dashboard/login'));

        }

    }

    public function inscricao(){

        if($this->session->userdata('id_cood')){

            $data['nome']       = $this->session->userdata('nome_cood');
            $data['page']       = 'inscricao_pendente';

            $this->load->view('coordenador/body_view',$data);

        }else{

            redirect(base_url('coordenador/dashboard/login'));

        }

    }

    public function listar_inscricao(){

        $dados = $this->dashboard->listar_inscricao($this->input->post('page'));

        $html = "";

          foreach ($dados as $item):

            $inscricao = json_decode($item->dados);

            $id = $this->encrypt->encode($item->id);

            $html .= "<tr>
                          <td style='vertical-align:middle;'>
                          <strong>".$item->curso."</strong><br>
                          ".$inscricao->nome_orientando."<br>
                          ".$inscricao->email_orientando."<br>
                          ".$inscricao->cpf_orientando."<br>
                          ".$inscricao->lattes_orientando."
                          </td>
                          <td style='vertical-align:middle;' class='hidden-xs hidden-sm'>
                          ".$inscricao->nome_orientador."<br>
                          ".$inscricao->email_orientador."<br>
                          ".$inscricao->cpf_orientador."<br>
                          ".$inscricao->lattes_orientador."
                          </td>
                          <td style='vertical-align:middle;' class='hidden-xs hidden-sm'>
                            Local: ".$inscricao->local.", Horario:".$inscricao->hora_realizacao."<br>
                            Orgão Fomento: ".$inscricao->orgao_realizacao."<br>
                            Titulo: ".$inscricao->titulo_projeto."<br>
                            Resumo: ".$inscricao->resumo_projeto."
                          </td>
                          <td style='text-align:center; vertical-align:middle;'>

                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <strong>Ações</strong>
                                <span class='fa fa-angle-down'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                  <li><a href='javascript:' class='link-inscricao' id='".$id."'>Aceitar Inscrição</a></li>
                                  <li><a href='javascript:' class='link-rejeitar'  id='".$id."'>Rejeitar Inscrição</a></li>
                                </ul>
                            </div>

                          </td>
                      </tr>";

        endforeach;

        if($html==""){

            $html .= "<tr><td colspan='20'>Não foi encontrado nenhum registro...</td></tr>";

        }

        echo json_encode(array('paginacao'  => $this->ajax_pagination->create_links(),
                               'html'       => $html));



    }

    public function login(){

        $this->session->unset_userdata('id_cood');
        $this->session->unset_userdata('email_cood');
        $this->session->unset_userdata('senha_cood');
        $this->session->unset_userdata('nome_cood');
        $this->session->unset_userdata('id_curso');

        $this->load->view('coordenador/login_view');

    }

    public function entrar(){

        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        if(empty($email)){

            die(json_encode(array('result'=>false,'msg'=>"Campo e-mail obrigatório!")));

        }
        if(empty($senha)){

            die(json_encode(array('result'=>false,'msg'=>"Campo senha obrigatório!")));

        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

            die(json_encode(array('result'=>false,'msg'=>"E-mail inválido")));

        }

        $x  = $this->dashboard->valida_login($email);

        if(empty($x)){

            die(json_encode(array('result'=>false,'msg'=>"Dados inválidos!")));

        }else{

            if($x->status!=1){

                $msg = " ".$x->nome.", seu(a) usuário consta inativo, entre em contato com o administrador.";

                die(json_encode(array('result'=>false,'msg'=>$msg)));

            }else{

                $curso = $this->dashboard->valida_curso($x->id_curso);

                if($curso==false){

                    die(json_encode(array('result'=>false,'msg'=>"Curso que administra consta inativo, entre em contato com o administrador.")));

                }else{

                    if($x->senha_temporaria!=NULL){

                        if($x->senha_temporaria!=$senha){

                            die(json_encode(array('result'=>false,'msg'=>"Senha incorreta")));

                        }else{

                            echo json_encode(array('result'=>true,'ok'=>1));

                        }

                    }else{

                        if($x->senha!=md5($senha)){

                            die(json_encode(array('result'=>false,'msg'=>"Senha incorreta")));

                        }else{

                            $this->session->set_userdata('id_cood', $x->id);
                            $this->session->set_userdata('email_cood', $x->email);
                            $this->session->set_userdata('senha_cood', $x->senha);
                            $this->session->set_userdata('nome_cood', $x->nome);
                            //$this->session->set_userdata('id_curso', $x->id_curso);

                            echo json_encode(array('result'=>true,'url'=>base_url('coordenador/dashboard')));

                        }

                    }

                }

            }

        }

    }

    public function primeiro_acesso(){

        $email       = $this->input->post('email');
        $senha       = $this->input->post('senha');
        $repetesenha = $this->input->post('repetesenha');

        if(empty($email)){

            die(json_encode(array('result'=>false)));

        }
        if(empty($senha)){

            die(json_encode(array('result'=>false,'msg'=>"Campo senha vazio!")));

        }
        if(empty($repetesenha)){

            die(json_encode(array('result'=>false,'msg'=>"Campo repete senha vazio")));

        }
        if($senha!=$repetesenha){

            die(json_encode(array('result'=>false,'msg'=>"Senhas não conferem")));

        }

        $x = $this->dashboard->primeiro_acesso($senha,$email);

        if($x['result']){

            echo json_encode(array('result'=>true));

        }else{

            echo json_encode(array('result'=>false));

        }

    }

    public function set_periodo(){

        $periodo = $this->input->post('periodo');

        if(empty($periodo)){

            die(json_encode(array('result'=>false,'url'=>base_url('coordenador/dashboard/login'))));

        }
        if($periodo==0){

            die(json_encode(array('result'=>false,'url'=>base_url('coordenador/dashboard/login'))));

        }

        $this->session->set_userdata('id_periodo', $periodo);

        echo json_encode(array('result'=>true,'url'=>base_url('coordenador/dashboard')));

    }

    public function dados(){

        if($this->session->userdata('id_cood')){

            $data['nome'] = $this->session->userdata('nome_cood');
            $data['curso'] = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo;
            $data['page'] = 'dados';

            $this->load->view('coordenador/body_view',$data);

        }else{

            redirect(base_url('coordenador/dashboard/login'));

        }

    }

    public function senha(){

        if($this->session->userdata('id_cood')){

            $data['nome'] = $this->session->userdata('nome_cood');
            $data['curso'] = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo;
            $data['page'] = 'senha';

            $this->load->view('coordenador/body_view',$data);

        }else{

            redirect(base_url('coordenador/dashboard/login'));

        }

    }

    public function listar_dados(){

        $dados = $this->dashboard->listar_dados();

        if($dados){

            echo json_encode(array('error'=>false,
                                   'email'=>$dados->email,
                                   'nome' =>$dados->nome));

        }else{

            echo json_encode(array('error'=>true));

        }

    }

    public function salvar_dados(){

        $email = $this->input->post('email');
        $nome  = $this->input->post('nome');

        if(empty($email)){

            die("E-mail obrigatório");

        }
        if(empty($nome)){

            die("Nome obrigatório");

        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

            die("E-mail inválido");

        }

        if($this->dashboard->email_cadastrado($email)){

           die("E-mail já cadastrado!");

        }

        echo $this->dashboard->alterar_dados($email,$nome);

    }

    public function alterar_senha(){

        $dados = array('senha'      => md5($this->input->post('senha')),
                       'novasenha'  => $this->input->post('novasenha'),
                       'repetesenha'      => $this->input->post('repetesenha'));

        if(empty($dados['senha'])){

            die("Senha obrigatório.");

        }
        if(empty($dados['novasenha'])){

            die("Nova Senha obrigatório.");

        }
        if(empty($dados['repetesenha'])){

            die("Repete Senha obrigatório.");

        }
        if($dados['novasenha']!=$dados['repetesenha']){

            die("Senhas não conferem.");

        }

        if($dados['senha'] != $this->model->senha_cood()){

            die("Senha Atual errada, tente novamente.");

        }

        echo $this->dashboard->alterar_senha($dados['novasenha']);

    }

    public function esqueceu_senha(){

        $email = $this->input->post('email');

        if(empty($email)):
            die("E-mail em branco");
        endif;

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            die("E-mail invalído");
        endif;

        if($this->dashboard->verifica_email($email)){

            $x = $this->dashboard->reset_senha($email);

            if($x['result']){

                $nome       = 'Sistema de Estágio';
                $origem     = "contato@sistemadeestagio.com.br";
                $destino    = $email;
                $assunto    = "Recuperar senha do Sistema de Estágio";
                $mensagem   = "Olá, você está recebendo este email para recuperar sua
                               senha do
                               <strong>Sistema de Estágio</strong>.<br><br>

                               Seus dados temporários de acesso são:<br>
                               <strong>Email:</strong> ".$email."<br>
                               <strong>Senha:</strong> ".$x['senha']."<br><br>

                    <a href='".base_url('coordenador/dashboard/login')."' style='text-align:center;
                    font-size:14px;text-decoration:none; color:black;'>
                    <strong>Clique aqui para recuperar a senha</strong></a><br><br>
                                   ";

                $this->template_email($nome, $origem, $destino, $assunto, $mensagem);

            }else{

                die("Erro ao reenviar senha!");

            }

        }else{

            die("E-mail não encontrado...");

        }
    }

    public function aceitar_inscricao(){

        $id = $this->input->post('id');

        if(empty($id)){
            die($id);
        }

        $id = $this->encrypt->decode($id);

        echo $this->dashboard->aceitar_inscricao($id);

    }

    public function recusar_inscricao(){

        $id = $this->input->post('id');

        if(empty($id)){
            die($id);
        }

        $id = $this->encrypt->decode($id);

        echo $this->dashboard->rejeitar_inscricao($id);

    }

}
