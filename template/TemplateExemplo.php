<?php
session_start();
$path = $_SESSION['PATH_SYS'];

/**
 * Description of Template
 *
 * @author Lombardi
 */

class Template {

    public static $path;

	function __construct()
	{
		self::$path = $_SESSION['URL_SYS'];
	}

   //Começa topo site, menu das cidades banner circuito das malhas --> 	
   public function topoSite()
   {
    $cidadeController = new CidadeController();
    $listaCidade = $cidadeController->selectAllsCidades(); 
    if (isset($_GET["categoria"]))  {
    	$categoria = "&categoria=".$_GET["categoria"];
    	$pcidade = "categoria";
    }else{
    	$pcidade = "cidade";
    }
   	echo "<div class=\"block_header\">
              <div class=\"menusTopo\">
                  <ul id=\"menuCidades\">
                  <li class=\"tituloMenu\">Cidades do circuito</li>";
                  foreach ($listaCidade as $cidade)
                  {
                     echo "<li><a href=\"".$pcidade.".php?city=".$cidade->getIdCidade()."".$categoria."\">".utf8_encode($cidade->getNomeCidade())."</a></li>";
                  }  
                  echo "</ul>
              </div>
              <div class=\"clr\"></div>
            </div>";
   }
   //<--
  
   //Começa slide cidade com as imagens e os textos referentes a cada cidade-->  
   public function slideCidade($categoria,$idCity)
   {
   //echo $_GET["city"];
   //echo "<pre>";
   	//print_r($city); 
   	
   	$cidadeController = new CidadeController();
   	$cidade = $cidadeController->selectCidadesById($idCity);

      		switch ($cidade->getNomeCidade()){
   				case "Borda da Mata":
   					echo "<div class=\"slice1\" id=\"section-1\" style=\"display:none;\">
			        <p class=\"img\"><a href=\"cidade.php?city=".$cidade->getIdCidade()."\"><img src=\"images/bordadamata01.jpg\" alt=\"screen 1\" width=\"413\" height=\"241\"/></a></p>
			        <h2>".$cidade->getNomeCidade()."</h2>
			        <span>".utf8_encode($cidade->getTituloCidade())."</span>
			        <div id=\"traco\"></div>
			        <p>".utf8_encode($cidade ->getTextoCidade())."</p>		       	        	
		        	</div>";
   				break;
   				case "Inconfidentes":
   					echo "<div class=\"slice1\" id=\"section-2\" style=\"display:none;\">
			        <p class=\"img\"><a href=\"cidade.php?city=".$cidade->getIdCidade()."\"><img src=\"images/inconfidentes01.jpg\" alt=\"screen 1\" width=\"413\" height=\"241\" /></a></p>
			        <h2>".$cidade->getNomeCidade()."</h2>
			        <span>".utf8_encode($cidade->getTituloCidade())."</span>
			        <p>".utf8_encode($cidade ->getTextoCidade())."</p>					        	
		        	</div>";
   				break;
   				case "Jacutinga":
   					echo "<div class=\"slice1\" id=\"section-3\" style=\"display:none;\">
			        <p class=\"img\"><a href=\"cidade.php?city=".$cidade->getIdCidade()."\"><img src=\"images/jacutinga01.jpg\" alt=\"screen 4\" width=\"413\" height=\"241\" /></a></p>
			        <h2>".$cidade->getNomeCidade()."</h2>
			        <span>".utf8_encode($cidade->getTituloCidade())."</span>
			        <p>".utf8_encode($cidade->getTextoCidade())."</p>        	  
			    	</div>";
   				break;
   				case "Monte Sião":
   					echo "<div class=\"slice1\" id=\"section-4\" style=\"display:none;\">
			        <p class=\"img\"><a href=\"cidade.php?city=".$cidade->getIdCidade()."\"><img src=\"images/montesiao01.jpg\" alt=\"screen 4\" width=\"413\" height=\"241\" /></a></p>
			        <h2>".utf8_encode($cidade->getNomeCidade())."</h2>
			        <span>".$cidade->getTituloCidade()."</span>
			        <p>".utf8_encode($cidade->getTextoCidade())."</p>
			       
		     	   </div>";
   				break;
   				case "Ouro Fino":
   					echo "<div class=\"slice1\" id=\"section-5\" style=\"display:none;\">
			        <p class=\"img\"><a href=\"cidade.php?city=".$cidade->getIdCidade()."\"><img src=\"images/ourofino01.jpg\" alt=\"screen 3\" width=\"413\" height=\"241\" /></a></p>
			        <h2>".$cidade->getNomeCidade()."</h2>
			        <span>".utf8_encode($cidade->getNomeCidade())."</span>
			        <p>".utf8_encode($cidade->getTextoCidade())."</p>
			        
		        	
		        	</div>";
   				break;
   				default:
   					echo "<div class=\"slice1\" id=\"section-5\" style=\"display:none;\">
			        <p class=\"img\"><img src=\"images/home.jpg\" alt=\"screen 3\" width=\"413\" height=\"241\" /></p>
			        <h2>Circuito</h2>
			        <span>Grandes Cidades</span>			                
			        <p>".utf8_encode('O circuito turístico das malhas é conhecido pelo charme de suas cidades. Pequenas preciosidades
			        que guardam belezas únicas: lugares que conservam o charme do interior mineiro.Visitantes de diversas regiões do país rendem
			        as seus encantos.A variedade de doces e queijos, a temperatura agradável das montanhas e cachoeiras nos vales reservam aos turístas 
			        momentos agradáveis e relaxante para toda família.')."</p>
			        </div>";				   				
   			}      	
   			switch ($categoria){
   				case gastronomia:
   					$nameCategoria = "- Gastronomia";
   				break;
   				case ondeficar:
   					$nameCategoria = "- Onde Ficar";
   				break;
   				case atrativos:
   					$nameCategoria = "- Atrativos ".utf8_encode(Turísticos);
   				break;
   				case lazer:
   					$nameCategoria = "- Lazer e Entretenimento";
   				break;
   				case artesanatos:
   					$nameCategoria = "- Artesanatos";
   				break; 
   				case ondecomprar:
   					$nameCategoria = "- Onde Comprar";
   				break; 
   				case eventos:
   					$nameCategoria = "- Eventos";
   				break;  
   				case galeria:
   					$nameCategoria = "- Galeria";
   				break; 
   				case contato:
   					$nameCategoria = "- Contato";
   				break; 				   				
   			}
   		   if ($idCity<>0)
   		   {   
	   		   echo "
	   		   <div id=\"barraCity\">
	   		   	<div id=\"box_titulo\">
		   		   	<span class=\"tituloCity\"><a href=\"cidade.php?city=".$cidade->getIdCidade()."\">".utf8_encode($cidade->getNomeCidade())."</a></span >  
		   		   	<span class=\"subtituloCity\">".$nameCategoria."</span>
		   		</div>
	   		  </div>";
   		   }else{ 							
				$evento = new EventoController();
				$todascidade = $cidadeController->selectAllsCidades();
								
				foreach ($todascidade as $listaCidade){
					$listaEvento = $evento->selectAllEventoByCidadeMesMarquee($listaCidade->getIdCidade());
					//echo "<pre>";
    				//print_r($listaEvento);
    				
    				$data = Functions::formata_data($listaEvento->getDataEvento());
    				if ($listaEvento->getDataEvento()){    					
    					$tituloEvento .=" <img src=\"images/Arrow-Left.png\" width=\"39\" height=\"37\"/>".utf8_encode($listaCidade->getNomeCidade())." ( ".$data." ) ".$listaEvento->getTituloEvento()."  ";
    				}
    			}				
				echo "<div id=\"barraCity\">
			      <div id=\"box_titulo\">
			      	<p id=\"textM\">".utf8_encode(Próximos)." eventos:</p>
			      	<span style=\"color:#72941b;font-size:40px;\"><marquee width=\"950\" height=\"60\">".$tituloEvento."</marquee></span>
			   		</div>
			    </div>";								
   		   }
	} 	
	//<--
	
	//menu parte de cima do slide ("home,eventos,galeria,contato")-->	
	public function menuSlider($idCidade)
	{
		if($idCidade<>null){	
			$cidade = new CidadeController();
			$listaCidade = $cidade->selectCidadesById($idCidade);
			$nomeCidade = $listaCidade->getNomeCidade();
			echo "<div class=\"menu\">
			        <ul>
			          <li><a href=\"index.php?city=$idCidade\" class=\"active\"><span>Home</span></a></li>
			          <li><a href=\"categoria.php?city=$idCidade&categoria=eventos\" ><span>Eventos</span></a></li>
			          <li><a href=\"categoria.php?city=$idCidade&categoria=galeria\"><span>Galeria</span></a></li>
	         		  <li><a href=\"categoria.php?city=$idCidade&categoria=contato\"><span>Contato</span></a></li>
			        </ul>
			      </div>
			      <div class=\"clr\"></div>";
		}else{
			echo "<div class=\"menu\">
			        <ul>
			          <li><a href=\"index.php?city=$idCidade\" class=\"active\"><span>Home</span></a></li>
			          <li><a href=\"categoria.php?city=$idCidade&categoria=eventos\" ><span>Eventos</span></a></li>
			          <li><a href=\"categoria.php?city=$idCidade&categoria=galeria\"><span>Galeria</span></a></li>
	         		  <li><a href=\"categoria.php?city=$idCidade&categoria=contato\"><span>Contato</span></a></li>
			        </ul>
			      </div>
			      <div class=\"clr\"></div>";
		}		
	}
	//<--
	
	
	//menu lateral categorias "lista as categorias (gastronomia,onde ficar,atrativos,lazer,artesanatos,eventos,galeria e contato)"--> 
	public function menuCategoria($idCidade)
	{
	  echo"<ul id=\"menuUteis\">
	         	<li><a href=\"categoria.php?city=$idCidade&categoria=gastronomia\" class=\"gastronomia\">".utf8_encode("Gastrônomia")."</a></li>
	            <li><a href=\"categoria.php?city=$idCidade&categoria=ondeficar\" class=\"hotelaria\">Onde Ficar</a></li>
	            <li><a href=\"categoria.php?city=$idCidade&categoria=atrativos\" class=\"turismo\">".utf8_encode("Atrativos Turísticos")."</a></li>
	            <li><a href=\"categoria.php?city=$idCidade&categoria=lazer\" class=\"laser\">Lazer e Entretenimento</a></li>
	            <li><a href=\"categoria.php?city=$idCidade&categoria=artesanatos\" class=\"artesanato\">Artesanatos</a></li>
	            <li><a href=\"categoria.php?city=$idCidade&categoria=ondecomprar\" class=\"ondecomprar\">Onde Comprar</a></li>
	            <li><a href=\"categoria.php?city=$idCidade&categoria=eventos\" class=\"eventos\">Eventos</a></li>
	         	<li><a href=\"categoria.php?city=$idCidade&categoria=galeria\" class=\"galeria\">Galeria</a></li>
	         	<li><a href=\"categoria.php?city=$idCidade&categoria=contato\" class=\"contato\">Contato</a></li>
	       </ul>";
	}
	//<--
	
	//Lista as categorias por id da cidade ou todas quando não houver o id.
	//vai ser listado na página de categoria, dependendo da categoria que vier lista determinado case..
	public function listaAllCategorias($idCidade,$categoria)
	{
		//com o id da cidade lista:
		if($idCidade<>null)
		{
			switch($categoria){
				case gastronomia:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategoriasByCidade($idCidade,$categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\">
							<h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case ondeficar:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategoriasByCidade($idCidade,$categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case atrativos:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategoriasByCidade($idCidade,$categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case lazer:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategoriasByCidade($idCidade,$categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	
			 	case artesanatos:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategoriasByCidade($idCidade,$categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case ondecomprar:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategoriasByCidade($idCidade,$categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case eventos:
					echo "<div id=\"meio\">
            		<div id=\"eventos\">";
			            	echo "<h2>Eventos</h2>"; 
				  			$this->listaEventoMeses($idCidade,1,"Janeiro");
							$this->listaEventoMeses($idCidade,2,"Fevereiro");
							$this->listaEventoMeses($idCidade,3,"MarÃ§o");
							$this->listaEventoMeses($idCidade,4,"Abril");
							$this->listaEventoMeses($idCidade,5,"Maio");
							$this->listaEventoMeses($idCidade,6,"Junho");
							$this->listaEventoMeses($idCidade,7,"Julho");
							$this->listaEventoMeses($idCidade,8,"Agosto");
							$this->listaEventoMeses($idCidade,9,"Setembro");
							$this->listaEventoMeses($idCidade,10,"Outubro");
							$this->listaEventoMeses($idCidade,11,"Novembro");
							$this->listaEventoMeses($idCidade,12,"Dezembro");		    	              
		            	 echo"</div>
		           		 <div id=\"barra_separador\"></div>
		            	 <div class=\"boxPrevGaleria\">";
		                     $this->listaFotosDeEventoByCidade($idCidade);
		          		 echo"</div>            
		            	 <div class=\"separador\"></div>
		            	 <div class=\"separador\"></div>
	         	    </div>
         		";          
				break;
			 	case galeria:			 		
			 		echo "			 		
			 		<div id=\"meio\">
            		     <div id=\"box_imagens\">                	
                  	     <h2>Galeria de fotos</h2>";
                         $this->listaAllFotosGaleria($idCidade);
               	
                   	echo "</div> 
                 		<div class=\"separador\"></div>
                 		<div class=\"separador\"></div>
            			</div>";
				   	break;	

				case contato:
					$cidadeController = new CidadeController();
					$nomeCidade = $cidadeController->selectCidadesById($idCidade);
					
			 		echo"<div id=\"meio\">
			 		<div id=\"contatos\">
			          <h2>Contato: Circuito TurÃ­stico das Malhas/".utf8_encode($nomeCidade->getNomeCidade())."</h2>
			          <form action=\"\" name=\"contatos\" method=\"post\">
			            <fieldset>
			              <legend>FormulÃ¡rio</legend>
			              <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			                <tr>
			                  <td width=\"85\" align=\"right\">Nome.:</td>
			                  <td width=\"455\" align=\"left\"><label>
			                    <input name=\"nome\" type=\"text\" id=\"nome\" size=\"40\" />
			                  </label></td>
			                </tr>
			                <tr>
			                  <td align=\"right\">Email.:</td>
			                  <td align=\"left\"><label>
			                    <input name=\"email\" type=\"text\" id=\"email\" size=\"40\" />
			                  </label></td>
			                </tr>
			                <tr>
			                  <td align=\"right\">Assunto.:</td>
			                  <td align=\"left\"><label>
			                    <input name=\"assunto\" type=\"text\" id=\"assunto\" size=\"40\" />
			                  </label></td>
			                </tr>
			                <tr>
			                  <td align=\"right\" valign=\"top\">Mensagem.:</td>
			                  <td align=\"left\" valign=\"top\"><label>
			                    <textarea name=\"mensagem\" id=\"mensagem\" cols=\"45\" rows=\"5\"></textarea>
			                  </label></td>
			                </tr>
			                <tr>
			                  <td align=\"right\"><label>
			                    <input type=\"submit\" name=\"button\" id=\"button\" value=\"enviar\" />
			                  </label></td>
			                  <td align=\"left\"><label>
			                    <input type=\"reset\" name=\"button2\" id=\"button2\" value=\"apagar\" />
			                  </label></td>
			                </tr>
			                <tr align=\"left\">
			                  <td>&nbsp;</td>
			                  <td>&nbsp;</td>
			                </tr>
			              </table>
			            </fieldset>
			          </form>
			          </div>
			          </div>";
			}
			//sem o id da cidade lista :
			}else{				
			switch($categoria){
				case gastronomia:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategorias($categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case ondeficar:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategorias($categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case atrativos:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategorias($categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case lazer:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategorias($categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case artesanatos:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategorias($categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case ondecomprar:
				echo "<div id=\"meio\">
				      <div id=\"categoria\">";            
					$categoriaCat= new CategoriaController();
					$listaCategoria = $categoriaCat->selectAllCategorias($categoria);
					foreach ($listaCategoria as $categoriaCidade)
					{	
						echo "<div id=\"bloco_categoria\"><h3>".$categoriaCidade->getTituloCategoria()."</h3>
							<h2>".$categoriaCidade->getEnderecoCategoria()."</h2>
							<h4>".$categoriaCidade->getTelefoneCategoria()."</h4></div>" ;
					}
					echo "</div>            
          				 </div>";
			 	break;
			 	case eventos:
					echo "<div id=\"meio\">
            		<div id=\"eventos\">";
			            	echo "<h2>Eventos do Circuito</h2>"; 
				  			$this->listaEventoMeses($idCidade,1,"Janeiro");
							$this->listaEventoMeses($idCidade,2,"Fevereiro");
							$this->listaEventoMeses($idCidade,3,"MarÃ§o");
							$this->listaEventoMeses($idCidade,4,"Abril");
							$this->listaEventoMeses($idCidade,5,"Maio");
							$this->listaEventoMeses($idCidade,6,"Junho");
							$this->listaEventoMeses($idCidade,7,"Julho");
							$this->listaEventoMeses($idCidade,8,"Agosto");
							$this->listaEventoMeses($idCidade,9,"Setembro");
							$this->listaEventoMeses($idCidade,10,"Outubro");
							$this->listaEventoMeses($idCidade,11,"Novembro");
							$this->listaEventoMeses($idCidade,12,"Dezembro");		    	              
		            	 echo"</div>
		           		 <div id=\"barra_separador\"></div>
		            	 <div class=\"boxPrevGaleria\">";
		                     $this->listaFotosDeEventoByCidade($idCidade);
		          		 echo"</div>            
		            	 <div class=\"separador\"></div>
		            	 <div class=\"separador\"></div>
	         	    </div>
         		";          
				break;
			 	case galeria:
			 		echo "<div id=\"meio\">
            		     <div id=\"box_imagens\">                	
                  	     <h2>Galeria de fotos</h2>";
                         $this->listaAllFotosGaleria($idCidade);
               	
                   	echo "</div> 
                 		<div class=\"separador\"></div>
                 		<div class=\"separador\"></div>
            			</div>";
				   	break;
				   	
			 	case contato:
			 		echo"<div id=\"meio\">
			 		<div id=\"contatos\">
			          <h2>Contato: Circuito TurÃ­stico das Malhas</h2>
			          <form action=\"\" name=\"contatos\" method=\"post\">
			            <fieldset>
			              <legend>FormulÃ¡rio</legend>
			              <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			                <tr>
			                  <td width=\"85\" align=\"right\">Nome.:</td>
			                  <td width=\"455\" align=\"left\"><label>
			                    <input name=\"nome\" type=\"text\" id=\"nome\" size=\"40\" />
			                  </label></td>
			                </tr>
			                <tr>
			                  <td align=\"right\">Email.:</td>
			                  <td align=\"left\"><label>
			                    <input name=\"email\" type=\"text\" id=\"email\" size=\"40\" />
			                  </label></td>
			                </tr>
			                <tr>
			                  <td align=\"right\">Assunto.:</td>
			                  <td align=\"left\"><label>
			                    <input name=\"assunto\" type=\"text\" id=\"assunto\" size=\"40\" />
			                  </label></td>
			                </tr>
			                <tr>
			                  <td align=\"right\" valign=\"top\">Mensagem.:</td>
			                  <td align=\"left\" valign=\"top\"><label>
			                    <textarea name=\"mensagem\" id=\"mensagem\" cols=\"45\" rows=\"5\"></textarea>
			                  </label></td>
			                </tr>
			                <tr>
			                  <td align=\"right\"><label>
			                    <input type=\"submit\" name=\"button\" id=\"button\" value=\"enviar\" />
			                  </label></td>
			                  <td align=\"left\"><label>
			                    <input type=\"reset\" name=\"button2\" id=\"button2\" value=\"apagar\" />
			                  </label></td>
			                </tr>
			                <tr align=\"left\">
			                  <td>&nbsp;</td>
			                  <td>&nbsp;</td>
			                </tr>
			              </table>
			            </fieldset>
			          </form>
			          </div>
			          </div>";
			}								    
		}
	}
	//<--		
	
	//Lista 15 fotos das cidades aleatórias na página principal-->
	public function listaAllFotosGaleriaCidades()
	{
		$fotoGaleria = new GaleriaFotoController();
		$listaFotoGaleria = $fotoGaleria->selectAllGaleriaFoto();				
		echo ' <table width="570" cellspacing="2" cellpadding="2"><tr>';
		$i=0;
		foreach ($listaFotoGaleria as $fotoGaleria)
		{	
			$cidade = new CidadeController();
			$listaCidade = $cidade->selectCidadesById($fotoGaleria->getCidadeGaleria());

    		
			if($i <= 3 ){
					echo '
					<td><a href="categoria.php?city='.$fotoGaleria->getCidadeGaleria().'&categoria=galeria"><img src='.self::$path['URL_MINIATURAS'].''.$fotoGaleria->getFotoGaleria().' title="'.utf8_encode($listaCidade->getNomeCidade()).'"></a></td>';
			   $i++;				 
			   }else{
				   echo '</tr><tr>
							<td><a href="categoria.php?city='.$fotoGaleria->getCidadeGaleria().'&categoria=galeria"><img src='.self::$path['URL_MINIATURAS'].''.$fotoGaleria->getFotoGaleria().' title="'.utf8_encode($listaCidade->getNomeCidade()).'"></a>
						</td>';
					$i=1;	
			   }	
	     }
		 echo '</table>';
	}	
	//<--
	
	//Lista todas as fotos da galeria por cidade, na página cidade -->
	public function listaFotosByCidade($idCidade)
	{
		$fotoGaleria = new GaleriaFotoController();
		$listaFotoGaleria = $fotoGaleria->selectAllGaleriaFotoByCidade($idCidade);
		echo ' <table width="570" cellspacing="2" cellpadding="2"><tr>';
		$i=0;
		foreach ($listaFotoGaleria as $fotoGaleria)
		{		      	 		   			
			if($i <= 3 ){
					echo '
					
					<td><a href=categoria.php?city='.$fotoGaleria->getCidadeGaleria().'&categoria=galeria><img src='.self::$path['URL_MINIATURAS'].''.$fotoGaleria->getFotoGaleria().' title="Clique na imagem e '.utf8_encode("vá").' para galeria de fotos!"></a></td>';
			   $i++;				 
			   }else{
				   echo '</tr><tr>
							<td><a href=categoria.php?city='.$fotoGaleria->getCidadeGaleria().'&categoria=galeria><img src='.self::$path['URL_MINIATURAS'].''.$fotoGaleria->getFotoGaleria().' title="Clique na imagem e '.utf8_encode("vá").' para galeria de fotos!">
						</a></td>';
					$i=1;	
			   }	
	     }
		 echo '</table>';	
	}
	//<--
	
	//Lista todas as fotos na página galeria se houver o id da cidade lista da cidade, senão houver o id lista aleatória de todas as cidades-->
	public function listaAllFotosGaleria($idCidade)
	{
		if($idCidade<>null)
		{
			$fotoGaleria = new GaleriaFotoController();
			$listaFotoGaleria = $fotoGaleria->selectAllGaleriaFotoByCidade($idCidade);
			echo ' <table class="fotos" width="570" cellspacing="2" cellpadding="2"><tr>';
			$i=0;
			foreach ($listaFotoGaleria as $fotoGaleria)
			{		      	 		   			
				if($i <= 3 ){
						echo '
						<td><a href="'.self::$path['URL_IMGG'].''.$fotoGaleria->getFotoGaleria().'"><img src='.self::$path['URL_MINIATURAS'].''.$fotoGaleria->getFotoGaleria().' title="Clique na imagem para '.utf8_encode("ampliá-la").'!"></a></td>';
				   $i++;				 
				   }else{
					   echo '</tr><tr>
								<td><a href="'.self::$path['URL_IMGG'].''.$fotoGaleria->getFotoGaleria().'"><img src='.self::$path['URL_MINIATURAS'].''.$fotoGaleria->getFotoGaleria().' title="Clique na imagem para '.utf8_encode("ampliá-la").'!"></a>
							</td>';
						$i=1;	
				   }	
		     }
			 echo '</table>';
		}else{
			$fotoGaleria = new GaleriaFotoController();
			$listaFotoGaleria = $fotoGaleria->selectAllGaleriaFotoAllCidades();
			echo ' <table class="fotos" width="560" cellspacing="2" cellpadding="2"><tr>';
			$i=0;
			foreach ($listaFotoGaleria as $fotoGaleria)
			{		      	 		   			
				if($i <= 3 ){
					echo '
					<td ><a href="'.self::$path['URL_IMGG'].''.$fotoGaleria->getFotoGaleria().'"><img src='.self::$path['URL_MINIATURAS'].''.$fotoGaleria->getFotoGaleria().'></a></td>';
			   		$i++;				 
				   }else{
				   echo '</tr><tr>
							<td><a href="'.self::$path['URL_IMGG'].''.$fotoGaleria->getFotoGaleria().'"><img src='.self::$path['URL_MINIATURAS'].''.$fotoGaleria->getFotoGaleria().'></a></td>';
					$i=1;	
				   }	
		     }
			 echo '</table>';
		}	
	}
	//<--
	
	//lista todos os patrocinadores "index.php"-->
	public function listaAllPatrocinador()
	{
		$patrocinio = new PatrocinioController();
		$listaPatrocinio = $patrocinio->selectAllPatrocinio();
		foreach ($listaPatrocinio as $patrocinador)
		{
			echo"<p><a href=\"patrocinador.php?city=".$patrocinador->getCidadePatrocinio()."&patrocinio=".$patrocinador->getIdPatrocinio()."\"><img src='".self::$path['URL_MINIATURAS'].''.$patrocinador->getImgPatrocinio()."'></a></p>";		
		}
	}
	//<--
	
	//Lista patrocinadores por cidade "cidade.php"-->
	public function listaPatrocinador($idCidade)
	{ 
		if ($idCidade<>null)
		{
			$patrocinio = new PatrocinioController();
			$listaPatrocinio = $patrocinio->selectPatrocinioByCidade($idCidade);
			foreach ($listaPatrocinio as $patrocinador)
			{
				echo"<p><a href=\"patrocinador.php?city=".$idCidade."&patrocinio=".$patrocinador->getIdPatrocinio()."\"><img src='".self::$path['URL_MINIATURAS'].''.$patrocinador->getImgPatrocinio()."'title='Clique e saiba mais sobre o patrocinador!'></a></p>";
			}
		}else{
			$patrocinio = new PatrocinioController();
			$listaPatrocinio = $patrocinio->selectAllPatrocinio();
			foreach ($listaPatrocinio as $patrocinador)
			{
				echo"<p><a href=\"patrocinador.php?city=".$patrocinador->getCidadePatrocinio()."&patrocinio=".$patrocinador->getIdPatrocinio()."\"><img src='".self::$path['URL_MINIATURAS'].''.$patrocinador->getImgPatrocinio()."'title='Clique e saiba mais sobre o patrocinador!'></a></p>";		
			}
		}
	}
	//<--
	
	//lista os dados dos patrocinadores na página patrocinador-->
	public function dadosPatrocinador($idPatrocinio)
	{
		$patrocinio = new PatrocinioController();
		$listaPatrocinio = $patrocinio->selectPatrocinioById($idPatrocinio);		
		
		$cidadeController = new CidadeController();
   		$listaCidade = $cidadeController->selectCidadesById($listaPatrocinio->getCidadePatrocinio()); 
   		
		echo "<h3>".$listaPatrocinio->getTituloPatrocinio()."</h3>
               		<div id=\"box_patrocinadorImg\">
                    	<img src='".self::$path['URL_IMGG'].''.$listaPatrocinio->getImgPatrocinio()."'/>
                    </div>
                    <div id=\"dados_patrocinador\">
                    	<fieldset>
							<legend><strong>Dados do Patrocinador</strong></legend>
	                    	<table>
							    <tr>
							      <td align=\"right\" bgcolor=\"#FFFFFF\"><h2>".utf8_encode("Endereço").":</h2></td>
							      <td>".$listaPatrocinio->getEnderecoPatrocinio()."</td>
						        </tr>
							    <tr>
							      <td align=\"right\" bgcolor=\"#FFFFFF\"><h2>Bairro:</h2></td>
							      <td>".$listaPatrocinio->getBairroPatrocinio()."</td>
						        </tr>
							    <tr>
							      <td align=\"right\" bgcolor=\"#FFFFFF\"><h2>Cidade:</h2></td>
							      <td>".utf8_encode($listaCidade->getNomeCidade())."</td>
						        </tr>
							    <tr>
							      <td align=\"right\" bgcolor=\"#FFFFFF\"><h2>Telefone:</h2></td>
							      <td>".$listaPatrocinio->getTelefonePatrocinio()."</td>
						        </tr>
							    <tr>
							      <td align=\"right\" bgcolor=\"#FFFFFF\"><h2>E-mail:</h2></td>
							      <td>".$listaPatrocinio->getEmailPatrocinio()."</td>
						        </tr>
							    <tr>
							      <td align=\"right\" bgcolor=\"#FFFFFF\"><h2>Site:</h2></td>
							      <td>".$listaPatrocinio->getSitePatrocinio()."</td>
						        </tr>
					        </table>
						</fieldset>
                 	</div>";
	}
	//<--
	
	//Lista eventos por cidade-->
	public function listaEvento($idCidade)
	{
		if ($idCidade<>null)
		{	
			$evento= new EventoController();
			$listaEvento = $evento->selectAllEventoByCidadeMes($idCidade);
			foreach ($listaEvento as $eventoCidade)
			{	
				$data = Functions::formata_data($eventoCidade->getDataEvento());
	      	 	echo "<p><a href=\"#\" title='Clique e saiba mais sobre o evento!'>".$data."<br/>".$eventoCidade->getTituloEvento()."</a></p>" ;
	     	}
		}else{
			$evento= new EventoController();
			$listaEvento = $evento->selectAllEventoByMes();
			foreach ($listaEvento as $eventoCidade)
			{	
				$data = Functions::formata_data($eventoCidade->getDataEvento());
				echo "<p><a href=\"#\" title='Clique e saiba mais sobre o evento!'>".$data."<br/>".$eventoCidade->getTituloEvento()."</a></p>";
			}
		}
	}
	//<--
	
	//Lista fotos dos eventos por cidade em um painel de fotos na página eventos-->
	public function listaFotosDeEventoByCidade($idCidade)
	{
		if ($idCidade<>null){
			$evento= new EventoController();
			$listaEvento = $evento->selectEventoByCidade($idCidade);
			
			$eventoFoto = new FotoEventoController();
			$listaFotoEvento = $eventoFoto->selectFotosEventoByEvento($listaEvento->getIdEvento());
			
			foreach ($listaFotoEvento as $eventoFotoCidade)
			{	
				echo "<p><img src='".self::$path['URL_IMGP'].''.$eventoFotoCidade->getFotoEvento()."'/></p>" ;			
	     	}
		}else{
			$evento= new EventoController();
			$listaEvento = $evento->selectAllEvento();
						
			$eventoFoto = new FotoEventoController();
			$listaFotoEvento = $eventoFoto->selectFotosEventoByEvento($listaEvento->getIdEvento());
			
			foreach ($listaFotoEvento as $eventoFotoCidade)
			{	
				echo "<p><img src='".self::$path['URL_IMGP'].''.$eventoFotoCidade->getFotoEvento()."'/></p>" ;			
	     	}
		}
	}	
	//<--
	
	//galeria de fotos dos eventos que já se realizaram-->
	function listaFotosEventos($idEvento)
	 {
	 	$evento= new EventoController();
		$listaEvento = $evento->selectEventoById($idEvento);
		
	 	$fotoEventosController = new FotoEventoController();	  
		$listaFotoEventos = $fotoEventosController->selectAllFotoEventoByEvento($idEvento);		
		
		echo "<div id=\"texto_pontoTuristico\">".$listaEvento->getTextoEvento()."</div>";
		echo ' <table class="fotos" width="570" cellspacing="2" cellpadding="2"><tr>';
			$i=0;
			foreach ($listaFotoEventos as $fotoEvento)
			{		      	 		   			
				if($i <= 3 ){
						echo '
						<td align="center"><a href="'.self::$path['URL_IMGG'].''.$fotoEvento->getFotoEvento().'"><img src='.self::$path['URL_MINIATURAS'].''.$fotoEvento->getFotoEvento().' title="Clique na imagem para '.utf8_encode("ampliá-la").'!"></a></td>';
				   $i++;				 
				   }else{
					   echo '</tr><tr>
								<td align="center"><a href="'.self::$path['URL_IMGG'].''.$fotoEvento->getFotoEvento().'"><img src='.self::$path['URL_MINIATURAS'].''.$fotoEvento->getFotoEvento().' title="Clique na imagem para '.utf8_encode("ampliá-la").'!"></a>
							</td>';
						$i=1;	
				   }	
		     }
		echo '</table>';	
	 }
	 //<--
	
	//Lista todos os pontos turisticos-->
	public function listaAllPontoTuristico()
	{
		$pontoTuristico = new PontoTuristicoController();
		$listaPontoTuristico = $pontoTuristico->selectPontoTuristico();		
		
		foreach ($listaPontoTuristico as $pontoAllTuristico)
		{	
      	 	echo "<p><a href=\"pontosTuristicos.php?city=".$pontoAllTuristico->getCidadePontoTuristico()."&idPontoTuristico=".$pontoAllTuristico->getIdPontoTuristico()."&titulo=".$pontoAllTuristico->getPontoTuristico()."\"\">".$pontoAllTuristico->getPontoTuristico()."</a></p>" ;
     	}	
	}
	//<--
	
	//Lista pontos turísticos por cidade-->
	public function listaPontoTuristico($idCidade)
	{
		$pontoTuristico = new PontoTuristicoController();
		$listaPontoTuristico = $pontoTuristico->selectFivePontoTuristicoByCidade($idCidade);
		foreach ($listaPontoTuristico as $pontoAllTuristico)
		{	
	     	echo "<p><a href=\"pontosTuristicos.php?city=".$idCidade."&idPontoTuristico=".$pontoAllTuristico->getIdPontoTuristico()."&titulo=".$pontoAllTuristico->getPontoTuristico()."\">".$pontoAllTuristico->getPontoTuristico()."</a></p>" ;
	    }	
	}
	//<--
	
	//Lista fotos do ponto turistico
	public function listaFotosPontosTuristicos($idPontoTuristico)
	{
		$fotoPontoTuristico = new FotoPontoTuristicoController();
		$listaFotosPontoTuristico = $fotoPontoTuristico->selectAllFotoPontoTuristicosByPontoTuristico($idPontoTuristico);	
     	
		$pontoTuristico = new PontoTuristicoController();
		$listaPontoTuristico = $pontoTuristico->selectPontoTuristicoById($idPontoTuristico);
		echo"<div id=\"texto_pontoTuristico\"><p>Saiba um pouco sobre o ponto ".utf8_encode("turístico").".</p>
		".$listaPontoTuristico->getTextoPontoTuristico()."</div>";
		echo ' <table class="fotos" width="570" cellspacing="2" cellpadding="2"><tr>';
		$i=0;
		foreach ($listaFotosPontoTuristico as $fotoAllPontoTuristico)
		{		      	 		   			
			if($i <= 4 ){
				echo '
				<td align="center"><a href="'.self::$path['URL_IMGG'].''.$fotoAllPontoTuristico->getFotoPontoTuristico().'"><img src='.self::$path['URL_MINIATURAS'].''.$fotoAllPontoTuristico->getFotoPontoTuristico().' title="Clique na imagem para '.utf8_encode("ampliá-la").'!"></a></td>';
		   		$i++;				 
			   }else{
			   echo '</tr><tr>
				<td align="center"><a href="'.self::$path['URL_IMGG'].''.$fotoAllPontoTuristico->getFotoPontoTuristico().'"><img src='.self::$path['URL_MINIATURAS'].''.$fotoAllPontoTuristico->getFotoPontoTuristico().' title="Clique na imagem para '.utf8_encode("ampliá-la").'!"></a></td>';
				$i=1;	
			   }	
	     }
		 echo '</table>';
	}		
	//<--
	
	//Lista eventos realizados ou a realizar na cidade-->
    public function listaEventoMeses($idCidade,$mes,$nomeMes)
	{
		if ($idCidade<>null)
		{
			$mesSis = date(m); 
			$evento= new EventoController();
			$listaEvento = $evento->selectEventosARealizarOuRealizadosByCidade($idCidade,$mes);
						
			if ($mes < $mesSis){
				$corMes = "realizado";
			}else{
				$corMes = "nrealizado";   
			}	
			echo'<p><a href="#"><span class='.$corMes.'>'.$nomeMes.'</span></a><br/>';
				foreach ($listaEvento as $eventoRealizarCidade)
				{	
					$listaEventoById = $evento->selectEventoById($eventoRealizarCidade->getIdEvento());					
		      	 	echo '<p id='.listaEventos.'><a href="galeriaDeEventos.php?city='.$idCidade.'&idEvento='.$eventoRealizarCidade->getIdEvento().'&nomeEvento='.$listaEventoById->getTituloEvento().'">'.$eventoRealizarCidade->getTituloEvento().'</a></p>' ;
		     	}
		    '</p>';
		}else{
			$mesSis = date(m); 
			$evento= new EventoController();
			$listaEvento = $evento->selectEventosARealizarOuRealizadosAllCidade($mes);
			if ($mes < $mesSis){
				$corMes = "realizado";
			}else{
				$corMes = "nrealizado";   
			}	
			echo'<p><a href="#"><span class='.$corMes.'>'.$nomeMes.'</span></a><br/>';
				foreach ($listaEvento as $eventoRealizarCidade)
				{	
					$listaEventoById = $evento->selectEventoById($eventoRealizarCidade->getIdEvento());
		      	 	echo '<p id='.listaEventos.'><a href="galeriaDeEventos.php?city='.$listaEventoById->getCidadeEvento().'&idEvento='.$eventoRealizarCidade->getIdEvento().'&nomeEvento='.$listaEventoById->getTituloEvento().'">'.$eventoRealizarCidade->getTituloEvento().'</a></p>' ;
		     	}
		    '</p>';						
		}
	}	
	//<--	 
	
	//Lista Pontos turisticos por cidade,Painel Administrador-->
	public function listaPontosTuristicoByCidade($idPontoTuristico)
	{		   		
			$fotoPontoTuristicoController = new FotoPontoTuristicoController();	  
			$listaFotoPontoTuristico = $fotoPontoTuristicoController->selectAllFotoPontoTuristicosByPontoTuristico($idPontoTuristico);
			echo '<table border="0" cellspacing="2" cellpadding="2">
						<td align="center" width="800" bgcolor="#FFCC99">IMAGEM</td>
						<td align="center"  width="75" bgcolor="#FFCC99"></td>
						';
			$i=0;
			foreach ($listaFotoPontoTuristico as $fotoPontoTuristico)
			{
				if($i % 2 ){
					$bgcolor = "#FFDDBB";
				}else{
					$bgcolor = "#FFE6CC";   
				}	  		
				echo'<tr>
				<td width="300" height="25" bgcolor="'.$bgcolor.'""><img src='.self::$path['URL_MINIATURAS'].''.$fotoPontoTuristico->getFotoPontoTuristico().'></td>
				<td width="75" height="25" bgcolor="'.$bgcolor.'"><a href="doExcluirFotoPontoTuristicoExe.php?id='.$fotoPontoTuristico->getIdFotoPontoTuristico().'" class="excluir">EXCLUIR</a></td>
					</tr>';
				$i++;
			} 
			echo '</table>';
  		
	}
	//<--
	
	//Lista Patrocinadores por cidade,Painel Administrador -->
	public function listaPatrocinadorByCidade($cidade)
	{    		
		$patrocinioController = new PatrocinioController();	  
		$listaPatrocinio = $patrocinioController->selectPatrocinioByCidade($cidade);
		echo '<table border="0" cellspacing="2" cellpadding="2">
					<td align="center" width="200" bgcolor="#FFCC99">'.utf8_encode("PATROCÍNIO").'</td>
					<td align="center"  width="140" bgcolor="#FFCC99">SITE</td>
					<td align="center"  width="70" bgcolor="#FFCC99">IMAGEM</td>
					<td width="68" bgcolor="#FFCC99"></td>
					<td width="68" bgcolor="#FFCC99"></td>
				';
		$i=0;
		foreach ($listaPatrocinio as $patrocinio)
		{
			if($i % 2 ){
					$bgcolor = "#FFDDBB";
			}else{
					$bgcolor = "#FFE6CC";   
			}	
			echo'<tr>
					<td width="270" bgcolor="'.$bgcolor.'">'.$patrocinio->getTituloPatrocinio().'</td>
					<td width="270" bgcolor="'.$bgcolor.'">'.$patrocinio->getSitePatrocinio().'</td>
					<td align="center" width="60" bgcolor="'.$bgcolor.'"><img src='.self::$path['URL_MINIATURAS'].''.$patrocinio->getImgPatrocinio().'></td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="editarPatrocinador.php?id='.$patrocinio->getIdPatrocinio().'" class="editar">EDITAR</a></td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="doExcluirPatrocinioExe.php?id='.$patrocinio->getIdPatrocinio().'" class="excluir">EXCLUIR</a></td>
				</tr>';
			$i++;
		} 
		echo '</table>';
	}
	//<--
	
	//Lista Fotos Galeria por cidade,Painel Administrador-->
	public function listaFotosGaleriaByCidade($cidade)
	{   		
   		$galeriaFotoController = new GaleriaFotoController();	  
	   	$listaGaleriaFoto = $galeriaFotoController->selectAllGaleriaFotoByCidade($cidade);
		echo '<table border="0" cellspacing="2" cellpadding="2">
			  		<td align="center" width="700" bgcolor="#FFCC99">IMAGEM</td>
					<td width="75" bgcolor="#FFCC99"></td>';
		$i=0;
		foreach ($listaGaleriaFoto as $galeriaFoto)
		{
			if($i % 2 ){
	   			$bgcolor = "#FFDDBB";
	   		}else{
				$bgcolor = "#FFE6CC";   
	   		}	  				
			echo'<tr>
					<td width="500" bgcolor="'.$bgcolor.'"><img src='.self::$path['URL_MINIATURAS'].''.$galeriaFoto->getFotoGaleria().'></td>
					<td width="75" bgcolor="'.$bgcolor.'"><a href="doExcluirFotoGaleriaExe.php?id='.$galeriaFoto->getIdGaleria().'" class="excluir">EXCLUIR</a></td>
       		 	</tr>';
			$i++;	
		} 
		echo '</table>';   
	}
	//<--
	
	//Lista foto eventos por evento,Painel Administrador-->	
	public function listaFotoEventosByEvento($idEvento)
	{    		
		$fotoEventoController = new FotoEventoController();	  
		$listaFotoEvento = $fotoEventoController->selectAllFotoEventoByEvento($idEvento);
		
		echo '<table border="0" cellspacing="2" cellpadding="2">
					<td align="center" width="800" bgcolor="#FFCC99">IMAGEM</td>
					<td align="center"  width="75" bgcolor="#FFCC99"></td>
					';
		$i=0;
		foreach ($listaFotoEvento as $fotoEvento)
		{
			if($i % 2 ){
				$bgcolor = "#FFDDBB";
			}else{
				$bgcolor = "#FFE6CC";   
			}	  		
			echo'<tr>
					<td width="300" height="25" bgcolor="'.$bgcolor.'""><img src='.self::$path['URL_MINIATURAS'].''.$fotoEvento->getFotoEvento().' ></td>
					<td width="75" height="25" bgcolor="'.$bgcolor.'"><a href="doExcluirFotoEventoExe.php?id='.$fotoEvento->getIdFotoEvento().'" class="excluir">EXCLUIR</a></td>
				</tr>';
			$i++;
		} 
		echo '</table>';
	}
	//<--
	
	//Lista mapa por cidade, paine adninistrador-->
	public function listaMapaByCidade($cidade)
	{ 
		$mapaController = new MapaController();	  
	   	$listaMapa = $mapaController->selectAllMapaByCidade($cidade);  		
		echo '<table border="0" cellspacing="2" cellpadding="2">
			  		<td align="center" width="500" bgcolor="#FFCC99">'.utf8_encode("ENDEREÇO").'</td>
					<td align="center"  width="90" bgcolor="#FFCC99">'.utf8_encode("ÍCONE").'</td>
					<td align="center"  width="140" bgcolor="#FFCC99">IMAGEM MAPA</td>
					<td width="68" bgcolor="#FFCC99"></td>
					<td width="68" bgcolor="#FFCC99"></td>
				';
		$i=0;
		foreach ($listaMapa as $mapa)
		{
			if($i % 2 ){
	   			$bgcolor = "#FFDDBB";
	   		}else{
				$bgcolor = "#FFE6CC";   
	   		}	  				
			echo'<tr>
					<td width="500" bgcolor="'.$bgcolor.'">'.$mapa->getEnderecoMapa().'</td>
					<td align="center" width="95" bgcolor="'.$bgcolor.'"><img src='.self::$path['URL_MINIATURAS'].''.$mapa->getIconeMapa().'></td>
					<td align="center" width="62" bgcolor="'.$bgcolor.'"><img src='.self::$path['URL_MINIATURAS'].''.$mapa->getImgMapa().'></a></td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="editar_Mapa.php?id='.$mapa->getIdMapa().'" class="editar">EDITAR</a></td>
					<td width="68" bgcolor="'.$bgcolor.'"><a href="doExcluirMapaExe.php?id='.$mapa->getIdMapa().'" class="excluir">EXCLUIR</a></td>
       		 	</tr>';
			$i++;	
		} 
		echo'</table>';	
	}
	//<--
	
	
}
?>
