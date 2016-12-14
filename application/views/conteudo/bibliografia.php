<body>
	<div class="col-md-offset-2 col-md-10 col-md-offset-2">	
		<?php foreach ($livros as $item): ?>
			<h2>
			<?php 
				if(isset($item->json['volumeInfo']['authors'][0]))
				{
						$autor = $item->json['volumeInfo']['authors'][0].",";
						$autor_formatado = explode(" ", $autor);
						$ultimo = end($autor_formatado);
						$nome = $autor_formatado[0];
						//echo $nome;
						echo "<strong>";
						echo strtoupper($ultimo);
						echo"</strong>"." ".$nome."; ";
				}
				if(isset($item->json['volumeInfo']['title'])){
					echo $item->json['volumeInfo']['title'].", ";
				}
				if(isset($item->json['volumeInfo']['publisher'])){
					echo $item->json['volumeInfo']['publisher'];
				}
				if(isset($item->json['volumeInfo']['publishedDate'])){
					$ano = $item->json['volumeInfo']['publishedDate']; 
					$ano_formatado = explode("-", $ano);
					$anoreal = $ano[0].$ano[1].$ano[2].$ano[3];
					echo ", ".$anoreal.".";

				}

			?>
		</h2><br>
		<?php endforeach; ?>
	</div>
</body>