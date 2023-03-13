<form method="GET" id="sell-request-form">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <input type="hidden" name="ownership_id" value="{{$venturOwnership->id}}">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Venture Name</label>
                        <input type="text" name="" value="{{ !is_null($venturOwnership->venture) ? $venturOwnership->venture->venture_name : ''}}"  placeholder="Venture Name" class="form-control" readonly>
                        <input type="hidden" name="venture_id" value="{{ !is_null($venturOwnership->venture) ? $venturOwnership->venture->id : ''}}">
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
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Asking Price" >
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>What percent of your ownership would you like to sell?</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control ownership-percentage-dropdown" name="selling_ownership_percentage" style="height:45px">
                                    <option value="100">100%</option>
                                    <option value="75">75%</option>
                                    <option value="50">50%</option>
                                    <option value="25">25%</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 toggle-other" style="display: none;">
                            <div class="form-group">
                                <input type="number" class="form-control" name="selling_ownership_percentage" disabled placeholder="If other">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="5" placeholder="Description - not required, but could help sell it."></textarea>
                    </div>
                </div>
            </div>
            <p>* By clicking submit, you agree to all terms and conditions of the sell. Please watch your inbox for a confirmation once we have reviewed and posted it.</p>
            <button class="btn btn-md button-theme" id="save-selling-ownership-btn">Submit</button> </div>
    </div>
</form>