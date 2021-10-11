<!doctype html>
<html lang="en">
  <head>
    <title>Controle de Dívidas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> 
  </head>
  <body>
      <?php require_once "service/index.php" ?>
      <div class="container-fluid">
          
     
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Controle de Dívidas <span class="visually-hidden">(current)</span></a>
           
        </div>
    </nav>
   
    <a href="cadastrarCliente.php"  class="btn btn-primary mb-3"> Novo Cliente  </a>
    <?php 
        $clientes = $cliente->getAll();  
        if(count(  $clientes)==0){?>
     
        <div class="alert alert-info"><strong>Aviso</strong><br> Nenhum cliente cadastrado.</div> 
        <?php  }else{ ?>
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Nome</th>
                <th>CPF/CNPJ</th>
                <th>Data Nascimento</th>
                <th>Criado em</th>
               
                <th></th>
            </tr>
            </thead>
            <tbody>
                <?php 
                
                foreach ($clientes as $key => $cliente) { ?>
                <tr>
                    <td scope="row"><?php echo $cliente['nome']?></td>
                    <td><?php echo $cliente['cpfcnpj']?></td>
                    <td><?php echo date("d-m-Y",strtotime($cliente['data_nascimento']))?></td>
                    <td><?php echo  date("d-m-Y H:i:s",strtotime($cliente['date_created'])) ?></td>
                    <td>
                       
                        <a href="editarCliente.php?id=<?php echo $cliente['id']?>"  class="btn btn-success"> Editar  </a>
                        <a href="dividasCliente.php?id=<?php echo $cliente['id']?>"  href="" class="btn btn-info"> Dívidas  </a>
                        <a href="service/index.php?_method=delete&_action=cliente&id=<?php echo $cliente['id']?>" class="btn btn-danger"> Remover</a>
                </td>
                </tr>
               
                <?php }}?>
            </tbody>
    </table>
    
    
   
    
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="assets/cliente.js" ></script>

  </body>
</html>