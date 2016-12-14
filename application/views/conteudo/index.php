<body>
  	<div class="container-fluid">
  		<div class="row">
  			<h3 align="center">Bem Vindo! <?php echo $this->session->userdata('usuario');?></h3>
  			<p align="center"><a href="<?php echo base_url("index.php/Biblio/logout")?>"><button class="btn btn-danger btn-sm">Logout</button></a></p>
  		</div>
  		<div class="row">
	  		<div class="vertical-center">
			  	<div class="col-xs-12 col-md-offset-4 col-md-4 col-md-offset-4 col-sm-12">		  			
					<form action="<?=base_url("index.php/biblio/buscar"); ?>" method="post" class="form">
						<label for="">Selecione uma Opção</label>
						<select name="tipo" id="tipo" class="form-control">
							<option value="autor">Autor</option>
							<option value="livro">Livro</option>
							<option value="isbn">ISBN</option>
							<option value="editora">Editora</option>
							<option value="subtitulo">Subtítulo</option>
						</select><br />
						<label for=""> Digite sua Busca</label>
							<input type="text" name="resposta" class="form-control"/>				
						<br />
						<button class="btn btn-primary btn-block" type="submit">Buscar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>