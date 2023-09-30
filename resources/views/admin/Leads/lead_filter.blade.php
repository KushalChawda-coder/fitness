<div class="modal modal-right fade" id="leadFilter" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header p-3">
        <h5 class="modal-title">Filter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body p-3">
        <button type="button" id="clear_filter" class="btn btn-sm btn-link position-absolute e-1 t-1">Clear Filter</button>
        <form action="{{ route('leads.lead-filter') }}" id="filter_form" method="post">
          @csrf
          <div class="mb-3">
            <label class="form-label">Date</label>
            <div class="input-daterange input-group" id="datePickerRange">
              <input type="text" class="form-control" id="start-date" value="{{ $filter['start'] ?? null }}" name="start" placeholder="Start">
              <span class="mx-2"></span>
              <input type="text" class="form-control" id="end-date" value="{{ $filter['end'] ?? null }}" name="end" placeholder="End">
            </div>
            <div class="mt-1">
              <button type="button" id="this_year" class="btn btn-sm btn-light h-auto">This Year</button>
              <button type="button" id="this_week" class="btn btn-sm btn-light h-auto">This Week</button>
              <button type="button" id="this_month" class="btn btn-sm btn-light h-auto">This Month</button>
              <!-- <button type="button" class="btn btn-sm btn-light h-auto">+3</button>
              <button type="button" class="btn btn-sm btn-light h-auto">+6</button> -->
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="row">
              <div class="col">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{ \App\Models\admin\Leads::NEW_LEAD }}" id="NewLead" name="new_lead" {{ isset($filter['new_lead']) ? 'checked' : '' }}>
                  <label class="form-check-label" for="NewLead">
                    New Lead
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{ \App\Models\admin\Leads::HOT_LEAD }}" id="HotLead" name="hot_lead" {{ isset($filter['hot_lead']) ? 'checked' : '' }}>
                  <label class="form-check-label" for="HotLead">
                    Hot Lead
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{ \App\Models\admin\Leads::NOT_GOOD_LEAD }}" id="Not_Good_Lead" name="Not_Good_Lead" {{ isset($filter['Not_Good_Lead']) ? 'checked' : '' }}>
                  <label class="form-check-label" for="Not_Good_Lead">
                    Not Good Lead
                  </label>
                </div>
              </div>
              <div class="col">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{ \App\Models\admin\Leads::FOLLOW_UP }}" id="FollowUp" name="follow_up" {{ isset($filter['follow_up']) ? 'checked' : '' }}>
                  <label class="form-check-label" for="FollowUp">
                    Follow Up
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{ \App\Models\admin\Leads::LOST_LEAD }}" id="LostLead" name="lost_lead" {{ isset($filter['lost_lead']) ? 'checked' : '' }}>
                  <label class="form-check-label" for="LostLead">
                    Lost Lead
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Tags</label>
            <div class="row tags-row ms-1">
              @if(!empty($tags))
              @foreach($tags as $tag)
              <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" value="{{ $tag }}" name="tags[]" id="{{ $tag }}" {{ isset($filter['tags']) && in_array($tag, $filter['tags'])  ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $tag }}">
                  {{ $tag }}
                </label>
              </div>
              @endforeach
              @endif
            </div>
            <div class="mb-3">
              <label class="form-label">Area</label>
              <select name="area" id="area" class="form-select">
                <option value="" selected>Please select area</option>
                @foreach($locations as $location)
                <option value="{{ $location }}" {{ isset($filter['area']) && $filter['area'] == $location ? 'selected' : '' }}>{{ $location }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="filter_btn">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>