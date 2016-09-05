<style>
.envio_documentos_container {
  padding-left: 15px;
}

.envio-doc-panel {
  position: relative;
  padding: 15px;
  border-radius: 8px;
  background-color: #f9f9f9;
  margin-bottom: 15px;
}
h3 {
  color: #45871e;
  font-size: 22px;
  margin-top: 20px;
  margin-bottom: 15px;
}
h4 {
  margin-top: 8px;
  margin-bottom: 18px;
}
.filtro-envio-doc {
  position: absolute;
  top: 15px;
  right: 15px;
  width: 150px;
}
.envio-doc-lista {
  border-top: 1px solid #cfcfcf;
  padding: 10px 0;
  height: 379px;
  overflow: hidden;
}
.envio-doc {
  margin: 5px 0;
  padding: 8px 12px;
  border-radius: 5px;
  background-color: #fff;
}
.envio-doc > .envio-doc-label:not(:empty) {
  margin-top: 10px;
}
.envio-doc-header > span {
  display: block;
  float: left;
  /*overflow: hidden;*/
}
.envio-doc-title {
  width: 75%;
  font-size: 16px;
  line-height: 1.2em;
  cursor: pointer;
}
.envio-doc-date {
  width: 25%;
  font-size: 16px;
  color: #999;
}
.envio-doc-header::after {
  content: "";
  display: block;
  width: 100%;
  clear: both;
}

.envio-doc-icones {
  font-size: 16px;
}
.envio-doc-icones > span {
  position: relative;
}
.envio-doc-icones > span:not(:last-of-type) {
  margin-right: 8px;
}
.envio-doc-icones > span:hover > .icon-label {
  display: block;
}
.icon-label::before {
  z-index: 1;
  position: absolute;
  transform-origin: center;
  transform: rotate(45deg);
  border: inherit;
  background-color: inherit;
  content: "";
  width: 10px;
  height: 10px;
  left: 10px;
  top: -6px;
  border-right: none;
  border-bottom: none;
}
.icon-label {
  font-family: "Source sans pro", Helvetica, Arial, sans-serif;
  z-index: 2;
  display: none;
  position: absolute;
  padding: 6px;
  background-color: #fff;
  border: 1px solid #cfcfcf;
  border-radius: 4px;
  width: 150px;
  left: -10px;
  top: 25px;
}
.envio-doc-modal::after {
  content: "";
  display: block;
  width: 100%;
  clear: both;
}

.envio-doc-modal .envio-doc-panel {
  margin-bottom: 0;
}

.envio-doc-modal .envio-doc-lista {
  height: 184px;
}

.envio-doc-modal h3 {
  margin-bottom: 5px;
}
.envio-doc-modal h5 {
  margin-bottom: 5px;
  color: #999;
  font-size: 16px;
}
.envio-doc-modal h6 {
  margin-top: 5px;
  margin-bottom: 10px;
  color: #999;
}
.envio-doc-modal h6:last-of-type {
  margin-bottom: 20px;
}
.envio-doc-modal .envio-doc-modal-body p {
  margin-top: 5px;
  margin-bottom: 15px;
}
.envio-doc-modal .envio-doc-modal-body p:last-child {
  margin-bottom: 0;
}
.envio-doc-modal .envio-doc-modal-body p > .glyphicon {
  margin-right: 5px;
}

.envio-doc-icones > .text-success,
.icon-label > span.text-success {
  color: #4b9c4c;
}

/* Barra de rolagem personalizada */

.mCustomScrollbar:not(.mCS_no_scrollbar) > .mCustomScrollBox > .mCSB_container {
  margin-right: 22px !important;
}
</style>

<h3>Envio de documentos</h3>
<div class="envio-doc-panel">
  <h4>Documentos enviados</h3>
  <input id="filtroEnviosDoc" onkeyup="filtrarPanelList('filtroEnviosDoc')" class="form-control filtro-envio-doc" type="text" name="filtro-envio-doc" placeholder="Pesquisar" />
  <div id="envioDocumentosLista" class="envio-doc-lista">

    <?php for ($i = 0; $i < 10; $i++) { ?>
    <div class="envio-doc">
      <form>
        <input type="hidden" name="doc_envio" value="" />
        <input type="hidden" name="doc_assunto" value="" />
        <input type="hidden" name="doc_descricao" value="" />
        <input type="hidden" name="doc_arquivo" value="" />
        <input type="hidden" name="doe_id" value="" />
        <input type="hidden" name="doe_destinatario" value="" />
        <input type="hidden" name="doe_data_envio" value="" />
        <input type="hidden" name="doe_visto" value="" />
        <input type="hidden" name="doe_retorno" value="" />
      </form>
      <div class="envio-doc-header">
        <span class="envio-doc-title">
          <strong>Assunto do documento <?= $i ?>, <?= pow($i,2) ?> e <?=  pow($i, 3) ?></strong>
        </span>
        <span class="envio-doc-date text-right">00/00/0000</span>
      </div>
      <div class="envio-doc-label">
        <div class="envio-doc-icones">
          <span class="glyphicon glyphicon-align-left">
            <span class="icon-label">Este documento possui descrição</span>
          </span>
          <span class="glyphicon glyphicon-exclamation-sign text-danger">
            <span class="icon-label text-danger">Retorno rejeitado pelo NEC</span>
          </span>
          <span class="glyphicon glyphicon-upload text-success">
            <span class="icon-label text-success">Retorno enviado</span>
          </span>
          <span class="glyphicon glyphicon-upload">
            <span class="icon-label">Retorno não enviado</span>
          </span>
          <span class="glyphicon glyphicon-record">
            <span class="icon-label">Retornos pendentes</span>
          </span>
          <span class="glyphicon glyphicon-ok-circle text-success">
            <span class="icon-label text-success">Sem retornos pendentes</span>
          </span>
        </div>
      </div>
    </div>
    <?php } ?>

  </div>
</div>
<div id="envioDocumentosActions">
  <div class="envio-doc-btns text-right">
    <button type="button" class="btn" onclick="">Finalizar</button>
    <button type="button" class="btn btn-primary" onclick="viewFormNovoEnvioDocumento()">Novo envio</button>
  </div>
</div>
<!-- TESTE -->
<script>
  window.onload = function() {
    document.querySelectorAll(".envio-doc-title").forEach(function(envio) {
      envio.onclick = function() {
          showModalEnvioDoc();
          getInfoEnvioDoc();
      }
    });
  }
</script>
