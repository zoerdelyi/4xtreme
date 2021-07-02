<!-- Szolgáltatások Modal -->
<div class="modal fade" id="servieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Szolgáltatás hozzáadása</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row" style="margin-bottom: 20px;">
                <label for="serviceType" class="col-sm-5 col-form-label">Szolgáltatás típusa</label>
                <div class="col-sm-7">
                    <select class="form-control" name="serviceType" id="serviceType">
                        <option value="" disabled selected>Válasszon szolgáltatás típust</option>
                        <option value="tire">Gumiszervíz szolgáltatás</option>
                        <option value="car">Autószervíz szolgáltatás</option>
                    </select>
                    <br>
                </div>
                <label for="serviceName" class="col-sm-5 col-form-label">Szolgáltatás neve</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="serviceName" id="serviceName"><br>
                </div>
                {{-- <label for="serviceGrossPrice" class="col-sm-5 col-form-label">Bruttó ár</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" name="serviceGrossPrice" id="serviceGrossPrice"><br>
                </div> --}}
                {{-- <label for="serviceNetPrice" class="col-sm-5 col-form-label">Nettó ár</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" name="serviceNetPrice" id="serviceNetPrice"><br>
                </div>    --}}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss='modal' class="btn btn-secondary mr-auto"><span>Mégsem</span></button>
            <button type="button" class="btn btn-primary saveServiceButton"><i class="fas fa-save"></i><span>Mentés</span></button>
        </div>
      </div>
    </div>
</div>