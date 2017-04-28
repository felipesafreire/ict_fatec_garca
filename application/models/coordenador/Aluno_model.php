<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function listar_aluno($offset=0,$filtro){
        
        $sql = "select a.*,
                b.titulo curso
                from aluno a
                     inner join curso b on 
                     b.id = a.curso_id
                ".(!empty($filtro['curso'])?'where a.curso_id = "'.$filtro['curso'].'"':"where a.curso_id in(1,2,3)")."        
                ".(!empty($filtro['email'])?'and lower(a.email_orientando) = lower("'.$filtro['email'].'")':"")."        
                ".(!empty($filtro['nome'])?'and lower(a.nome_orientando) like "%'.strtolower($filtro['nome']).'%"':"")."    
                ".(!empty($filtro['cpf'])?"and a.cpf_orientando = '" .$filtro['cpf']."'":"")." ";
        
        config_pagination($this, $sql, $offset);
        return $this->sql($sql . ' LIMIT ' . $this->ajax_pagination->per_page . ' OFFSET ' . $this->ajax_pagination->cur_page)->result();
        
    }
    
}

