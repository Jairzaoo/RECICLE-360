<?php
// Configurações do banco de dados
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'recicle';

// Conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
    if ($conn->connect_errno) {
    die("Erro na conexão: " . $conn->connect_errno);
    }

// Consulta SQL para buscar os dados da tabela
    $sql = " SELECT * FROM servicos_abertos WHERE status_execucao = 'Em Andamento' AND encerrado = '0'";
    $result = $conn->query($sql);

// Cria um array para armazenar os dados da tabela
    $dados = array();

// Verifica se há resultados
    if ($result->num_rows > 0) {
    // Itera sobre os resultados e armazena-os no array $dados
    while($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }
    } 
    else {
    echo "Nenhum resultado encontrado.";
    }

// Fecha a conexão com o banco de dados
    $conn->close();

// Inclui a página HTML para exibir os dados
   
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>RECICLE 360</title>
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<body class="p-3 m-1 border-0 ">
    <img src="logo.png" href="index.html">

    </nav>
    <h1 class="text-center font-weight-bold ">VEJA SOLICITAÇÕES EM ABERTO</h1>
    <p class="text-center font-weight-normal ">Escolha e Clique em Atribuir Solicitação </p>



  <table class="table table-striped ">
      
    <tr>
        <th></th>
        <th>ID</th>
        <th>ID SOLICITAÇÃO</th>
        <th>RECOLHEDOR</th>
        <th>CONTATO RECOLHEDOR</th>
        <th>STATUS EXECUÇÃO</th>
        
    </tr>
      <?php
        foreach ($dados as $row) {
        echo "<tr>";
        echo "<td><input type='checkbox' class='form-check-input' data-toggle='modal' data-target='#modalConfirmacao' data-id='{$row['id']}'></td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['solicitacao_id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['contato'] . "</td>";
        echo "<td>" . $row['status_execucao'] . "</td>";
        echo "</tr>";
        }
      ?>
  </table>
    <br><br>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Atribuir Solicitação
</button>

<!-- Modal -->
<div class="modal fade" id="modalConfirmacao" tabindex="-1"  aria-labelledby="modalConfirmacaoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalConfirmacaoLabel">Confirmar Exclusão</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Tem certeza de que deseja excluir este registro?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="btnExcluir">Excluir</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Adicionando o JS do Bootstrap e jQuery (necessário para funcionalidades avançadas) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      // Ao clicar em um checkbox, atualiza o ID no botão de exclusão do modal
      $('.form-check-input').change(function() {
        $('.form-check-input').not(this).prop('checked', false);
        var id = $(this).data('id');
        $('#btnExcluir').attr('data-id', id);
      });

      // Ao clicar no botão de exclusão do modal, executa a exclusão no banco de dados
      $('#btnExcluir').click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
          type: 'POST',
          url: 'excluir.php', // Arquivo PHP para processar a exclusão
          data: { id: id },
          success: function(response) {
            console.log(response); // Exibe a resposta do servidor no console
            // Aqui você pode adicionar lógica para atualizar a tabela após a exclusão
          }
        });
        $('#modalConfirmacao').modal('hide');
      });

      // Ao clicar no botão de cancelar do modal, desmarca o checkbox
      $('#btnCancelar').click(function() {
        $('.form-check-input').prop('checked', false);
      });
    });
  </script>
    
    <button onclick="window.location.href = 'index.html';" class="btn btn-info">Home</button>
    <br>

       




     
    
    
    
    
    
    <br>
    <footer class="bg-dark text-light py-4">
        <div class="container text-center">
            <p>&copy; PROJETO INTEGRADOR UNIVESP - 2024 </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>  
</html> 