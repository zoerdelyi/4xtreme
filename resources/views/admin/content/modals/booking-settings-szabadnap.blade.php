<!-- Szabadnap szerekesztése Modal -->
<div class="modal fade" id="bookings_settings_szabadnap" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Dátum szerkesztése</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-12">
                    <p style="margin: 0;">Dátum kiválasztása:</p>
                </div>
                <div class="col-sm-8 col-xl-6">
                    <input id="modal_close_date" class="form-control" data-toggle="datepicker_spec" placeholder="Dátum pl.: 2020-02-02">
                </div>
                <div class="col-sm-12">
                  <div class="form-check">
                      <input id="modal_close_date_yearly" class="form-check-input" type="checkbox" value="">
                      <label class="form-check-label" for="defaultCheck1">
                          Évente ismétlődő szabadnap?
                      </label>
                  </div>
                </div>
            </div>
  
  
        </div>
        <div class="modal-footer">
          <button type="button" id="modal_close_btn_delete" class="btn btn-danger modal_dbn_delete" >Dátum törlése</button>
          <button type="button" id="modal_close_btn_update" class="btn btn-primary">Módosítás</button>
        </div>
      </div>
    </div>
  </div>