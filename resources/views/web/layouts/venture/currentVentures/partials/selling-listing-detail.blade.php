<div class="row">
    <div class="col-sm-12">
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

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" value="{{ $ventureListDetail->pivot->price }}" placeholder="Asking Price" readonly="">
                </div>
            </div>
            <div class="col-sm-6">
                <label>What percent of your ownership would you like to sell?</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="selling_ownership_percentage" value="{{ $ventureListDetail->pivot->ownership_percent }}%" disabled placeholder="Ownership Percent">
                </div>

            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea disabled class="form-control" name="description" rows="5" placeholder="Nothing added.">{{$ventureListDetail->pivot->description}}</textarea>
                </div>
            </div>
        </div>