<body> 	
	<div class="vertical-center">	
	  	<div class="col-xs-12 col-md-offset-1 col-md-4">
	  		<h2 align="center">Cadastrar</h2>
			<form action="<?=base_url("index.php/biblio/cadastrar"); ?>" method="post" class="form">
				<label for="">Nome Completo</label>
				<input type="text" name="nome" class="form-control">
				<label for="">Email</label>
				<input type="text" name="email" class="form-control">
				<label for="">Senha</label>
				<input type="password" name="senha" class="form-control"/>				
				<br />
				<button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
			</form>
		</div>
		<div class="col-xs-12  col-md-offset-2 col-md-4 col-sm-12">
	  		<h2 align="center">Logar</h2>
			<form action="<?=base_url("index.php/biblio/logar"); ?>" method="post" class="form">
				<label for="">Email</label>
				<input type="text" name="email" class="form-control">
				<label for="">Senha</label>
				<input type="password" name="senha" class="form-control"/>				
				<br />
				<button class="btn btn-primary btn-block" type="submit">Logar</button>
			</form>
		</div>
	</div>
</body>