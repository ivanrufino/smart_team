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
      <?php require_once "service/index.php" ;
        $id_cliente= $_GET['id'];
      ?>
      <div class="container-fluid">
          
     
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Controle de Dívidas <span class="visually-hidden">(current)</span></a>
           
        </div>
    </nav>
    <a href="index.php"  class="btn btn-success m-3"> < Voltar  </a>
    <a href="cadastrarDivida.php?id_cliente=<?php echo $id_cliente ?>"  class="btn btn-primary m-3"> Nova Divida  </a>
<?php 
              
                  $cliente_a = $cliente->get( $id_cliente);
                  $dividas = $divida->getAll($id_cliente);
                  if(count($dividas)==0){ ?>
                    <div class="alert alert-info"><strong>Aviso</strong><br> Sem dívidas cadastradas para <?php echo $cliente_a['nome'] ?>.</div> 
                  <?php }else {?>
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Nome Cliente</th>
                <th>Descrição</th>
                <th>Situação</th>
                <th>Data Vencimento</th>
                <th>Valor</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach ( $dividas as $key => $divida) { ?>
                <tr>
                    <td scope="row"><?php echo $cliente_a['nome']?></td>
                    <td><?php echo $divida['descricao'] ?></td>
                    <td><?php echo $divida['situacao'] ?></td>
                    <td><?php echo date("d-m-Y",strtotime($divida['data_vencimento']))?></td>
                    <td><?php echo "R$ ".  $divida['valor'] ?></td>
                    <td>
                       
                        <a href="editarDivida.php?id=<?php echo $divida['id']?>"  class="btn btn-success"> Editar  </a>
                        <a href="service/index.php?_method=delete&_action=divida&id=<?php echo $divida['id']?>" class="btn btn-danger"> Remover</a>

                </td>
                </tr>
               
                <?php }
                }?>
            </tbody>
    </table>
    
    
   
    
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="assets/cliente.js" ></script>

  </body>
</html>