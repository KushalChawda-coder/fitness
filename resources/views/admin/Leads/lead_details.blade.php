<!-- Media Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mediaModalLabel">Add Media</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row mb-2">
            <div class="col-12">
              <h6>Gallery</h6>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-6">
              <div class="position-relative edit-image my-2">
                <img class="d-block w-100 img-thumbnail" src="{{ asset('assets/admin/plan-img/AirBike.jpg') }}" alt="execise-banner1">
                <div class="imagecheck-uncheck-box d-inline-block">
                  <div class="form-check form-check-flat">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="flatCheck2" id="flatCheck2" checked=""
                        value="option2">
                      <i class="input-helper"></i>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="position-relative edit-image my-2">
                <img class="d-block w-100 img-thumbnail" src="{{ asset('assets/admin/plan-img/BenchPress.jpg') }}" alt="execise-banner1">
                <div class="imagecheck-uncheck-box d-inline-block">
                  <div class="form-check form-check-flat">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="flatCheck2" id="flatCheck2" checked=""
                        value="option2">
                      <i class="input-helper"></i>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="position-relative edit-image my-2">
                <img class="d-block w-100 img-thumbnail" src="{{ asset('assets/admin/plan-img/exercise-image1.jpg') }}" alt="execise-banner1">
                <a href="" class="btn-delete text-danger d-inline-block">
                  <i data-acorn-icon="bin" data-acorn-size="16"></i>
                  <!--<img class="icons26" src="assets/imgs/close.svg" alt="close">-->
                </a>
                <div class="imagecheck-uncheck-box d-inline-block">
                  <div class="form-check form-check-flat">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="flatCheck2" id="flatCheck2" checked=""
                        value="option2">
                      <i class="input-helper"></i>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="position-relative edit-image my-2">
                <img class="d-block w-100 img-thumbnail" src="{{ asset('assets/admin/plan-img/exercise-image2.jpg') }}" alt="execise-banner1">
                <a href="" class="btn-delete text-danger d-inline-block">
                  <i data-acorn-icon="bin" data-acorn-size="16"></i>
                  <!--<img class="icons26" src="assets/imgs/close.svg" alt="close">-->
                </a>
                <div class="imagecheck-uncheck-box d-inline-block">
                  <div class="form-check form-check-flat">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="flatCheck2" id="flatCheck2" checked=""
                        value="option2">
                      <i class="input-helper"></i>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-6">
              <button type="button" class="btn btn-block btn-bold py-4 btn-light btn-sm btn-file">
                <i data-acorn-icon="image" data-acorn-size="32"></i>
                <input type="file">
                <span class="d-block">
                  Upload Images
                </span>
              </button>
            </div>
            <div class="col-6">
              <button type="button" class="btn btn-block btn-bold py-4 btn-light btn-sm btn-file">
                <i data-acorn-icon="video" data-acorn-size="32"></i>
                <input type="file">
                <span class="d-block">
                  Upload Videos
                </span>
              </button>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-12">
              <div class="form-row">
                <div class="col-12">
                  <label>Instruction Video URL</label>
                </div>
              </div>
              <div class="form-group form-row">
                <div class="col-12">
                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Enter your video link i.e. youtube.com">
                  </div>
                </div>
              </div>
              <div class="form-group form-row">
                <div class="col-12">
                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Enter your video link i.e. youtube.com">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>