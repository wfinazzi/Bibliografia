<body>
  	<div class="container-fluid">
  		<div class="row">
  			<h3 align="center">Bem Vindo! <?php echo $this->session->userdata('usuario');?></h3>
  			<p align="center"><a href="<?php echo base_url("index.php/Biblio/logout")?>"><button class="btn btn-danger btn-sm">Logout</button></a></p>
  		</div>
  		<div class="row">
	  		<div class="vertical-center">
	  			<?php if(!$biblioteca):?>
				  	<div class="col-xs-12 col-md-offset-4 col-md-4 col-md-offset-4 col-sm-12">		  			
						<form action="<?=base_url("index.php/biblio/inserir_biblioteca"); ?>" method="post" class="form">
							<label for="">Dê um Nome a Sua Bibliografia</label>
								<input type="text" name="titulo" class="form-control"/>	
								<input type="hidden" name="id_usuario" value="<?php echo $this->session->userdata('id');?>" class="form-control"/>			
							<br />
							<button class="btn btn-primary btn-block" type="submit">Buscar</button>
						</form>
					</div>
				<?php else : ?>
					<div class="col-xs-12 col-md-offset-4 col-md-4 col-md-offset-4 col-sm-12">		  			
						<h1 align="center"><a href="<?php echo base_url("index.php/Biblio/home") ?>">Buscar Livros</a></h1>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</body>