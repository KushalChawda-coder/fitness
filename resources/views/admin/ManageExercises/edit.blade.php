@extends('layouts.admin.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/tagify.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.min.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/plyr.css?time='.time()) }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/quill.bubble.css?time='.time()) }}" />
<style>
    .error{
      color: #dc3545!important;
      display: block !important;
    }

    br{
      clear:both
    }

    input.error{
      border:1px solid red
    }

    .invisible{
      height:0;
    }
</style>
@endsection
@section('content')
<div class="container">
  <!-- Title and Top Buttons Start -->
  <form action="{{ route('manageExercises.update') }}" id="manage-exercises" method="post">
  @csrf
  <input type="hidden" name="id" id="exercise_id" value="{{ $exercise->id }}">
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
        <div class="w-auto sw-md-30">
          <a href="{{ route('manageExercises.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Exercise List</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">Manage Exercises</h1>
        </div>
      </div>
      <div class="col-sm-12 col-md-5 col-lg-7 col-xxl-9 d-flex justify-content-end align-items-start mt-1">
        <div class="d-flex">
          <label class="form-check-label" for="updateStatus">Draft</label>
          <div class="form-check form-switch ms-2 mb-0">
            <input class="form-check-input checkbox-status" id="updateStatus" type="checkbox" role="switch" value="{{ $exercise->status }}" @checked($exercise->status)>
          </div>
          <label class="form-check-label" for="updateStatus">Published</label>
        </div>
      </div>
      <div class="col-sm-12 col-md-2 col-lg-2 col-xxl-1 text-end mb-1">
        <!-- Preview Button Start -->
        <a href="#" role="button"
          class="btn btn-sm btn-icon btn-dark">
          <i data-acorn-icon="eye" data-acorn-size="13"></i>
          Preview
        </a>
        <!-- Preview Button End -->
      </div>
    </div>
  </div>
  <!-- Title and Top Buttons End -->
  <div class="card mb-3">
    <div class="card-header border-0 pb-0">
      <ul class="nav nav-tabs nav-tabs-line card-header-tabs responsive-tabs border-bottom" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#first" role="tab" type="button"
            aria-selected="true">
            Content
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#second" role="tab" type="button"
            aria-selected="false">Meta/SEO</button>
        </li>
      </ul>
    </div>
    <div class="card-body py-2 px-2 py-lg-3 px-lg-3">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="first" role="tabpanel">
          <div class="pagesection mb-4">
            <h2 class="small-title fw-bold">Fitness DB Details</h2>
            <div class="card no-shadow border mb-4">
              <div class="card-body py-2 px-2 py-lg-3 px-lg-3">
                <div class="row">
                   <div class="col-12 col-sm-6">
                    <div class="mb-3">
                      <label class="form-label" for="exercise_name">Exercise ID</label>
                      <input type="text" class="form-control" name="exercise_id"
                       value="{{ $exercise->exercise_id }}" readonly="">
                      @error('exercise_name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="mb-3">
                      <label class="form-label" for="exercise_name">Exercise Name</label>
                      <input type="text" class="form-control" name="exercise_name" id="exercise_name" placeholder=""
                       value="{{ old('exercise_name') ?? $exercise->exercise_name }}" required>
                      @error('exercise_name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="mb-3">
                      <label class="d-block form-label" for="tagsBodyPart">Body Part</label>
                      <input id="tagsBodyPart" class="custom-look" name="body_part_ids" placeholder="Search for body part"
                        value="{{ old('body_part_ids') ?? $exercise->body_part_ids }}" data-blacklist="null@null.com" required>
                      <button class="btn btn-icon btn-icon-only btn-outline-primary mb-1" type="button">
                        <i data-acorn-icon="plus"></i>
                      </button>
                      @error('body_part_ids')
                        <span class="text-danger d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-xl-12">
                    <div class="mb-3">
                      <label class="d-block form-label" for="tagsEquipment">Equipments</label>
                      <input id="tagsEquipment" class="custom-look" name="equipments_ids" placeholder="Search for body part" value="{{ old('equipments_ids') ?? $exercise->equipments_ids }}" data-blacklist="null@null.com" required>
                      <button class="btn btn-icon btn-icon-only btn-outline-primary mb-1" type="button">
                        <i data-acorn-icon="plus"></i>
                      </button>
                      @error('equipments_ids')
                        <span class="text-danger d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-xl-12">
                    <div class="mb-3">
                      <label class="d-block form-label" for="tagsExerciseType">Exercise Type</label>
                      <input id="tagsExerciseType" class="custom-look" name="exercise_type_ids" placeholder="Search for body part" value="{{ old('exercise_type_ids') ?? $exercise->exercise_type_ids }}" data-blacklist="null@null.com" required>
                      <button class="btn btn-icon btn-icon-only btn-outline-primary mb-1" type="button">
                        <i data-acorn-icon="plus"></i>
                      </button>
                      @error('exercise_type_ids')
                        <span class="text-danger d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-xl-12">
                    <div class="mb-3" id="highlightMediaContainer">
                      <label class="form-label d-block">Media (Max 3)</label>
                      <div class="dropzone dropzone-columns row g-2 row-cols-1 row-cols-md-3 border-0 p-0 position-relative" id="highlightMedia"></div>
                      @if(!empty(old('highlight_images')))
                      @php $highlight_img = old('highlight_images') @endphp
                      @endif
                      @isset($highlight_img)
                      @foreach($highlight_img as $image)
                        <input type="hidden" name="highlight_images[]" value="{{ $image }}">
                      @endforeach
                      @endisset
                      @error('highlight_images')
                        <span class="text-danger d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="pagesection mb-4">
            <div class="mb-1">
              <h2 class="small-title fw-bold">Benefits</h2>
              <div class="html-editor-bubble sh-19 html-editor" id="BenefitsEditor">{{ old('benefits') ?? $exercise->benefits }}</div>
            </div>
            <input type="text" id="benefits" class="invisible p-0" name="benefits"  value="{{ old('benefits') ?? $exercise->benefits }}" required>
            @error('benefits')
              <span class="text-danger d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            <h2 class="small-title fw-bold">Directions</h2>
            <div class="card no-shadow border mb-4">
              <div class="card-body py-2 px-2 py-lg-3 px-lg-3">
              <div id="directions-container">
                @if(!empty(old('directions')))
                  @php $directions = old('directions'); @endphp
                @endif
                @foreach($directions as $i => $direction)
                <div class="row mb-2 direction-row" index="{{ $i }}">
                  <div class="col-auto">
                    <div class="d-inline-block d-flex">
                      <div class="bg-gradient-light sw-6 sh-6 rounded-md">
                        <div class="text-white d-flex justify-content-center align-items-center h-100 text-small text-center lh-1 step-index">
                            {{ $i + 1 }}
                          <br>
                          Steps
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card-body d-flex flex-column ps-0 pe-0 pt-0 pb-0 h-100 justify-content-start">
                      <div class="d-flex flex-column">
                        <div class="mt-1 mb-1">
                          <div class="html-editor-bubble sh-19 html-editor direction-description-editor" id="direction-description-{{ $i }}">{{ $direction }}</div>
                        </div>
                        <input type="text" class="direction_description invisible p-0" name="directions[{{ $i }}]"  value="{{ $direction }}" required>
                        @error('directions.'.$i)
                          <span class="text-danger d-block direction-description-err" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-auto d-flex flex-column" id="direction-btn-container">
                    <button type="button" id="create-direction" class="btn btn-sm btn-icon btn-icon-only btn-outline-primary mb-1 direction-create-btn">
                      <i class="direction-action-icon" data-acorn-icon="plus"></i>
                    </button>
                    <button type="button" id="create-direction" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger mb-1 direction-delete-btn">
                      <i data-acorn-icon="bin"></i>
                    </button>
                  </div>
                </div>
                @endforeach
              </div>
              </div>
            </div>
            <h2 class="small-title fw-bold">Directions Video (Max 3)</h2>
            <div class="card no-shadow border mb-4">
              <div class="card-body py-2 px-2 py-lg-3 px-lg-3">
                <div class="mb-1" id="directionVideosContainer">
                  <!-- <label class="form-label">Images/Video Slider</label> -->
                  <div class="dropzone dropzone-columns min-h-100 row g-2 row-cols-1 row-cols-md-2 row-cols-xl-4 border-0 p-0 position-relative" id="directionVideos"></div>
                  <button type="button" class="btn btn-outline-dark btn-icon btn-icon-start mt-2"
                    id="dropzoneProductVideoButton">
                    <i data-acorn-icon="plus"></i>
                    <span>Add Files</span>
                  </button>
                </div>
                @if(!empty(old('direction_videos')))
                @php $direction_videos = old('direction_videos'); @endphp
                @endif
                @isset($direction_videos)
                @foreach($direction_videos as $video)
                  <input type="hidden" name="direction_videos[]" value="{{ $video }}">
                @endforeach
                @endisset

                @error('direction_videos')
                  <span class="text-danger d-block" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <!-- <div class="row mb-4">
                  <div class="col-12 col-lg-4 my-2">
                    <video class="player border">
                      <source src="video/07081201-Side-Crunch_Waist.mp4" type="video/mp4">
                    </video>
                  </div>
                  <div class="col-12 col-lg-4 my-2">
                    <video class="player border">
                      <source src="video/07081201-Side-Crunch_Waist.mp4" type="video/mp4">
                    </video>
                  </div>
                  <div class="col-12 col-lg-4 my-2">
                    <video class="player border">
                      <source src="video/07081201-Side-Crunch_Waist.mp4" type="video/mp4">
                    </video>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="mb-3 mt-1">
                      <label class="form-label" for="">Link</label>
                      <input type="url" class="form-control" id="video_link" name="video_link" placeholder="" value="{{ old('video_link') ?? $exercise->video_link }}" required>
                      @error('video_link')
                        <span class="text-danger d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row align-items-center">
              <div class="col-12 col-lg-12">
                <button type="submit" class="btn btn-primary">
                  Save content
                </button>
                <button type="reset" class="btn btn-secondary">
                  Cancel
                </button>
              </div>
            </div>
          </div>

        </div>
         <div class="tab-pane fade" id="second" role="tabpanel">
           <div class="row">
            <div class="col-12 col-lg-6">
              <div class="mb-3">
                <label class="form-label">Page Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title') ?? $exercise->meta_title  }}" class="form-control meta-input" placeholder="Fitness Plan App">
                @error('meta_title')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Friendly URL</label>
                <input type="text" name="meta_friendly_url" value="{{ old('meta_friendly_url') ?? $exercise->meta_friendly_url }}" class="form-control meta-input" placeholder="fitnessandmealplans.com">
                @error('meta_friendly_url')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea type="text" class="form-control meta-input" name="meta_description" 
                  placeholder="">{{ old('meta_description') ?? $exercise->meta_description }}</textarea>
                @error('meta_description')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Tags</label>
                <input name="tagsBasic" value="{{ old('tagsBasic') ?? $exercise->meta_tags }}" />
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
                      <h4 class="text-success" id="pageTitle">Fitness Plan App</h4>
                    </a>
                    <a href="#" class="text-blue" id="pageUrl">
                      <h6 class="text-blue">{{ url('/') }}</h6>
                    </a>
                    <p id="pageDesc">This is a place where user can go and get their website to host their fitness and meal
                      plans.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>

@endsection
@section('script')
<!-- Vendor Scripts Start -->
  <script src="{{ asset('assets/admin/js/vendor/jquery-3.5.1.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/bootstrap.bundle.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/OverlayScrollbars.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/plyr.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/autoComplete.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/clamp.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-interface.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-commerce.js?time='.time()) }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/imask.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/quill.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/quill.active.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/tagify.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/dropzone.min.js?time='.time()) }}"></script>

  <!-- Template Base Scripts Start -->
  <script src="{{ asset('assets/admin/js/base/helpers.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/globals.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/nav.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/search.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/settings.js?time='.time()) }}"></script>
  <!-- Template Base Scripts End -->
  <!-- Page Specific Scripts Start -->
  <script src="{{ asset('assets/admin/js/cs/dropzone.templates.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/forms/controls.tag.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/pages/products.detail.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/plugins/players.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/common.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/scripts.js?time='.time()) }}"></script>
  <!-- Page Specific Scripts End -->
  <script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/jquery.validate.min.js?time='.time()) }}"></script>
  <script>
    $(document).ready(function () {
      $("#manage-exercises").validate();
    });
  </script>
  <script>
    var tagsArray = [];
    $.ajax({
      type: 'get',
      url: '{{ route('manageExercises.get-parts') }}',
      success: function(response) {
        if (response.status == true) {
          tagsArray = response.data;
          initializeTagify(tagsArray);
        } else {
          console.log(response.message);
        }
      },
      error: function(error) {
        console.error(error);
      }
    });
      
    function initializeTagify(tagsArray){
      initializeTagifyById('tagsBodyPart',tagsArray[0])
      initializeTagifyById('tagsEquipment',tagsArray[1])
      initializeTagifyById('tagsExerciseType',tagsArray[2])
    }

    function initializeTagifyById(id,tags){
        var input = document.querySelector(`#${id}`);
        var tagifyBodyPart = new Tagify(input, {
          whitelist: tags,
          callbacks: {
            invalid: onInvalidTag,
          },
          dropdown: {
            position: 'text',
            enabled: 1, 
          },
        
        });
        var button = input.nextElementSibling; 
        button.addEventListener('click', onAddButtonClick);
        function onAddButtonClick() {
          tagifyBodyPart.addEmptyTag();
        }
        function onInvalidTag(e) {}
    }

    if (document.getElementById('highlightMedia')) {
      new Dropzone('#highlightMedia', {
        url: '{{ route('manageExercises.upload-file') }}',
        thumbnailWidth: 600,
        thumbnailHeight: 430,
        maxFiles: 3,
        acceptedFiles: 'image/jpeg, image/png, image/jpg, video/*',
        previewTemplate: DropzoneTemplates.columnPreviewImageTemplate.replace('preview-container rounded-0 rounded-md-top','preview-container rounded-0 rounded-md-top media-container'),
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        init: function () {
          this.on('success', function (file, response) {
            var hiddenInputHighlightImage = $('<input>').attr({
                type: 'hidden',
                name: 'highlight_images[]',
                index: file.upload.uuid,
                value: response.file_path
            });

            $('#highlightMediaContainer').append(hiddenInputHighlightImage)

            if (file.type.startsWith('video/')) {
              var videoPlayer = document.createElement('video');
              videoPlayer.controls = true;
              videoPlayer.style.width = 'inherit';
              videoPlayer.src = response.file_path;
              file.previewElement.querySelector('.media-container').innerHTML = '';
              file.previewElement.querySelector.appendChild(videoPlayer);
              videoPlayer.play();
            }
          });

          this.on('removedfile', function (file) {
            removeFile(file,'highlight_images')
          });

          @if(!empty(old('highlight_images')))
          @php $highlight_img = old('highlight_images') @endphp
          @endif
          @isset($highlight_img)
          @foreach($highlight_img as $i => $media)
            @if(pathinfo($media)['extension'] == 'mp4')
             var  videofile = { name: '', size: 267140 };
              this.displayExistingFile(videofile, '{{ asset($media) }}');
              var videoPlayer = document.createElement('video');
              videoPlayer.controls = true;
              videoPlayer.style.width = 'inherit';
              videoPlayer.src = '{{ asset($media) }}';
              document.querySelectorAll('.media-container')[{{ $i }}].innerHTML = '';
              document.querySelectorAll('.media-container')[{{ $i }}].appendChild(videoPlayer);
              videoPlayer.play();
            @else
              var  image = { name: '', size: 267140 };
              this.displayExistingFile(image, '{{ asset($media) }}');
            @endif
          @endforeach
          @endisset
        },
      });
    }

    function removeFile(file,name){
      var  url = new URL(file.dataURL);
      var path = url.pathname;
      if ($(`input[name="${name}[]"]`).attr('index') !== undefined) {
        var indexToDelete = file.upload.uuid;
        $('input[index="' + indexToDelete + '"]').remove();
      } else {
        $('input[value="' + path + '"]').remove();
      }
    }

    if (document.getElementById('directionVideos')) {
      new Dropzone('#directionVideos', {
        url: '{{ route('manageExercises.upload-file') }}',
        thumbnailWidth: 600,
        thumbnailHeight: 430,
        acceptedFiles: 'video/*',
        maxFiles: 3,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        previewTemplate: DropzoneTemplates.columnPreviewImageTemplate.replace('preview-container rounded-0 rounded-md-top','preview-container rounded-0 rounded-md-top video-container'),
        init: function () {
          this.on('success', function (file, response) {
            var hiddenInputDirectionVideos = $('<input>').attr({
                type: 'hidden',
                name: 'direction_videos[]',
                index: file.upload.uuid,
                value: response.file_path
            });

            $('#directionVideosContainer').append(hiddenInputDirectionVideos)

              var videoPlayer = document.createElement('video');
              videoPlayer.controls = true;
              videoPlayer.style.width = 'inherit';
              videoPlayer.src = response.file_path;
              file.previewElement.querySelector('.video-container').appendChild(videoPlayer);
              videoPlayer.play();

            });

          this.on('removedfile', function (file) {
            removeFile(file,'direction_videos')
          });

          @if(!empty(old('direction_videos')))
          @php $direction_videos = old('direction_videos'); @endphp
          @endif
          @isset($direction_videos)
          @foreach($direction_videos as $i => $video)
            var  videofile = { name: '', size: 267140 };
            this.displayExistingFile(videofile, '{{ asset($video) }}');
            var videoPlayer = document.createElement('video');
            videoPlayer.controls = true;
            videoPlayer.style.width = 'inherit';
            videoPlayer.src = '{{ asset($video) }}';
            document.querySelectorAll('.video-container')[{{ $i }}].innerHTML = '';
            document.querySelectorAll('.video-container')[{{ $i }}].appendChild(videoPlayer);     
          @endforeach
          @endisset
        }
      });

      if (document.getElementById('dropzoneProductVideoButton')) {
          document.getElementById('dropzoneProductVideoButton').addEventListener('click', (event) => {
          document.getElementById('directionVideos').dispatchEvent(new Event('click'));
        });
      }
    }

   var quillBubbleToolbarOptions = [
      ['bold', 'italic', 'underline', 'strike', 'link'],
      [{header: [1, 2, 3, 4, 5, 6, false]}],
      [{list: 'ordered'}, {list: 'bullet'}],
      [{align: []}],
    ];

    if (document.getElementById('BenefitsEditor')) {
      var benefitsQuill = new Quill('#BenefitsEditor', {
        modules: { toolbar: quillBubbleToolbarOptions},
        theme: 'bubble',
      });

      benefitsQuill.on('text-change', function() {
        var editorContent = benefitsQuill.root.innerHTML;
        var strippedContent = editorContent.replace(/<[^>]*>/g, '');
        $('#benefits').val(strippedContent);
      });
    }
  </script>
  <script>
    $(document).ready(function(){

      function initializeLivePreviewEditors() {  
        $('.direction-row').each(function() {
          var row = $(this);
          var editorId = row.find('.direction-description-editor').attr('id');
          var quill = new Quill('#' + editorId, {
            modules: {
              toolbar: quillBubbleToolbarOptions, 
            },
            theme: 'bubble',
          });

          quill.on('text-change', function() {
            var editorContent = quill.root.innerHTML;
            var strippedContent = editorContent.replace(/<[^>]*>/g, '');
            row.find('.direction_description').val(strippedContent);
          });
        });
     }

    initializeLivePreviewEditors();

    function updateBtnCss(){
      $(".direction-create-btn:last").show(); 
      $(".direction-create-btn:not(:last)").hide(); 
    }

    function initializeDirection() {

      function updateIndexes() {
        $('.direction_description').each(function (i) {
          $(this).attr('name', 'directions[' + i + ']');
        });
      }

      function updateRowIndexes() {
        $('.direction-row').each(function (i) {
          $(this).attr('index', i + 1);
        });
      }

      function updateStepIndexes() {
        $('.step-index').each(function (i) {
          $(this).html(`${i + 1}<br>Steps`);
        });
      }

      function updateEditorIndexes() {
        $('.direction-description-editor').each(function(i) {
          $(this).attr('id', 'direction-description-' + i);
        })
      }
      
      $(".direction-create-btn:last").off("click").on("click", function() {
        var rowToClone = $(".direction-row:last");
        var clonedRow = rowToClone.clone(true);
        var direction_last_index = parseInt(clonedRow.attr('index')) + 1;
        clonedRow.find('input').val('');
        clonedRow.attr('index', direction_last_index)
        clonedRow.find('.step-index').html(`${direction_last_index}<br>Steps`);
        clonedRow.find('.direction-description-editor').empty();
        clonedRow.find('label.error').remove();
        clonedRow.find('.direction-description-err').remove()
        clonedRow.appendTo($("#directions-container"));

        updateRowIndexes();
        updateStepIndexes();
        updateIndexes();
        updateEditorIndexes()

        initializeLivePreviewEditors();
        $('.direction-delete-btn').removeAttr('disabled');
        updateBtnCss();
         
      });

      $(".direction-delete-btn").off("click").on("click", function() {
        $(this).parents('.direction-row').remove();
        
        if ($(".direction-row").length === 1) {
          $(".direction-row").first().find('.direction-delete-btn:first').attr('disabled', true);
        }

        updateRowIndexes();
        updateStepIndexes();
        updateIndexes();
        updateBtnCss();

      });

      updateBtnCss();
      updateIndexes();
    }
    initializeDirection();

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var exercise_id = $('#exercise_id').val();
    $("#updateStatus").click(function() { 
      var status = $(this).is(":checked") ? 1 : 0;
      $(this).val(status);
      $.ajax({
        type: 'post',
        url: '{{ route('manageExercises.set-status') }}',
        data: { status:status, exercise_id:exercise_id },
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
          if(response.status == true){
            Swal.fire("Success!", response.message, "success");
          } else {
            Swal.fire("Error!", response.message, "error");
          }
        },
        error: function(error) {
          console.error(error);
        }
      });
    });

    $('.meta-input').on('input', function(){
      var input = $(this).val();
      var name = $(this).attr('name');
      if (name === 'meta_title') {
        $('#pageTitle').text(input);
      } else if (name === 'meta_friendly_url') {
        $('#pageUrl').attr('href', input).children('h6').text(input);
      } else {
        $('#pageDesc').text(input);
      } 
    }).trigger('input');
    
    var toastElement = $('.toast')[0];
    var toast = new bootstrap.Toast(toastElement);
      toast.show();
  });
                    
  </script>
</body>
</html>
@endsection