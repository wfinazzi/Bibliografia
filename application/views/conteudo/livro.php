
  <body>
<?php 
	function binToStr($str){ 
    
	    $string = ''; 
	    for($i=0;$i<count($str);$i++){ 
	        $string .= chr(bindec($str[$i])); 
	    } 
	    return $string; 
	} 

	$json = json_decode($file, true); 		
?>  	
	
	<h1 align="center">Livros Cadastrados</h1>
	<hr>
	<div class="col-md-offset-1 col-md-10 col-md-offset-1">	
		<?php foreach ($livros as $item): ?>
			<div class="well well-sm">
				<a href="<?php echo base_url("index.php/biblio/excluir_livro/$item->id/$nome/$tipo")?>"><i class="fa fa-times" aria-hidden="true"></i></a>		
				<?php echo $item->json['volumeInfo']['title'] ?>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="col-md-offset-1 col-md-10 col-md-offset-1">		
		<center>
			<br>
			<a href="<?php echo base_url("index.php/biblio/bibliografia")?>"><button class="btn btn-danger"><i class="fa fa-list" aria-hidden="true"></i>  Ver Bibliografia</button></a>
			<a href="<?php echo base_url("index.php/biblio/pdf")?>"><button class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Gerar Bibliografia</button></a>
			<hr>
			<h1 align="center">Resultados da Busca</h1>		
		</center>
	</div>
	<div class="livros">  
		<div class="col-md-offset-1 col-md-10 col-md-offset-1">	
			
		<?php if(isset($json['items'])):?>
			<h3><center>Exibindo Resultados para : <?php print_r($nome); ?></center></h3>
			<?php foreach ($json['items'] as $item):?> 
			<div class="wow fadeInDown">
			  	<div class="col-md-4 hvr-wobble-vertical">
					<div class=" panel panel-primary" style="height:800px">
				  		<div class="panel-heading"><p align="center"><?php echo  $item['volumeInfo']['title'] ?></p></div>
				  		<div class="panel-body">
							<div class="col-md-12">
				  				<p align="center"><img class="img-responsive" src='<?=$item["volumeInfo"]["imageLinks"]["thumbnail"];?>' alt="Livro"></p>
				  			</div>
				  			
				  			<div class="col-md-12">
				  				<br><br>
				  				<p><strong>Título:</strong> <?php echo  $item['volumeInfo']['title'] ?></p>
				  				<?php if(isset($item['volumeInfo']['authors'][0])):?>
				  					<p><strong>Nome Do Autor:</strong> <?php echo $item['volumeInfo']['authors'][0] ?></p>
				  				<?php endif; ?>
				  				<?php if(isset($item['volumeInfo']['publisher'][0])):?>
				  					<p><strong>Editora:</strong> <?php echo  $item['volumeInfo']['publisher'] ?> </p>
				  				<?php endif; ?>	
				  				<?php if(isset($item['volumeInfo']['publishedDate'])):?>
									<?php $ano = explode("-", $item['volumeInfo']['publishedDate'])?>

				  					<p><strong>Ano de Publicação:</strong> <?php echo $ano[0]; ?> </p>
				  				<?php endif; ?>	
				  				<?php if(isset($item['volumeInfo']['industryIdentifiers'][0]['identifier'])):?>
				  					<p><strong>ISBN:</strong> <?php echo $item['volumeInfo']['industryIdentifiers'][0]['identifier'] ?></p>
				  				<?php endif; ?>	
				  				<a href="<?php echo  $item['volumeInfo']['previewLink'] ?>"><button class="btn btn-danger btn-block">Ler na Web</button></a><br>
				  				<a href="<?php echo base_url('index.php/biblio/inserir_livro')?>/<?php echo $item['id'] ?>/<?php echo $nome."/".$tipo."/".$biblioteca ?>"><button class="btn btn-primary btn-block">Adicionar a Bibliografia</button></a>
				  			</div>
				  		</div>
					</div>
				</div>  
			</div>
			<?php endforeach;?> 
		<?php else :?>
			<h3>
				<center>Nao ha resultados para <?php print_r($nome); ?></center>
			</h3>
		<?php endif;?>
		</div>
	</div>
