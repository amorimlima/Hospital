<?php

$titulos = [
    "reuniao_de_pais"        => "a) Participam das reuniões de pais",
    "procura_professor"      => "b) Procuram pelos professores para se informar sobre o desenvolvimento dos filhos",
    "atividades_extra"       => "c) Propiciam aos alunos que tenham acesso a atividades extracurriculares e de enriquecimento cultural (ida a museus, cinema, etc.) propostas pela escola",
    "reforco_rec"            => "d) Propiciam aos filhos que participem de atividades de reforço ou recuperação propostas pela escola",
    "recursos_basicos"       => "e) Propiciam aos filhos que tenham acesso a recursos básicos necessários ao bom rendimento escolar (óculos, merenda, aparelhos auditivos e/ou ortopédicos, etc.)",
    "atividades_recreativas" => "f) Participam ativamente das atividades recreativas propostas na escola",
    "canais_comunicacao"     => "g) Participam ativamente de canais de comunicação e decisão estabelecidos com a escola (Conselho da Escola, Organização de pais e mestres, etc.)",
    "auxilia_filhos"         => "h) Auxiliam os filhos na realização das lições de casa",
    "acompanha_curriculo"    => "i) Acompanham os conteúdos curriculares trabalhados em sala de aula para poder ajudar os filhos nos estudos"
];

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Crianças como Parceiras | Hospital do Câncer de Barretos</title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/pesquisa.css" rel="stylesheet" />
    </head>
    <body>
        <div class="area_conteudo">
            <div class="logo_container">
                <img src="img/logo/logo_sm.png">
            </div>
            <div class="container_geral">
                <div class="form_container">
                    <form action="" id="pesquisa_escola">
                        <fieldset>
                            <legend>Identidade da Unidade de Ensino</legend>
                            <div class="formfield">
                                <label for="">Tipo de Estabelecimento (assinale quantos for necessário)</label>
                                <span>
                                    <div>
                                        <input type="checkbox" name="tipo_educacao_infantil" id="tipo_educacao_infantil" checked>
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
                                    <textarea id="tipo_outro_especificacao" name="tipo_outro_especificacao" placeholder="Liste aqui os tipos de estabelecimento de sua escola" disabled></textarea>
                                </span>
                            </div>
                            <div class="formfield">
                                <label for="ideb">Ideb</label>
                                <span>
                                    <input id="ideb" name="ideb" type="text" class="obrigatorio" placeholder="Digite o Ideb de sua escola" />
                                </span>
                                <label for="ideb_nao_sabe">Não sabe ou não possui?</label>
                                <span>
                                    <div>
                                        <input type="checkbox" name="ideb_nulo" id="ideb_nao_sabe">
                                        <label for="ideb_nao_sabe">Assinale aqui caso não saiba ou não possua</label>
                                    </div>
                                </span>
                            </div>
                            <div class="formfield">
                                <label for="projetos_anteriores">Cite os projetos mais relevantes que a escola já desenvolveu (em andamento ou concluídos)</label>
                                <span>
                                    <textarea id="projetos_anteriores" name="projetos_anteriores" class="obrigatorio" placeholder="Liste aqui os projetos anteriores de sua escola"></textarea>
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
                                    <textarea id="atividades_familiares" name="atividades_familiares" class="obrigatorio" placeholder="Liste aqui as atividades familiares de sua escola"></textarea>
                                </span>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>No que se refere ao envolvimento das famílias dos alunos matriculados no Ensino Fundamental I com as atividades escolares, assinale a porcentagem de pais que:</legend>

                            <?php foreach($titulos as $id => $titulo) { ?>
                            <div class="formfield">
                                <label for=""><?= $titulo ?></label>
                                <span>
                                    <div>
                                        <input type="radio" name="<?= $id ?>" value="Mais de 75%" checked id="<?= $id ?>_1">
                                        <label for="<?= $id ?>_1">Mais de 75%</label>
                                        <input type="radio" name="<?= $id ?>" value="Entre 50% e 75%" id="<?= $id ?>_2">
                                        <label for="<?= $id ?>_2">Entre 50% e 75%</label>
                                        <input type="radio" name="<?= $id ?>" value="Entre 25% e 75%" id="<?= $id ?>_3">
                                        <label for="<?= $id ?>_3">Entre 25% e 50%</label>
                                        <input type="radio" name="<?= $id ?>" value="Menos de 25%" id="<?= $id ?>_4">
                                        <label for="<?= $id ?>_4">Menos de 25%</label>
                                        <input type="radio" name="<?= $id ?>" value="Não sabe" id="<?= $id ?>_null">
                                        <label for="<?= $id ?>_null">Não sei responder</label>
                                    </div>
                                </span>
                            </div>
                            <?php } ?>

                        </fieldset>
                        <fieldset>
                            <legend>Sobre o projeto</legend>
                            <div class="formfield">
                                <label for="motivos_participacao">O que motivou a escola a participar do Projeto Crianças como Parceiras?</label>
                                <span>
                                    <textarea id="motivos_participacao" name="motivos_participacao" class="obrigatorio" placeholder="Liste aqui os motivos que o levaram a querer participar do projeto"></textarea>
                                </span>
                            </div>
                            <div class="formfield">
                                <label for="">A escola fará uso dos materiais do Projeto “Crianças como Parceiras”</label>
                                <span>
                                    <div>
                                        <input type="checkbox" name="acesso_plataforma" id="acesso_plataforma" checked>
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

                            <?php for($i = 1; $i <= 5; $i++) { ?>
                            <div class="formfield formfield-s">
                                <label for="total_alunos_<?= $i ?>ano">Total de alunos do <?= $i ?>º ano</label>
                                <span>
                                    <input id="total_alunos_<?= $i ?>ano" name="total_alunos_<?= $i ?>ano" min="0" value="0" type="number" />
                                </span>
                                <label for="total_alunos_part_<?= $i ?>ano">Total de alunos participantes do <?= $i ?>º ano</label>
                                <span>
                                    <input id="total_alunos_part_<?= $i ?>ano" name="total_alunos_part_<?= $i ?>ano" min="0" value="0" type="number" />
                                </span>
                                <label for="total_salas_1ano">Total de salas do <?= $i ?>º ano</label>
                                <span>
                                    <input id="total_salas_<?= $i ?>ano" name="total_salas_<?= $i ?>ano" min="0" value="0" type="number" />
                                </span>
                                <label for="total_salas_part_<?= $i ?>ano">Total de salas participantes do <?= $i ?>º ano</label>
                                <span>
                                    <input id="total_salas_part_<?= $i ?>ano" name="total_salas_part_<?= $i ?>ano" min="0" value="0" type="number" />
                                </span>
                            </div>
                            <?php } ?>
                            <div style="visibility: hidden; display: inline-block; width: 30%;"></div>
                        </fieldset>
                        <fieldset>
                            <div class="formbtns">
                                <input type="reset" value="Limpar"/>
                                <input type="button" id="enviar_pesquisa_escola" class="btn_primary" data-form="formulario_pre_cadastro" value="Enviar" />
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/lib/jquery.mask.js"></script>
    <script type="text/javascript" src="js/lib/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="js/modulos/formulario.js"></script>
    <script type="text/javascript" src="js/pesquisa.js"></script>

</html>
