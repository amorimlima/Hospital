<html>
	<head>
		<meta charset="utf-8">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
		<title>Crianças como Parceiras | Hospital do Câncer de Barretos</title>

		<!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" /> -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/style.css" rel="stylesheet" />
		<link href="css/pesquisa.css" rel="stylesheet" />
	</head>
	<body>
		<div class="area_conteudo">
			<div class="logo_container">
				<img src="img/logo/logo_sm.png">
			</div>
			<div class="form_container">
				<form action="" id="pesquisa_escola">
					<fieldset>
						<legend>Identidade da Unidade de Ensino</legend>
						<div class="formfield">
	            			<label for="">Tipo de Estabelecimento (assinale quantos for necessário)</label>
	            			<span>
	            				<div>
	            					<input type="checkbox" name="tipo_educacao_infantil" id="tipo_educacao_infantil">
	            					<label for="tipo_educacao_infantil">Educação Infantil</label>
	            					<input type="checkbox" name="tipo_ensino_fund_1" id="tipo_ensino_fund_1">
	            					<label for="tipo_ensino_fund_1">Ensino Fundamental I (1º a 5º)</label>
	            					<input type="checkbox" name="tipo_ensino_fund_2" id="tipo_ensino_fund_2">
	            					<label for="tipo_ensino_fund_2">Ensino Fundamental II (6ª a 9ª)</label>
	            					<input type="checkbox" name="tipo_ensino_medio" id="tipo_ensino_medio">
	            					<label for="tipo_ensino_medio">Ensino Médio</label>
	            					<input type="checkbox" name="tipo_tecnico_profissional" id="tipo_tecnico_profissional">
	            					<label for="tipo_tecnico_profissional">Ensino Técnico Profissional</label>
	            					<input type="checkbox" name="tipo_formacao_professores" id="tipo_formacao_professores">
	            					<label for="tipo_formacao_professores">Formação dos professores</label>
	            					<input type="checkbox" name="tipo_outro" id="tipo_outro">
	            					<label for="tipo_outro">Outro(s)</label>
	            				</div>
	            			</span>
	            			<label for="tipo_outro_especificacao">Qual(is)?</label>
							<span>
								<textarea id="tipo_outro_especificacao" name="esc_razao_social" placeholder="Liste aqui os tipos de estabelecimento de sua escola"></textarea>
							</span>
	        			</div>
						<div class="formfield">
							<label for="ideb">Ideb</label>
							<span>
								<input id="ideb" name="ideb" type="text" placeholder="Digite o Ideb de sua escola" />
							</span>
							<label for="ideb_nao_sabe">Não sabe?</label>
	            			<span>
	            				<div>
	            					<input type="checkbox" name="ideb_nulo" id="ideb_nao_sabe">
	            					<label for="ideb_nao_sabe">Assinale aqui caso não saiba</label>
	            				</div>
	            			</span>
						</div>
						<div class="formfield">
							<label for="projetos_anteriores">Cite os projetos mais relevantes que a escola já desenvolveu (em andamento ou concluídos)</label>
							<span>
								<textarea id="projetos_anteriores" name="projetos_anteriores" placeholder="Liste aqui os projetos anteriores de sua escola"></textarea>
							</span>
							<label for="projetos_anteriores_null">Primeiro projeto?</label>
	            			<span>
	            				<div>
	            					<input type="checkbox" name="projetos_anteriores_null" id="projetos_anteriores_null">
	            					<label for="projetos_anteriores_null">Assinale aqui caso sua escola não tenha participado de nenhum outro projeto</label>
	            				</div>
	            			</span>
						</div>
						<div class="formfield">
							<label for="">A escola possui sala de informática?</label>
							<span>
								<div>
									<input type="radio" name="sala_info" value="1" checked id="sala_info_sim">
									<label for="sala_info_sim">Sim</label>
									<input type="radio" name="sala_info" value="2" id="sala_info_nao">
									<label for="sala_info_nao">Não</label>
								</div>
							</span>
							<label for="">Em caso positivo, possui acesso à internet?</label>
							<span>
								<div>
									<input type="radio" name="acesso_internet" value="1" checked id="acesso_internet_sim">
									<label for="acesso_internet_sim">Sim</label>
									<input type="radio" name="acesso_internet" value="2" id="acesso_internet_nao">
									<label for="acesso_internet_nao">Não</label>
								</div>
							</span>
						</div>
					</fieldset>
					<fieldset>
						<legend>Sobre a comunidade escolar</legend>
						<div class="formfield">
							<label for="">A escola propõe atividades para propiciar maior envolvimento das famílias nas atividades escolares?</label>
							<span>
								<div>
									<input type="radio" name="atividades_familia" value="1" checked id="atividades_familia_sim">
									<label for="atividades_familia_sim">Sim</label>
									<input type="radio" name="atividades_familia" value="2" id="atividades_familia_nao">
									<label for="atividades_familia_nao">Não</label>
								</div>
							</span>
							<label for="atividades_familiares">Se sim, quais?</label>
							<span>
								<textarea id="atividades_familiares" name="atividades_familiares" placeholder="Liste aqui as atividades familiares de sua escola"></textarea>
							</span>
						</div>
					</fieldset>
					<fieldset>
						<legend>No que se refere ao envolvimento das famílias dos alunos matriculados no Ensino Fundamental I com as atividades escolares, assinale a porcentagem de pais que:</legend>
						<div class="formfield">
							<label for="">a) Participam das reuniões de pais</label>
							<span>
								<div>
									<input type="radio" name="reuniao_de_pais" value="1" checked id="reuniao_de_pais_1">
									<label for="reuniao_de_pais_1">Mais de 75%</label>
									<input type="radio" name="reuniao_de_pais" value="2" id="reuniao_de_pais_2">
									<label for="reuniao_de_pais_2">Entre 50% e 75%</label>
									<input type="radio" name="reuniao_de_pais" value="3" id="reuniao_de_pais_3">
									<label for="reuniao_de_pais_3">Entre 25% e 50%</label>
									<input type="radio" name="reuniao_de_pais" value="4" id="reuniao_de_pais_4">
									<label for="reuniao_de_pais_4">Menos de 25%</label>
									<input type="radio" name="reuniao_de_pais" value="5" id="reuniao_de_pais_null">
									<label for="reuniao_de_pais_null">Não sei responder</label>
								</div>
							</span>
						</div>
						<div class="formfield">
							<label for="">b) Procuram pelos professores para se informar sobre o desenvolvimento dos filhos</label>
							<span>
								<div>
									<input type="radio" name="procura_professor" value="1" checked id="procura_professor_1">
									<label for="procura_professor_1">Mais de 75%</label>
									<input type="radio" name="procura_professor" value="2" id="procura_professor_2">
									<label for="procura_professor_2">Entre 50% e 75%</label>
									<input type="radio" name="procura_professor" value="3" id="procura_professor_3">
									<label for="procura_professor_3">Entre 25% e 50%</label>
									<input type="radio" name="procura_professor" value="4" id="procura_professor_4">
									<label for="procura_professor_4">Menos de 25%</label>
									<input type="radio" name="procura_professor" value="5" id="procura_professor_null">
									<label for="procura_professor_null">Não sei responder</label>
								</div>
							</span>
						</div>
						<div class="formfield">
							<label for="">c) Propiciam aos alunos que tenham acesso a atividades extracurriculares e de enriquecimento cultural (ida a museus, cinema, etc.) propostas pela escola</label>
							<span>
								<div>
									<input type="radio" name="atividades_extra" value="1" checked id="atividades_extra_1">
									<label for="atividades_extra_1">Mais de 75%</label>
									<input type="radio" name="atividades_extra" value="2" id="atividades_extra_2">
									<label for="atividades_extra_2">Entre 50% e 75%</label>
									<input type="radio" name="atividades_extra" value="3" id="atividades_extra_3">
									<label for="atividades_extra_3">Entre 25% e 50%</label>
									<input type="radio" name="atividades_extra" value="4" id="atividades_extra_4">
									<label for="atividades_extra_4">Menos de 25%</label>
									<input type="radio" name="atividades_extra" value="5" id="atividades_extra_null">
									<label for="atividades_extra_null">Não sei responder</label>
								</div>
							</span>
						</div>
						<div class="formfield">
							<label for="">d) Propiciam aos filhos que participem de atividades de reforço ou recuperação propostas pela escola</label>
							<span>
								<div>
									<input type="radio" name="reforço_rec" value="1" checked id="reforço_rec_1">
									<label for="reforço_rec_1">Mais de 75%</label>
									<input type="radio" name="reforço_rec" value="2" id="reforço_rec_2">
									<label for="reforço_rec_2">Entre 50% e 75%</label>
									<input type="radio" name="reforço_rec" value="3" id="reforço_rec_3">
									<label for="reforço_rec_3">Entre 25% e 50%</label>
									<input type="radio" name="reforço_rec" value="4" id="reforço_rec_4">
									<label for="reforço_rec_4">Menos de 25%</label>
									<input type="radio" name="reforço_rec" value="5" id="reforço_rec_null">
									<label for="reforço_rec_null">Não sei responder</label>
								</div>
							</span>
						</div>
						<div class="formfield">
							<label for="">e) Propiciam aos filhos que tenham acesso a recursos básicos necessários ao bom rendimento escolar (óculos, merenda, aparelhos auditivos e/ou ortopédicos, etc.)</label>
							<span>
								<div>
									<input type="radio" name="recursos_basicos" value="1" checked id="recursos_basicos_1">
									<label for="recursos_basicos_1">Mais de 75%</label>
									<input type="radio" name="recursos_basicos" value="2" id="recursos_basicos_2">
									<label for="recursos_basicos_2">Entre 50% e 75%</label>
									<input type="radio" name="recursos_basicos" value="3" id="recursos_basicos_3">
									<label for="recursos_basicos_3">Entre 25% e 50%</label>
									<input type="radio" name="recursos_basicos" value="4" id="recursos_basicos_4">
									<label for="recursos_basicos_4">Menos de 25%</label>
									<input type="radio" name="recursos_basicos" value="5" id="recursos_basicos_null">
									<label for="recursos_basicos_null">Não sei responder</label>
								</div>
							</span>
						</div>
						<div class="formfield">
							<label for="">f) Participam ativamente das atividades recreativas propostas na escola</label>
							<span>
								<div>
									<input type="radio" name="atividades_recreativas" value="1" checked id="atividades_recreativas_1">
									<label for="atividades_recreativas_1">Mais de 75%</label>
									<input type="radio" name="atividades_recreativas" value="2" id="atividades_recreativas_2">
									<label for="atividades_recreativas_2">Entre 50% e 75%</label>
									<input type="radio" name="atividades_recreativas" value="3" id="atividades_recreativas_3">
									<label for="atividades_recreativas_3">Entre 25% e 50%</label>
									<input type="radio" name="atividades_recreativas" value="4" id="atividades_recreativas_4">
									<label for="atividades_recreativas_4">Menos de 25%</label>
									<input type="radio" name="atividades_recreativas" value="5" id="atividades_recreativas_null">
									<label for="atividades_recreativas_null">Não sei responder</label>
								</div>
							</span>
						</div>
						<div class="formfield">
							<label for="">g) Participam ativamente de canais de comunicação e decisão estabelecidos com a escola (Conselho da Escola, Organização de pais e mestres, etc.)</label>
							<span>
								<div>
									<input type="radio" name="canais_comunicacao" value="1" checked id="canais_comunicacao_1">
									<label for="canais_comunicacao_1">Mais de 75%</label>
									<input type="radio" name="canais_comunicacao" value="2" id="canais_comunicacao_2">
									<label for="canais_comunicacao_2">Entre 50% e 75%</label>
									<input type="radio" name="canais_comunicacao" value="3" id="canais_comunicacao_3">
									<label for="canais_comunicacao_3">Entre 25% e 50%</label>
									<input type="radio" name="canais_comunicacao" value="4" id="canais_comunicacao_4">
									<label for="canais_comunicacao_4">Menos de 25%</label>
									<input type="radio" name="canais_comunicacao" value="5" id="canais_comunicacao_null">
									<label for="canais_comunicacao_null">Não sei responder</label>
								</div>
							</span>
						</div>
						<div class="formfield">
							<label for="">h) Auxiliam os filhos na realização das lições de casa</label>
							<span>
								<div>
									<input type="radio" name="auxilia_filhos" value="1" checked id="auxilia_filhos_1">
									<label for="auxilia_filhos_1">Mais de 75%</label>
									<input type="radio" name="auxilia_filhos" value="2" id="auxilia_filhos_2">
									<label for="auxilia_filhos_2">Entre 50% e 75%</label>
									<input type="radio" name="auxilia_filhos" value="3" id="auxilia_filhos_3">
									<label for="auxilia_filhos_3">Entre 25% e 50%</label>
									<input type="radio" name="auxilia_filhos" value="4" id="auxilia_filhos_4">
									<label for="auxilia_filhos_4">Menos de 25%</label>
									<input type="radio" name="auxilia_filhos" value="5" id="auxilia_filhos_null">
									<label for="auxilia_filhos_null">Não sei responder</label>
								</div>
							</span>
						</div>
						<div class="formfield">
							<label for="">i) Acompanham os conteúdos curriculares trabalhados em sala de aula para poder ajudar os filhos nos estudos</label>
							<span>
								<div>
									<input type="radio" name="acompanha_curriculo" value="1" checked id="acompanha_curriculo_1">
									<label for="acompanha_curriculo_1">Mais de 75%</label>
									<input type="radio" name="acompanha_curriculo" value="2" id="acompanha_curriculo_2">
									<label for="acompanha_curriculo_2">Entre 50% e 75%</label>
									<input type="radio" name="acompanha_curriculo" value="3" id="acompanha_curriculo_3">
									<label for="acompanha_curriculo_3">Entre 25% e 50%</label>
									<input type="radio" name="acompanha_curriculo" value="4" id="acompanha_curriculo_4">
									<label for="acompanha_curriculo_4">Menos de 25%</label>
									<input type="radio" name="acompanha_curriculo" value="5" id="acompanha_curriculo_null">
									<label for="acompanha_curriculo_null">Não sei responder</label>
								</div>
							</span>
						</div>
					</fieldset>
					<fieldset>
						<legend>Sobre o projeto</legend>
						<div class="formfield">
	            			<label for="motivos_participacao">O que motivou a escola a participar do Projeto Crianças como Parceiras?</label>
							<span>
								<textarea id="motivos_participacao" name="motivos_participacao" placeholder="Liste aqui os motivos que o levaram a querer participar do projeto"></textarea>
							</span>
	        			</div>
	        			<div class="formfield">
	            			<label for="">A escola fará uso dos materiais do Projeto “Crianças como Parceiras”</label>
	            			<span>
	            				<div>
	            					<input type="checkbox" name="acesso_plataforma" id="acesso_plataforma">
	            					<label for="acesso_plataforma">Em nossa plataforma digital, com acesso <i>on line</i></label>
	            					<input type="checkbox" name="download_offline" id="download_offline">
	            					<label for="download_offline">Com <i>download</i> dos materiais e acesso <i>off line</i></label>
	            					<input type="checkbox" name="download_impressao" id="download_impressao">
	            					<label for="download_impressao">Com <i>download</i> dos materiais em PDF e impressão das apostilas</label>
	            				</div>
	            			</span>
	        			</div>
	        		</fieldset>
	        		<fieldset>
	            		<legend for="">Preencha as informações abaixo:</legend>
	        			<div class="formfield formfield-s">
	        				<label for="total_alunos_1ano">Total de alunos do 1º ano</label>
	            			<span>
								<input id="total_alunos_1ano" name="total_alunos_1ano" min="0" type="number" />
							</span>
							<label for="total_alunos_part_1ano">Total de alunos participantes do 1º ano</label>
	            			<span>
								<input id="total_alunos_part_1ano" name="total_alunos_part_1ano" min="0" type="number" />
							</span>
							<label for="total_salas_1ano">Total de salas do 1º ano</label>
	            			<span>
								<input id="total_salas_1ano" name="total_salas_1ano" min="0" type="number" />
							</span>
							<label for="total_salas_part_1ano">Total de salas participantes do 1º ano</label>
	            			<span>
								<input id="total_salas_part_1ano" name="total_salas_part_1ano" min="0" type="number" />
							</span>
	        			</div>
	        			<div class="formfield formfield-s">
	        				<label for="total_alunos_2ano">Total de alunos do 2º ano</label>
	            			<span>
								<input id="total_alunos_2ano" name="total_alunos_2ano" min="0" type="number" />
							</span>
							<label for="total_alunos_part_2ano">Total de alunos participantes do 2º ano</label>
	            			<span>
								<input id="total_alunos_part_2ano" name="total_alunos_part_2ano" min="0" type="number" />
							</span>
							<label for="total_salas_2ano">Total de salas do 2º ano</label>
	            			<span>
								<input id="total_salas_2ano" name="total_salas_2ano" min="0" type="number" />
							</span>
							<label for="total_salas_part_2ano">Total de salas participantes do 2º ano</label>
	            			<span>
								<input id="total_salas_part_2ano" name="total_salas_part_2ano" min="0" type="number" />
							</span>
	        			</div>
	        			<div class="formfield formfield-s">
	        				<label for="total_alunos_3ano">Total de alunos do 3º ano</label>
	            			<span>
								<input id="total_alunos_3ano" name="total_alunos_3ano" min="0" type="number" />
							</span>
							<label for="total_alunos_part_3ano">Total de alunos participantes do 3º ano</label>
	            			<span>
								<input id="total_alunos_part_3ano" name="total_alunos_part_3ano" min="0" type="number" />
							</span>
							<label for="total_salas_3ano">Total de salas do 3º ano</label>
	            			<span>
								<input id="total_salas_3ano" name="total_salas_3ano" min="0" type="number" />
							</span>
							<label for="total_salas_part_3ano">Total de salas participantes do 3º ano</label>
	            			<span>
								<input id="total_salas_part_3ano" name="total_salas_part_3ano" min="0" type="number" />
							</span>
	        			</div>
	        			<div class="formfield formfield-s">
	        				<label for="total_alunos_4ano">Total de alunos do 4º ano</label>
	            			<span>
								<input id="total_alunos_4ano" name="total_alunos_4ano" min="0" type="number" />
							</span>
							<label for="total_alunos_part_4ano">Total de alunos participantes do 4º ano</label>
	            			<span>
								<input id="total_alunos_part_4ano" name="total_alunos_part_4ano" min="0" type="number" />
							</span>
							<label for="total_salas_4ano">Total de salas do 4º ano</label>
	            			<span>
								<input id="total_salas_4ano" name="total_salas_4ano" min="0" type="number" />
							</span>
							<label for="total_salas_part_4ano">Total de salas participantes do 4º ano</label>
	            			<span>
								<input id="total_salas_part_4ano" name="total_salas_part_4ano" min="0" type="number" />
							</span>
	        			</div>
	        			<div class="formfield formfield-s">
	        				<label for="total_alunos_5ano">Total de alunos do 5º ano</label>
	            			<span>
								<input id="total_alunos_5ano" name="total_alunos_5ano" min="0" type="number" />
							</span>
							<label for="total_alunos_part_5ano">Total de alunos participantes do 5º ano</label>
	            			<span>
								<input id="total_alunos_part_5ano" name="total_alunos_part_5ano" min="0" type="number" />
							</span>
							<label for="total_salas_5ano">Total de salas do 5º ano</label>
	            			<span>
								<input id="total_salas_5ano" name="total_salas_5ano" min="0" type="number" />
							</span>
							<label for="total_salas_part_5ano">Total de salas participantes do 5º ano</label>
	            			<span>
								<input id="total_salas_part_5ano" name="total_salas_part_5ano" min="0" type="number" />
							</span>
	        			</div>
						<div style="visibility: hidden; display: inline-block; width: 30%;"></div>
					</fieldset>
					<fieldset>
						<div class="formbtns">
							<input type="reset" value="Limpar"/>
							<input type="button" id="enviar_pre_cadastro" class="btn_primary" data-form="formulario_pre_cadastro" value="Enviar" />
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script type="text/javascript" src="js/lib/jquery.mask.js"></script>
	<script type="text/javascript" src="js/lib/jquery.maskedinput.js"></script>
	<script type="text/javascript" src="js/modulos/formulario.js"></script>
	<script type="text/javascript" src="js/pesquisa.js"></script>

</html>