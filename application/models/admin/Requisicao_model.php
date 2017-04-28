<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requisicao_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function salvar_requisicao($dados){
        
        try{
            
            $this->start_transaction();
            
            $info = array('titulo'    => $dados['titulo'],
                          'descricao' => $dados['descricao'],
						  'data'	  => date('Y-m-d H:m:s'));
        
            $x = $this->insert('requisicao', $info);
            
            $this->commit();
            
            return true;
            
        }catch(Exception $ex){
            
            $this->rollback();
            
            return false;
        }
        
    }
    
    public function alterar_requisicao($dados,$id){
        
        try{
            
            $this->start_transaction();
            
             $info = array('titulo'    => $dados['titulo'],
                          'descricao'  => $dados['descricao']);
        
            $x = $this->update('requisicao', $info, array('id'=>$id));
            
            $this->commit();
            
            return true;
            
        }catch(Exception $ex){
            
            $this->rollback();
            
            return false;
            
        }
        
    }
    
    public function listar_requisicao(){
        
        return $this->sql("select a.*,
                           concat(substring(a.descricao,1,20),'...')as descricao,
                           cast(a.data as date) as data
                           from requisicao a
                           order by a.titulo")->result();
        
    }
    
    public function dados_requisicao($id){
        
        return $this->sql("select a.*
                           from requisicao a
                           where a.id = ? ",array($id))->row();
        
    }
    
    public function excluir_requisicao($id){
        
        $x = $this->delete('requisicao', array('id'=>$id));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
}

