<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  */
require_once 'Database.class.php';
    class Cliente extends Database{
    private $erros=null;
        public function __construct(){
           
        }
        public function getAll(){
            $this->clearSession();
            $db = $this->conexao();           
            $data = $db->query('SELECT * FROM clientes where deleted=0' )->fetchAll();
           $clientes=[];
            foreach ($data as $row) {
                $clientes[]= $row ;
            }
            return $clientes;
        
        }
        private function clearSession(){
            $_SESSION=null;
        }
        public function get($id){
            $this->clearSession();
            $db = $this->conexao();   
           
            $cliente = $db->query("SELECT * FROM clientes where id=$id" )->fetch();
            return $cliente;
           
        }
        public function put(){
            $db = $this->conexao();
            $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_SESSION['campos']= $this->post;
            $this->validate();
            if(is_null($this->erros) ){
                $data = [
                    'nome' => $this->post['nome'],
                    'data_nascimento' => $this->post['data_nascimento'],
                    'cpfcnpj' => $this->post['cpfcnpj'],
                    'endereco' => $this->post['endereco'],
                    'id' => $this->post['id'],
                ];
                $sql = "UPDATE  clientes SET nome=:nome, data_nascimento=:data_nascimento, cpfcnpj=:cpfcnpj, endereco=:endereco where id=:id";
                $stmt= $db->prepare($sql);
                $stmt->execute($data);
                unset($_SESSION['campos']);
                $path_index = dirname($_SERVER['HTTP_REFERER']);
                header('Location: '. $path_index);
            }
        }
        public function post(){
            $db = $this->conexao();
            $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_SESSION['campos']= $this->post;
            $this->validate();
           
            if(is_null($this->erros) ){
                $data = [
                    'nome' => $this->post['nome'],
                    'data_nascimento' => $this->post['data_nascimento'],
                    'cpfcnpj' => $this->post['cpfcnpj'],
                    'endereco' => $this->post['endereco'],
                ];
                $sql = "INSERT INTO clientes (nome, data_nascimento, cpfcnpj, endereco) VALUES (:nome, :data_nascimento, :cpfcnpj, :endereco)";
                $stmt= $db->prepare($sql);
                $stmt->execute($data);

                unset($_SESSION['campos']);
                $path_index = dirname($_SERVER['HTTP_REFERER']);
                header('Location: '. $path_index);
            }
          
        }
        private function validate(){
            unset($_SESSION['erros']);
            $this->validateNome() ;
            $this->validateData() ;
            $this->validateCPF_CNPJ() ;
            $this->validateEndereco() ;
           
            if(!is_null($this->erros) ){
              
                $_SESSION['erros']= $this->erros;       
                header('Location: '. $_SERVER['HTTP_REFERER']);
            }
        }
        private function validateNome(){
            $nome= $this->post['nome'];
          
           if(trim($nome)==""){
                $this->erros['nome']="Campo nome é obrigatório";
           }
        }
        private function validateData(){
            $data_nascimento= $this->post['data_nascimento'];
            if(trim( $data_nascimento)==""){
                $this->erros['data_nascimento']="Campo Data de Nascimento é obrigatório";
           }
        }
        private function validateCPF_CNPJ(){
            $cpfcnpj= $this->post['cpfcnpj'];
            if(trim( $cpfcnpj)==""){
                $this->erros['cpfcnpj']="Campo CPF/CNPJ é obrigatório";
           }
        }
        private function validateEndereco(){
            $endereco= $this->post['endereco'];
            if(trim( $endereco)==""){
                $this->erros['endereco']="Campo Endereço é obrigatório";
           }
        }
        public function delete($id, $softModel=true){
            $db = $this->conexao();
           
                $insercao =$db->prepare("UPDATE clientes set deleted=1 where id=:id");
                $insercao->bindParam(':id', $id);
                $insercao->execute();
           
            // verificar se pode apagar ou nao e se der certo devolver a mensagem corretamente
            header('Location: '. $_SERVER['HTTP_REFERER']);
          
        }
    }

?>