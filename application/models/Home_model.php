<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function verifica_inscricao(){
        
        return $this->sql("select *
                           from edital
                           order by id desc
                           limit 1")->row();
        
    }
    
    public function verifica_aluno($cpf){
        
        $sql = "select count(a.id) as qtde
                from aluno a
                where a.cpf = ".soNumero($cpf)." ";
        
        $x = $this->sql($sql)->row();
        
        return $x->qtde > 0 ? true:false; 
        
    }
    
    public function salvar_inscricao($dados){
        
        $curso = $dados['curso_orientando'];
        
        $dados = json_encode($dados);
        
        $x = $this->insert('ficha_temporaria', array('dados'=>$dados,
                                                     'curso_id'=>$curso));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
}

