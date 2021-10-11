<?php
/*   ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);   */ 
require_once 'Database.class.php';
    class Divida extends Database{
public $label_situacao = [0=>"Não Pago",1=>"Pago"];
private $erros=null;
        public function __construct(){
         
        }
        public function getAll($id_cliente){ 
           
         //   $this->clearSession();
            
            $db = $this->conexao();           
            $data = $db->query("SELECT * FROM dividas where id_cliente=$id_cliente and deleted=0" )->fetchAll();
           $dividas=[];
            foreach ($data as $row) {
                $row['situacao'] = $this->label_situacao[$row['status']];
                $row['valor'] = number_format($row['valor'] , 2, ',', '.');
                $dividas[]= $row ;
            }
            return $dividas;
        }
        public function get($id){
           
            $db = $this->conexao();   
           
            $divida = $db->query("SELECT * FROM dividas where id=$id" )->fetch();
            $divida['valor'] = number_format($divida['valor'] , 2, ',', '.');
            return $divida;
        }
        public function put(){
            $db = $this->conexao();
            $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_SESSION['campos_divida']= $this->post;
            $this->validate();
            if(is_null($this->erros) ){
              
                $data = [
                    'id_cliente' => $this->post['id_cliente'],
                    'descricao' => $this->post['descricao'],
                    'data_vencimento' => $this->post['data_vencimento'],
                    'valor' => str_replace(",", ".",  str_replace(".", "", $this->post['valor'])) ,
                    'status' => isset($this->post['status'])?$this->post['status']:0,
                    'id' => $this->post['id'],
                ];
                $sql = "UPDATE  dividas SET id_cliente=:id_cliente, descricao=:descricao, data_vencimento=:data_vencimento, valor=:valor, status=:status where id=:id";
                $stmt= $db->prepare($sql);
                $stmt->execute($data);
                unset($_SESSION['campos_divida']);
                $path_index = dirname($_SERVER['HTTP_REFERER'])."/dividasCliente.php?id=".$this->post['id_cliente'];
                header('Location: '. $path_index);
            }
        }
        public function post(){
            $db = $this->conexao();
            $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_SESSION['campos_divida']= $this->post;
            $this->validate();
           
            if(is_null($this->erros) ){
                $data = [
                    'id_cliente' => $this->post['id_cliente'],
                    'descricao' => $this->post['descricao'],
                    'data_vencimento' => $this->post['data_vencimento'],
                    'valor' => str_replace(",", ".",  str_replace(".", "", $this->post['valor'])) ,
                    'status' => isset($this->post['status'])?$this->post['status']:0,
                ];
               
                $sql = "INSERT INTO dividas (id_cliente, descricao, data_vencimento, valor,status) 
                VALUES (:id_cliente, :descricao, :data_vencimento, :valor,:status)";
                $stmt= $db->prepare($sql);
                $stmt->execute($data);

                unset($_SESSION['campos_divida']);
                $path_index = dirname($_SERVER['HTTP_REFERER'])."/dividasCliente.php?id=".$this->post['id_cliente'];
                header('Location: '. $path_index);
            }
           
        }
        private function validate(){
            unset($_SESSION['erros_divida']);
            $this->validateDescricao() ;
            $this->validateValor() ; 
            $this->validateData() ; 
         
           
            if(!is_null($this->erros) ){
              
                $_SESSION['erros_divida']= $this->erros;   
               
                header('Location: '. $_SERVER['HTTP_REFERER']);
            }
        }
        private function validateDescricao(){
            $descricao= $this->post['descricao'];
          
           if(trim($descricao)==""){
                $this->erros['descricao']="Campo Descrição é obrigatório";
           }
        }
        private function validateValor(){
            $valor= $this->post['valor'];
          
           if(trim($valor)==""){
                $this->erros['valor']="Campo Valor é obrigatório";
           }else
           if($valor == 0){
            $this->erros['valor']="Campo Valor deve ser maior que 0(zero)";
           }
        }
        private function validateData(){
            $data_vencimento= $this->post['data_vencimento'];
            if(trim( $data_vencimento)==""){
                $this->erros['data_vencimento']="Campo Data de Vencimento é obrigatório";
           }
        }
        public function delete($id, $softModel=true){
            $db = $this->conexao();
           
                $insercao =$db->prepare("UPDATE dividas set deleted=1 where id=:id");
                $insercao->bindParam(':id', $id);
                $insercao->execute();
           
            // verificar se pode apagar ou nao e se der certo devolver a mensagem corretamente
            header('Location: '. $_SERVER['HTTP_REFERER']);
          
        }
        private function clearSession(){
           
            $_SESSION['erros_divida']=null;
            $_SESSION['campos_divida']=null;
        }
    }

?>