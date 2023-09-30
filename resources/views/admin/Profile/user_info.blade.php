  <!-- Change Password Modal Start -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="changePasswordModalLabel">Reset Password</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-5">
            <h2 class="cta-1 mb-0 text-primary">FitnessandMealPlanner.com</h2>
          </div>
          <div class="mb-5">
            <h2 class="cta-1 mb-0 text-primary">Password trouble?</h2>
            <h2 class="cta-1 text-primary">Renew it here!</h2>
          </div>
          <div class="mb-5">
            <p class="h6">Please use below form to reset your password.</p>
          </div>
          <div>
            <form id="resetForm" class="tooltip-end-bottom" novalidate>
              <div class="mb-3 filled">
                <i data-acorn-icon="lock-off"></i>
                <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
              </div>
              <div class="mb-3 filled">
                <i data-acorn-icon="lock-on"></i>
                <input class="form-control" name="verifyPassword" type="password" placeholder="Verify Password" />
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Reset Password</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Change Password Modal End -->

  <!-- Change Name Modal Start -->
  <div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="changeNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="changeNameModalLabel">Change Name</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <input type="text" class="form-control" value="{{ $full_name ?? '' }}" name="name">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Change Name Modal End -->

   <!-- Change Email Modal Start -->
   <div class="modal fade" id="changeEmailModal" tabindex="-1" aria-labelledby="changeEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="changeEmailModalLabel">Change Email</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <input type="text" class="form-control" value="{{ $user->email ?? ''}}" name="email">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Change Email Modal End -->

 <!-- Change Phone Modal Start -->
 <div class="modal fade" id="changePhoneModal" tabindex="-1" aria-labelledby="changePhoneModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="changePhoneModalLabel">Change Phone</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" value="{{ $user->phone ?? ''}}" name="phone">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Change Phone Modal End -->