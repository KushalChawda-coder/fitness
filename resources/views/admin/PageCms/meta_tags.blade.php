<div class="row">
  <div class="col-12 col-lg-6">
    <div class="mb-3">
      <label class="form-label">Page Title</label>
      <input type="text" name="meta_title" value="{{ $page->meta_title }}" class="form-control" placeholder="Fitness Plan App">
      @error('meta_title')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Friendly URL</label>
      <input type="text" name="meta_friendly_url" value="{{ $page->meta_friendly_url }}" class="form-control" placeholder="fitnessandmealplans.com">
      @error('meta_friendly_url')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Meta Description</label>
      <textarea type="text" class="form-control" name="meta_description" 
        placeholder="">{{ $page->meta_description }}</textarea>
      @error('meta_description')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Tags</label>
      <input name="tagsBasic" value="{{ $page->meta_tags }}" />
      @error('tagsBasic')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="col-12 col-lg-6">
    <div class="mb-3">
      <div class="card no-shadow bg-light">
        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
          <a href="#" class="text-success">
            <h4 class="text-success">Fitness Plan App</h4>
          </a>
          <a href="#" class="text-blue">
            <h6 class="text-blue">{{ url('/') }}</h6>
          </a>
          <p>This is a place where user can go and get their website to host their fitness and meal
            plans.</p>
        </div>
      </div>
    </div>
  </div>
</div>