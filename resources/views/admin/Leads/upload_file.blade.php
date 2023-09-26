 <!-- Modal -->
 <div class="modal fade" id="uploadFromFile" tabindex="-1" aria-labelledby="uploadFromFileLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadFromFileLabel">Load</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="ExerciseDetails" value="option1" checked>
            <label class="form-check-label" for="ExerciseDetails">
              Lead Detail
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="ExerciseBenifits" value="option2">
            <label class="form-check-label" for="ExerciseBenifits">
              Create Website
            </label>
          </div>
        </div>
      </div>

      <form id="upload-excel" action="{{ route('leads.import-excel') }}" method="post" enctype="multipart/form-data">
        @csrf
         <input type="file" id="fileInput" value="" name="excel_file" style="display:none;">
         <input type="submit" style="display:none;">
      </form>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="openFileBtn" class="btn btn-dark" data-bs-dismiss="modal">Choose</button>
      </div>
    </div>
  </div>
</div>