<h1>TEST Dev PHP</h1>
<p>Desenvolvimento de um crud utilizando php puro.</p>

<p>testado nas versões 5.6 e 7.4</p>
<p>para o front utilização de bootstrap 5.0</p>
<br>
<p>criação das tabelas em migrations/migration_2021_10_08.sql</p

  <p>Alterar senha de conexão em  service/Database.class.php</p>

  <h1> Teste api</h1>
<ul>
<li>Empresas
    <ul>
        <li>GET  api/empresas </li>
        <li>POST      api/empresas </li>
        <li>GET  api/empresas/{codigo} </li>
        <li>PUT       api/empresas/{codigo} </li>
        <li>DELETE    api/empresas/{codigo}</li>
    </ul>
    </li>
<li>Clientes
<ul>
        <li>GET  api/empresas/{codigoEmpresa}/clientes </li>
        <li>POST      api/empresas/{codigoEmpresa}/clientes </li>
        <li>GET  api/empresas/{codigoEmpresa}/clientes/{codigoCliente} </li>
        <li>PUT       api/empresas/{codigoEmpresa}/clientes/{codigoCliente} </li>
        <li>DELETE    api/empresas/{codigoEmpresa}/clientes/{codigoCliente} </li>
    </ul>
    </li>
</ul>
<p>
 <ul>
        <li>GET  api/empresas </li>
    </ul>
    <code>
Status: 200 OK
Content-Type: application/json

{
  "empresas": [
    {
      "codigo": 1,
      "empresa": 123,
      "sigla": "ABC",
      "razao_social": "Empresa ABC",
      "updated_at": "2023-11-23T00:00:00Z",
      "created_at": "2023-11-23T00:00:00Z"
    },
    // ... Outras empresas ...
  ]
}
</code>
</p>
