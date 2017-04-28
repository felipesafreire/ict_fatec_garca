<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coordenador_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function salvar_coordenador($dados){
        
        try{
            
            $this->start_transaction();
            
            $this->load->helper('string');
        
            $senha = random_string('numeric', 10);
        
            $info = array('status'              =>  $dados['status'],
                          'id_curso'            =>  $dados['curso'],
                          'nome'                =>  $dados['nome'],
                          'email'               =>  $dados['email'],
                          'senha_temporaria'    =>  $senha);
        
            $x = $this->insert('coordenador', $info);
            
            $this->commit();
            
            //return array('result'=>true,'dados'=>$info);
            return true;
            
        }catch(Exception $ex){
            
            $this->rollback();
            
            //return array('result'=>false);
            return false;
        }
        
    }
    
    public function alterar_coordenador($dados,$p,$id){
        
        try{
            
            $this->start_transaction();
            
            $info = array('status'              =>  $dados['status'],
                          'id_curso'            =>  $dados['curso'],
                          'nome'                =>  $dados['nome'],
                          'email'               =>  $dados['email']);
        
            $x = $this->update('coordenador', $info, array('id'=>$id));
            
            $this->commit();
            
            return true;
            
        }catch(Exception $ex){
            
            $this->rollback();
            
            return false;
            
        }
        
    }
    
    public function listar_coordenador(){
        
        return $this->sql("select a.*
                           from coordenador a
                           order by a.nome, a.email ")->result();
        
    }
    
    public function listar_curso(){
        
        return $this->sql("select a.id, a.titulo
                           from curso a")->result();
        
    }
    
    public function dados_coordenador($id){
        
        return $this->sql("select *
                           from coordenador
                           where id = ?",$id)->row();
        
    }
    
    public function coordenador_cadastrado($email){
        
        $email = removerAcento($email);
                
        $sql = "select count(a.id) as qtde
                from coordenador a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function coordenador_cadastrado_editar($email, $id){
        
        $email = removerAcento($email);
                
        $sql = "select count(a.id) as qtde
                from coordenador a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))
                and a.id <> ".$id."";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function excluir_coordenador($id){
        
        $x = $this->delete('coordenador', array('id'=>$id));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
}

