
<!-- Modal buy now-->
<div class="modal fade commit-popup" id="com" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelSaleLabel">Commit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row ventureCommit">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Venture Name</label>
                    <input type="text" name="venture_name" placeholder="Venture Name" class="form-control v_venture_name" readonly>
                </div>
            </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="First Name" class="form-control v_first_name" readonly>
                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                       <input type="hidden" name="new_venture_id" class="v_new_venture_list" >
                        <input type="hidden" name="venture_amount" class="v_amount" >
                </div>
            </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Last Name" class="form-control v_last_name" readonly>
                </div>
            </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label>Membership ID</label>
                    <input type="text" name="member_id" placeholder="Membership ID" class="form-control v_member_id" value="{{\Illuminate\Support\Facades\Auth::user()->member_automated_id}}" readonly>
                </div>
            </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Email Address" class="form-control v_email" readonly>
                </div>
            </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label>Listing ID</label>
                    <input type="text" name="list_id" placeholder="Listing ID" class="form-control v_list_id" readonly>
                </div>
            </div>
               <div class="col-sm-6">
                <div class="form-group">
                    <label>Commit Amount</label>
                    <input type="number" name="commit_amount" placeholder="$ Amount" class="form-control">
                </div>
            </div>
              <div class="col-sm-12">
                  <p class="spanAlert">* By clicking submit you agree to all the terms and conditions involved in this transaction.</p>
                  <p class="spanAlert">* You also understand that you will be gettting all formation documents for the new LLC. You will need to sign and return all documents including the PSA, Formation documents and Operating agreement before this commitment can be formatlized. We do not execute any formation documents or PSA until we have full commitment. The amount you commit will be pulled from your account and placed in an escrow account until either the purchase occurs or the commitment has not occurred by the end date and will then be returned to your account.</p>
              <button class="btn btn-success btnloop" id="save-commit-button" >Submit
                          </button>
              </div>
          </div>

      </div>

    </div>
  </div>
</div>

<!-- Modal -->
