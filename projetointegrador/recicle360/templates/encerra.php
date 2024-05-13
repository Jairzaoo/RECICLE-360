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
    <link rel="shortcut icon" href="data:image/png;base64,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" type="image/x-icon">
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