<!-- Modal de Delete-->
<div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #d8d3cf;">
      <div class="modal-header">
        <h4 class="modal-title fs-5 colordeco" id="modalLabel">Excluir Item</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja realmente excluir este item?
      </div>
      <div class="modal-footer">
        <a id="confirm" class="btn bg-pink2" href="#">
          <i class="fa-solid fa-trash-can"></i>Sim
        </a>
        <a id="cancel" class="btn bg-pink3" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark"></i>Não
        </a>
      </div>
    </div>
  </div>
</div> <!-- /.modal -->