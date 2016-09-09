<h3>Envio de documentos</h3>
<div class="envio-doc-panel">
  <h4>Documentos enviados</h3>
  <input id="filtroEnviosDoc" onkeyup="filtrarPanelList('filtroEnviosDoc')" class="form-control filtro-envio-doc" type="text" name="filtro-envio-doc" placeholder="Pesquisar" />
  <div id="envioDocumentosLista" class="envio-doc-lista">
    <div class="alert alert-warning">Carregando...</div>
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
