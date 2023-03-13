<form id="buy-now-form">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Venture Name</label>
                <input type="text" name="" value="{{ !is_null($ventureList->venture) ? $ventureList->venture->venture_name : ''}}"  placeholder="Venture Name" class="form-control" readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="" placeholder="First Name" value="{{ Auth::user()->first_name }}" class="form-control" readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="" placeholder="Last Name" class="form-control" value="{{ Auth::user()->last_name }}" readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Membership ID</label>
                <input type="text" name="" placeholder="Membership ID" class="form-control" value="{{ Auth::user()->member_automated_id }}" readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="" placeholder="Email Address" class="form-control" value="{{ Auth::user()->email}}" readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Listing ID</label>
                <input type="text" name="listing_id" placeholder="Listing ID" class="form-control" value="{{ $ventureList->list_automated_id }}" readonly>
            </div>
        </div>

        <div class="col-sm-12">
            <p class="spanAlert">* By clicking submit you agree to all the terms and conditions involved in this transaction.</p>
            <p class="spanAlert">* You also understand that you will be getting a formal Purchase and Sales agreement via email along with other documentation that will need to be electronically signed and returned in order to complete this offer.</p>
            <button class="btn btn-success btnloop" id="save-buy-now-request">Submit</button>

        </div>
    </div>
</form>