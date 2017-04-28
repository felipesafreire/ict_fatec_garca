<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function valida_login($email){
        
        return $this->sql("select a.*
                           from coordenador a
                           where a.email = ? ",$email)->row();
        
    }
    
    public function listar_inscricao($offset=0){
        
        $sql = "select a.*,
                b.titulo as curso
                from ficha_temporaria a
                     inner join curso b on
                     b.id = a.curso_id";
        
        config_pagination($this, $sql, $offset);
        return $this->sql($sql . ' LIMIT ' . $this->ajax_pagination->per_page . ' OFFSET ' . $this->ajax_pagination->cur_page)->result();
        
    }
    
    public function valida_curso($id) {
        
        $sql = "select a.status
                from curso a
                where a.id = ".$id." ";
        
        $x = $this->sql($sql)->row(); 
       
        return $x->status == 1 ? TRUE:FALSE;
        
    }
    
    public function primeiro_acesso($senha, $email){
        
        try{
           
            $this->start_transaction();
            
            $dados = array('senha'            => md5($senha),
                           'senha_temporaria' => NULL);
            
            $this->update('coordenador', $dados, array('email'=>$email));
            
            $info = $this->sql("select * from coordenador where email = ? ",$email)->row();
            
            $this->commit();
            return array('result'=>true,'dados'=>$info);
            
        }catch(Exception $ex) {
            
            $this->rollback();
            return array('result'=>false);
            
        }
        
    }
    
    public function seleciona_periodo($id){
        
        return $this->sql("select 
                           coalesce(a.periodo_manha,0) as manha,
                           coalesce(a.periodo_tarde,0) as tarde,
                           coalesce(a.periodo_noite,0) as noite
                           from coordenador a
                           where a.id = ? ",$id)->row();
        
    }
    public function periodo(){
        
        return $this->sql("select a.*
                           from periodo_curso a")->result();
        
    }
    
    public function listar_dados(){
        
        return $this->sql("select a.nome, a.email
                           from coordenador a 
                           where a.id = ? ",$this->id_cood())->row();
        
    }
    
    public function email_cadastrado($email){
        
        $sql = "select count(a.id) as qtde
                from coordenador a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))  
                and a.id <> ".$this->id_cood()." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function alterar_dados($email,$nome){
        
        $dados = array('nome'   => $nome,
                       'email'  => $email);
        
        $x = $this->update('coordenador', $dados, array('id'=>$this->id_cood()));
        
        if($x){
            
            $this->session->set_userdata('email_cood', $email);
            $this->session->set_userdata('nome_cood', $nome);
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function alterar_senha($senha){
        
        $dados = array('senha' => md5($senha));
        
        $x = $this->update('coordenador', $dados, array('id'=>$this->id_cood()));
        
        if($x){
            
            $this->session->set_userdata('senha_cood', $senha);
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function verifica_email($email){
        
        $sql = "select count(a.id) as qtde
                from coordenador a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;

    }
    
    public function reset_senha($email){
        
        $this->load->helper('string');
        $senha = random_string('numeric', 10);
        
        $dados = array('senha'            => NULL,
                       'senha_temporaria' => $senha);
        
        $x = $this->update('coordenador', $dados, array('email'=>$email));
        
        if($x){
            
            return array('result'=>true, 'senha'=>$senha);
            
        }else{
            
            return array('result'=>FALSE);
            
        }
        
    }
	
    public function aceitar_inscricao($id){
	
        $sql = $this->sql("select *
                           from ficha_temporaria a
                           where a.id = ? ",$id)->row();

        $aluno = json_decode($sql->dados);

        $dados = array('nome_orientando' => $aluno->nome_orientando,
					   'cpf_orientando' => $aluno->cpf_orientando,
					   'email_orientando' => $aluno->email_orientando,
					   'lattes_orientando' => $aluno->lattes_orientando,
					   'curso_id' => $sql->curso_id,
					   'periodo_curso' => $aluno->periodo_orientando,
					   'termo_orientando' => $aluno->termo_orientando,
					   'nome_orientador' => $aluno->nome_orientador,
					   'cpf_orientador' => $aluno->cpf_orientador,
					   'email_orientador' => $aluno->email_orientador,
					   'lattes_orientador' => $aluno->lattes_orientador,
					   'titulacao_orientador' => $aluno->titulacao_orientador,
					   'ies_orientador' => $aluno->ies_orientador,
					   'nome_coorientador' => empty($aluno->nome_coorientador)?null:$aluno->nome_coorientador,
					   'cpf_coorientador' => empty($aluno->cpf_coorientador)?null:$aluno->cpf_coorientador,
					   'email_coorientador' => empty($aluno->email_coorientador)?null:$aluno->email_coorientador,
					   'lattes_coorientador' => empty($alunolattes_coorientador)?null:$aluno->lattes_coorientador,
					   'titulacao_coorientador' => empty($aluno->titulacao_coorientador)?null:$aluno->titulacao_coorientador,
					   'ies_coorientador' => empty($aluno->ies_coorientador)?null:$aluno->ies_coorientador,
					   'local' => $aluno->local,
					   'periodo_realizacao' => $aluno->periodo_realizacao,
					   'dia_realizacao' => $aluno->dia_realizacao,
					   'hora_realizacao' => $aluno->hora_realizacao,
					   'orgao_realizacao' => $aluno->orgao_realizacao,
					   'titulo_projeto' => $aluno->titulo_projeto,
					   'resumo_projeto' => $aluno->resumo_projeto);	

        $this->insert('aluno', $dados);

        $x = $this->delete('ficha_temporaria', array('id'=>$sql->id));

        if($x){
            return true;
        }else{
            return false;
        }

    }
        
    public function rejeitar_inscricao($id){
        
        $x = $this->delete('ficha_temporaria', array('id'=>$id));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }    
    
}

