<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Home_model', 'home');
    }
    
    public function index(){

        $dados = $this->home->verifica_inscricao();
        if(empty($dados)){
            $data['edital'] = '#';
        }else{
            $data['edital'] = $dados->link;
        }
        $this->load->view('index',$data);

    }
    
    public function enviar_email(){
        
        $dados = $this->input->post('dados');
        
        if(empty($dados['email'])){
            die("E-mail Obrigatório.");
        }
        if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            die("E-mail inválido.");
        }
        if(empty($dados['nome'])){
            die("Nome Obrigatório.");
        }
        if(empty($dados['assunto'])){
            die("Assunto Obrigatório.");
        }
        if(empty($dados['mensagem'])){
            die("Mensagem Obrigatório.");
        }
        
        $mensagem = "<h3>Contato Site - ICT</h3>
            
                     <p><strong>Nome: </strong>".$dados['nome']."</p>
                     <p><strong>Email: </strong>".$dados['email']."</p>
                     <p><strong>Assunto: </strong>".$dados['assunto']."</p>
                     <p><strong>Mensagem: </strong>".$dados['mensagem']."</p>";
        
        $destino = "lipe_safreire@hotmail.com";
        
        $this->template_email($dados['nome'],$dados['email'],$destino,$dados['assunto'],$mensagem);
        
    }
    
    public function verifica_inscricao(){
        
        $dados      = $this->home->verifica_inscricao();
        $data_atual = date('Y-m-d');
        
        $html = "";
		
		if(empty($dados)){
			
			$html .= "<h1 class='text-center'><strong>Inscrição Fechada</strong></h1>";
			
			die($html);
		}
		
        if($dados->data_inicial_inscricao <= $data_atual && $dados->data_final_inscricao >= $data_atual){

            $html .= "
                
                        <div class='row'>
                        
                            <div class='col-lg-12 col-md-12'>

                                <h2 class='text-center'><strong>Ficha de Inscrição</strong></h2>
                                <hr>
                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-12 col-md-12'>

                                <h4 class=''><strong>Dados Orientando</strong></h4>
                            </div>

                        </div>
                
                        <div class='row'>
                        
                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtNomeOrientando'>Nome</label>
                                    <input type='text' class='form-control' id='txtNomeOrientando' placeholder='Nome'>
                                </div>
                                
                                <script>
                                
                                    $('#txtCPFOrientando').mask('999.999.999-99');

                                </script>

                            </div>
                            
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='txtCPFOrientando'>CPF</label>
                                    <input type='text' class='form-control' id='txtCPFOrientando' placeholder='CPF'>
                                </div>

                            </div>
                            
                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='txtEmailOrientando'>E-mail</label>
                                    <input type='text' class='form-control' id='txtEmailOrientando' placeholder='E-mail'>
                                </div>

                            </div>
                            
                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtLattesOrientando'>Link Lattes</label>
                                    <input type='text' class='form-control' id='txtLattesOrientando' placeholder='Link Lattes'>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='cmbCurso'>Curso</label>
                                    <select class='form-control' id='cmbCurso'>
                                      <option value='1' selected>Análise e Desenvolvimento de Sistemas</option>
                                      <option value='2'>Mecatronica</option>
                                      <option value='3'>Gestão Empresarial</option>
                                    </select>
                                </div>

                            </div>
                            
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='cmbCursoPeriodo'>Período Curso</label>
                                    <select class='form-control' id='cmbCursoPeriodo'>
                                      <option value='1' selected>Manhã</option>
                                      <option value='2'>Tarde</option>
                                      <option value='3'>Noite</option>
                                    </select>
                                </div>

                            </div>
                            
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='cmbTermo'>Termo</label>
                                    <select class='form-control' id='cmbTermo'>
                                      <option value='1' selected>1º Termo</option>
                                      <option value='2' >2º Termo</option>
                                      <option value='3' >3º Termo</option>
                                      <option value='4' >4º Termo</option>
                                      <option value='5' >5º Termo</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-12 col-md-12'>

                                <h4 class=''><strong>Dados Orientador</strong></h4>
                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtNomeOrientador'>Nome</label>
                                    <input type='text' class='form-control' id='txtNomeOrientador' placeholder='Nome'>
                                </div>
                                
                                <script>
                                
                                    $('#txtCPFOrientador').mask('999.999.999-99');

                                </script>

                            </div>
                            
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='txtCPFOrientador'>CPF</label>
                                    <input type='text' class='form-control' id='txtCPFOrientador' placeholder='CPF'>
                                </div>

                            </div>
                            
                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='txtEmailOrientador'>E-mail</label>
                                    <input type='text' class='form-control' id='txtEmailOrientador' placeholder='E-mail'>
                                </div>

                            </div>
                            
                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtLattesOrientador'>Link Lattes</label>
                                    <input type='text' class='form-control' id='txtLattesOrientador' placeholder='Link Lattes'>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='cmbTitulacaoOrientador'>Titulação</label>
                                    <select class='form-control' id='cmbTitulacaoOrientador'>
                                      <option value='1' selected>Graduado</option>
                                      <option value='2'>Especialista</option>
                                      <option value='3'>Mestre</option>
                                      <option value='3'>Doutor</option>
                                      <option value='3'>Pós Doutor</option>
                                    </select>
                                </div>

                            </div>
                            
                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtIESOrientador'>Função da IES</label>
                                    <input type='text' class='form-control' id='txtIESOrientador' placeholder='Função da IES'>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-12 col-md-12'>

                                <h4 class=''><strong>Dados Coorientador</strong></h4>
                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtNomeCoorientador'>Nome</label>
                                    <input type='text' class='form-control' id='txtNomeCoorientador' placeholder='Nome'>
                                </div>
                                
                                <script>
                                
                                    $('#txtCPFCoorientador').mask('999.999.999-99');

                                </script>

                            </div>
                            
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='txtCPFCoorientador'>CPF</label>
                                    <input type='text' class='form-control' id='txtCPFCoorientador' placeholder='CPF'>
                                </div>

                            </div>
                            
                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='txtEmailCoorientador'>E-mail</label>
                                    <input type='text' class='form-control' id='txtEmailCoorientador' placeholder='E-mail'>
                                </div>

                            </div>
                            
                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtLattesCoorientador'>Link Lattes</label>
                                    <input type='text' class='form-control' id='txtLattesCoorientador' placeholder='Link Lattes'>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='cmbTitulacaoCoorientador'>Titulação</label>
                                    <select class='form-control' id='cmbTitulacaoCoorientador'>
                                      <option value='1' selected>Graduado</option>
                                      <option value='2'>Especialista</option>
                                      <option value='3'>Mestre</option>
                                      <option value='4'>Doutor</option>
                                      <option value='5'>Pós Doutor</option>
                                    </select>
                                </div>

                            </div>
                            
                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtIESCoorientador'>Função da IES</label>
                                    <input type='text' class='form-control' id='txtIESCoorientador' placeholder='Função da IES'>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-12 col-md-12'>

                                <h4 class=''><strong>Dados Projeto</strong></h4>
                            </div>

                        </div>
                        
                        <div class='row'>

                            <div class='col-lg-8 col-md-8'>
                            
                                <div class='form-group'>
                                    <label for='txtLocal'>Local da Realização</label>
                                    <input type='text' class='form-control' id='txtLocal' placeholder='Local da Realização'>
                                </div>

                            </div>
                            
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='cmbPeriodoRealizacao'>Período da Realização</label>
                                    <select class='form-control' id='cmbPeriodoRealizacao'>
                                        <option value='0' selected>Selecione o Período da Realização</option> 
                                        <option value='1'>6 meses</option>
                                        <option value='2'>12 meses</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>
                        
                            <div class='col-lg-2 col-md-2'>
                            
                                <div class='form-group'>
                                    <label for='cmbDia'>Dia da Realização</label>
                                    <select class='form-control' id='cmbDiaRealizacao'>
                                        <option value='1' selected>Segunda-Feira</option> 
                                        <option value='2'>Terca-Feira</option> 
                                        <option value='3'>Quarta-Feira</option> 
                                        <option value='4'>Quinta-Feira</option> 
                                        <option value='5'>Sexta-Feira</option> 
                                        <option value='6'>Sábado</option> 
                                    </select>
                                </div>

                            </div>
                            
                            <div class='col-lg-4 col-md-4'>
                            
                                <div class='form-group'>
                                    <label for='txtHora'>Hora da Realização</label>
                                    <input type='text' class='form-control' id='txtHora' placeholder='Hora da Realização'>
                                </div>

                                <script>
                                
                                    $('#txtHora').mask('99:99');

                                </script>

                            </div>
                            
                            <div class='col-lg-6 col-md-6'>
                            
                                <div class='form-group'>
                                    <label for='txtOrgao'>Orgão de Fomento</label>
                                    <input type='text' class='form-control' id='txtOrgao' placeholder='Orgão de fomento'>
                                </div>

                            </div>
                            
                        </div>
                        
                        <div class='row'>

                            <div class='col-lg-12 col-md-12'>
                            
                                <div class='form-group'>
                                    <label for='txtTitulo'>Titulo do Projeto</label>
                                    <input type='text' class='form-control' id='txtTitulo' placeholder='Titulo do Projeto'>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>

                            <div class='col-lg-12 col-md-12'>
                            
                                <div class='form-group'>
                                    <label for='txtResumo'>Resumo do Projeto</label>
                                    <textarea rows='5' class='form-control' id='txtResumo' placeholder='Resumo do Projeto'></textarea>
                                </div>

                            </div>

                        </div>
                        
                        <div class='row'>
                                            
                            <div class='col-md-12'>

                                <button id='btnCadastro' data-loading-text='Aguarde...' class='btn btn-primary btn-lg' style='margin-right: 5px;'>Enviar Ficha</button>
                                <div id='spAvisoCadastro'></div>
                            </div>

                        </div>
                
                
                ";
            
        }
            
        echo $html;    

    }
    
    public function inscricao(){
        
        $dados = $this->input->post('inscricao');
        
        /* ORIENTANDO */
        if(empty($dados['nome_orientando'])){
            die("Nome Orientando Obrigatório");
        }
        if(empty($dados['cpf_orientando'])){
            die("CPF Orientando Obrigatório");
        }
        if(!validaCPF($dados['cpf_orientando'])){
            die("CPF Orientando inválido.");
        }
        if(empty($dados['email_orientando'])){
            die("E-mail Orientando Obrigatório");
        }
        if(!filter_var($dados['email_orientando'], FILTER_VALIDATE_EMAIL)){
            die("E-mail Orientando inválido");
        }
        if(empty($dados['lattes_orientando'])){
            die("Lattes Orientando Obrigatório");
        }
        
        /* ORIENTADOR */
        if(empty($dados['nome_orientador'])){
            die("Nome Orientador Obrigatório");
        }
        if(empty($dados['cpf_orientador'])){
            die("CPF Orientador Obrigatório");
        }
        if(!validaCPF($dados['cpf_orientador'])){
            die("CPF Orientador inválido.");
        }
        if(empty($dados['email_orientador'])){
            die("E-mail Orientador Obrigatório");
        }
        if(!filter_var($dados['email_orientador'], FILTER_VALIDATE_EMAIL)){
            die("E-mail Orientador inválido");
        }
        if(empty($dados['lattes_orientador'])){
            die("Lattes Orientador Obrigatório");
        }
        
        /* LOCAL */
        
        if(empty($dados['local'])){
            die("Local de Realização Obrigatório");
        }
        if(empty($dados['hora_realizacao'])){
            die("Hora da Realização Obrigatório");
        }
        if(empty($dados['orgao_realizacao'])){
            die("Orgão Fomento Obrigatório");
        }
        if(empty($dados['titulo_projeto'])){
            die("Título do Projeto Obrigatório");
        }
        if(empty($dados['resumo_projeto'])){
            die("Resumo do Projeto Obrigatório");
        }
        if($dados['periodo_realizacao']==0){
            die("Periódo de Realização Obrigatório");
        }
        if($dados['termo_orientando']==5){
            if($dados['periodo_realizacao']!=1){
               die("Orientando do 5º só pode realizar 6 meses de projeto.");
            }
        }
//        if($this->home->verifica_aluno($dados['cpf_orientando'])){
//            die("Aluno já está em fazendo Projeto.");
//        }
        
        echo $this->home->salvar_inscricao($dados);
        
    }
    
}
