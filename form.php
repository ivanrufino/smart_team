<?php 
function getForm($type,$dados=null){
    $_method= $type=="cadastro"? 'POST':'PUT';
    $erros=isset($_SESSION['erros'])?$_SESSION['erros']:null;
    $campos =isset($_SESSION['campos'])?$_SESSION['campos']:null;

    $campoNome = $dados==null?$campos['nome']:$dados['nome'];
    $campocpfcnpj = $dados==null?$campos['cpfcnpj']:$dados['cpfcnpj'];
    $campodata_nascimento  = $dados==null?$campos['data_nascimento']:$dados['data_nascimento'];
    $campoendereco = $dados==null?$campos['endereco']:$dados['endereco'];
    $form="<form action='service/index.php' method='POST'>";   
    if(isset($dados['id'])){
        $form.="<input type='hidden' name='id' value='{$dados['id']}' readonly> ";
    }
    $form.="<input type='hidden' name='_method' value='$_method' readonly> ";
    $form.="<input type='hidden' name='_action' value='cliente' readonly> ";
    $form.="<div class='row'>";
    $form.='
    <div class="col-6 mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome" aria-describedby="help_nome" placeholder="Nome" value="'.$campoNome.'">
      <small id="help_nome" class="form-text text-muted ">'.$erros['nome'].'</small>
    </div>';

    $form.='
    <div class="col-6  mb-3">
      <label for="cpfcnpj" class="form-label">CPF/CNPJ</label>
      <input type="text" class="form-control" onfocus="javascript: retirarFormatacao(this);" onblur="javascript: formatarCampo(this);" maxlength="14" name="cpfcnpj" id="cpfcnpj" aria-describedby="help_cpfcnpj" placeholder="CPF / CNPJ" value="'.$campocpfcnpj.'">
      <small id="help_cpfcnpj" class="form-text text-muted">'.$erros['cpfcnpj'].'</small>
    </div>';

    $form.='</div>';
    $form.='
    <div class="col-6  mb-3">
      <label for="data_nascimento" class="form-label">Data nascimento</label>
      <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" aria-describedby="help_data_nascimento" placeholder="data_nascimento" value="'.$campodata_nascimento.'">
      <small id="help_data_nascimento" class="form-text text-muted">'.$erros['data_nascimento'].'</small>
    </div>';

    $form.='<div class="col-12  mb-3">
      <label for="endereco" class="form-label">Endereço</label>
      <textarea class="form-control" name="endereco" id="endereco" rows="3">'.$campoendereco.'</textarea>
      <small id="help_endereco" class="form-text text-muted">'.$erros['endereco'].'</small>
    </div>';
    $form.='<button type="submit" class="btn btn-primary ">Enviar</button>';
    $form.= "<a href='index.php' class='btn btn-info m-sm-2'>Voltar</a>";


    $form.="</div></form>";
    return $form;
}

function getFormDivida($type,$dados=null){

  $_method= $type=="cadastro"? 'POST':'PUT';
  $erros=isset($_SESSION['erros_divida'])?$_SESSION['erros_divida']:null;
  $campos =isset($_SESSION['campos_divida'])?$_SESSION['campos_divida']:null;

  $campoDescricao      = $dados==null?$campos['descricao']:$dados['descricao'];
  $campoValor          = $dados==null?$campos['valor']:$dados['valor'];
  //$campoValor          =  number_format($campoValor, 2, ',', '.'); 
  $campoDataVencimento = $dados==null?$campos['data_vencimento']:$dados['data_vencimento'];
  $campoSituacao       = $dados==null?$campos['status']:$dados['status'];
  $checked =  $campoSituacao==1? "checked":"";

  $id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente']:$dados['id_cliente'];

  $form="<form action='service/index.php' method='POST'>";   
  if(isset($dados['id'])){
      $form.="<input type='hidden' name='id' value='{$dados['id']}' readonly> ";
  }
  $form.="<input type='hidden' name='_method' value='$_method' readonly> ";
  $form.="<input type='hidden' name='_action' value='divida' readonly> ";
  $form.="<input type='hidden' name='id_cliente' value='$id_cliente' readonly> ";
  $form.="<div class='row'>";
  $form.='
  <div class="col-6 mb-3">
    <label for="descricao" class="form-label">Descricao</label>
    <input type="text" class="form-control" name="descricao" id="descricao" aria-describedby="help_descricao" placeholder="descricao" value="'.$campoDescricao.'">
    <small id="help_descricao" class="form-text text-muted ">'.$erros['descricao'].'</small>
  </div>';

  $form.='
  <div class="col-6  mb-3">
    <label for="valor" class="form-label">Valor</label>
    <input type="text" class="form-control"  maxlength="11" onKeyPress="return(MascaraMoeda(this,\'.\',\',\',event))" name="valor" id="valor" aria-describedby="help_valor" placeholder="Valor" value="'.$campoValor.'">
    <small id="help_valor" class="form-text text-muted">'.$erros['valor'].'</small>
  </div>';

  $form.='</div>';
  $form.="<div class='row'>";
  $form.='
  
  <div class="col-6  mb-3">
    <label for="data_vencimento" class="form-label">Data vencimento</label>
    <input type="date" class="form-control" name="data_vencimento" id="data_vencimento" aria-describedby="help_data_vencimento" placeholder="data_vencimento" value="'.$campoDataVencimento.'">
    <small id="help_data_vencimento" class="form-text text-muted">'.$erros['data_vencimento'].'</small>
  </div>';

  $form.='<div class="form-check col-6  mb-3 pt-4">
    <input type="checkbox" class="form-check-input" name="status" id="status" value="1" '.$checked.'>
    <label class="form-check-label" for="status">
      Pago
    </label>
  </div>';
  $form.='</div>';
  $form.='<button type="submit" class="btn btn-primary ">Enviar</button>';
  $form.= "<a href='dividasCliente.php?id=$id_cliente' class='btn btn-info m-sm-2'>Voltar</a>";


  $form.="</div></form>";
  return $form;
}


?>
