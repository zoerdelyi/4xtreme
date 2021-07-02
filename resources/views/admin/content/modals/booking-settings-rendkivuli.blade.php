<!-- Rendkívüli szerkesztése Modal -->
<div class="modal fade" id="bookings_settings_rendkivuli" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  <p style="margin: 0;">Dátum és idő kiválasztása:</p>
              </div>
              <div class="col-sm-8 col-xl-6">
                  <input id="modal_open_date" class="form-control" data-toggle="datepicker_spec" placeholder="Dátum pl.: 2020-02-02">
              </div>
          </div>
          <div class="row" style="margin-bottom: 20px;">
              <div class="input-group col-sm-10 col-xl-8">
                  <select class="form-control" id="modal_open_from">
                      @foreach ($hours_full as $hour)
                          <option value="{{ $hour }}"{{ $tire_open == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                      @endforeach
                  </select>
                  <div class="input-group-prepend">
                      <div class="input-group-text">-</div>
                  </div>
                  <select class="form-control" id="modal_open_to">
                      @foreach ($hours_full as $hour)
                          <option value="{{ $hour }}"{{ $tire_close == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                      @endforeach
                  </select>
              </div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" id="modal_open_btn_delete" class="btn btn-danger modal_dbn_delete" >Dátum törlése</button>
        <button type="button" id="modal_open_btn_update" class="btn btn-primary">Módosítás</button>
      </div>
    </div>
  </div>
</div>