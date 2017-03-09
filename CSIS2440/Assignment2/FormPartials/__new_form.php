<div class="fade-up">
    <h3>Create a new Contact.</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>First Name<span class="text-danger">*</span></label>
                <input type="text" name="firstname" class="form-control" placeholder="Jane" required/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Last Name<span class="text-danger">*</span></label>
                <input type="text" name="lastname" class="form-control" placeholder="Doe" required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username"/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="123 Street"/>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone" placeholder="123-456-7890" class="form-control"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" placeholder="Smallville"/>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>State</label>
                <select name="state" class="form-control">
                    <option value="">--select one--</option>
                    <?php
                    foreach($states as $state) {
                        $name = $state->{"name"};
                        $abbr = $state->{"abbreviation"};

                        echo "<option value=$abbr>$name</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Zip Code</label>
                <input type="text" name="zip" pattern="[0-9]{5-9\-}"
                       placeholder="12345"
                       class="form-control" maxlength="9"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-xs-6">
            <div class="form-group">
                <label>Birthday</label>

                <input type="date" name="birthday" class="form-control"/>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6">
            <div class="form-group">
                <label>Relationship</label>
                <select name="relationship" class="form-control">
                    <option value="">--select one--</option>
                    <option value="relative">Relative</option>
                    <option value="friend">Friend</option>
                    <option value="coworker">Coworker</option>
                    <option value="acquaintance">Acquaintance</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6 col-xs-offset-3 col-md-offset-0">
            <label>Sex</label>
            <p>
                <label class="radio-inline">
                    <input name="sex" value="m" type="radio"/> Male
                </label>
                <label class="radio-inline">
                    <input name="sex" value="f" type="radio"/> Female
                </label>
            </p>
        </div>

    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <input type="submit" class="btn btn-primary btn-block" value="Submit"/>
    </div>
    <input name="action" type="hidden" value="new">
</div>