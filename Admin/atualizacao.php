<?php include_once "topo.php";
      include_once "assets/classes/atualizacoes/atualizacao.php";
      include_once "assets/classes/atualizacoes/atualizacaoDao.php";

  $atualizacaoDao = new AtualizacaoDao();

  $dados = $atualizacaoDao->select();

  ?>
			
		<section>
		<div class="container">
			<div class="menu-lateral">
				<p>Ordenar por:</p>
					<select name="filtros">
						<option value="padrao">Padrão</option>
						<option value="descricao">Descrição</option>
						<option value="data">Data</option>
						<option value="titulo">Titulo</option>                                    
					</select>		
      </div>
      	
			<div class="tabela">
          <table id="playlistTable">
          <a data-modal-target="#inserir" ><button class="botao-nova">Nova Atualização</button></a>
            <caption class="titulo-tabela">Atualizações</caption>
            <thead>
              <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Data</th>
                <th colspan="2">Ações</th>

              </tr>
            </thead>

            <tbody>
            <?php foreach($dados as $atualizacoes): ?>
              <tr>
                <td><?php echo $atualizacoes['idAtualizacao']?></td>
                <td><?php echo $atualizacoes['titulo']?></td>
                <td><?php echo $atualizacoes['texto']?></td>
                <td><?php echo $atualizacoes['descricao']?></td>
                <td><a data-modal-target="#editar" class="a" name="a" data-titulo="<?php echo $atualizacoes['titulo']?>" data-id="<?php echo $atualizacoes['idAtualizacao']?>" data-descricao="<?php echo $atualizacoes['descricao']?>"><i class="fas fa-pen icone-tabela "></i></a></td>
                <td><a data-modal-target="#excluir"><i class="fas fa-trash-alt icone-tabela "></i></a></td>
              </tr>
            <?php endforeach;?>
            </tbody>
          </table>
			
			</div>

		</div>
		</section>

		<div class="modal" id="excluir">
                <div class="modal-header">
                  <div class="titulo negrito">Excluir</div>
                  <button data-close-button class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <article>
							      <p>Tem certeza que deseja excluir "Atualização 1"?</p>
                    <button data-close-button class="botao-editar" onclick="confirmaExcluir()">Editar</a>
                    <button data-close-button class="botao-editar-cancelar">Cancelar</a>
                    </article>
                </div>
            </div>
              <div id="overlay"></div>

    <div class="modal" id="editar">
					<div class="modal-header">
					  <div class="titulo negrito">Editar informações da Atualização</div>
					  <button data-close-button class="close-button">&times;</button>
					</div>
					<div class="modal-body">
						<div>

							<div class="editar-modal">
                <input type="hidden" id="id" name="id" value="" placeholder="Atualização BHJK">
                <label>Titulo:</label><input type="text"  id="titulo" name ="titulo" value="" placeholder="Atualização BHJK">      
                <label>Descrição:</label><input type="text" id="descricao" placeholder="É um legal">      
                <!--label>Data:</label><input type="text" id="data" placeholder="XX/XX/XXXX"-->      
                    <button data-close-button class="botao-editar" onclick="confirmaEditar()">Editar</a>
                    <button data-close-button class="botao-editar-cancelar">Cancelar</a>
							</div>
						</div>
					</div>
				</div>
          <div id="overlay"></div>
  
    <div class="modal" id="inserir">
					<div class="modal-header">
					  <div class="titulo negrito">Inserir Atualização</div>
					  <button data-close-button class="close-button">&times;</button>
					</div>
					<div class="modal-body">
						<div class="inserir-modal">
						<form action="" method="POST">                   
              <label>Titulo:</label><input required="true" type="text"  name="titulo" >      
              <label>Texto:</label><textarea type="text" name="texto" class="textarea-inserir"></textarea> 
              <label>Descrição:</label><input type="text" name="descricao">      
              <a href="checaInserir.php"><button class="botao-editar">Inserir</a>
              <button data-close-button class="botao-editar-cancelar">Cancelar</a>
            </form>
						</div>
					</div>
				</div>
				  <div id="overlay"></div>

        
          
<?php 

  include_once "footer.php";
  if (isset($_POST['titulo']) && $_POST['texto'] != "") {

        $atualizacao = new Atualizacao();
        $atualizacao->setTitulo($_POST['titulo']);
        $atualizacao->setTexto($_POST['texto']);
        $atualizacao->setDescricao($_POST['descricao']);
          

        $atualizacaoDao = new AtualizacaoDao();
        $msg = $atualizacaoDao->novaAtualizacao($atualizacao);

        if($msg==true){
          header("Location: checaInserir.php");
        } else {
          header("Location: index.php");
        }}
        else{
          header("Location: checaInserir.php");
        }
?>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
  $('.a').on('click', function(){
    var id = $(this).data('id');
    var titulo = $(this).data('titulo');
    var descricao = $(this).data('descricao');
    //var data = $(this).data('data');

    document.getElementById('id').value = id;
    document.getElementById('titulo').value = titulo;
    document.getElementById('descricao').value = descricao;
    //document.getElementById('data').value = data;
    console.log(nome, id);
    
  });
</script>



    
