<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edital_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function salvar_edital($dados){
        
        $info = array('data_inicial_inscricao' => inverteData($dados['inicial']),
                      'data_final_inscricao'   => inverteData($dados['final']),
                      'semestre'               => $dados['semestre'],
                      'link'                   => $dados['link']);
        
        $x = $this->insert('edital', $info);
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function editar_edital($dados, $id){
        
        $info = array('data_inicial_inscricao' => inverteData($dados['inicial']),
                      'data_final_inscricao'   => inverteData($dados['final']),
                      'semestre'               => $dados['semestre'],
                      'link'                   => $dados['link']);
        
        $x = $this->update('edital', $info, array('id'=>  $this->encrypt->decode($id)));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function listar_edital(){
        
        return $this->sql("select *
                           from edital")->result();
        
    }
    
    public function dados_edital($id){
        
        return $this->sql("select *
                           from edital
                           where id = ? ",$id)->row();
        
    }
    
}

