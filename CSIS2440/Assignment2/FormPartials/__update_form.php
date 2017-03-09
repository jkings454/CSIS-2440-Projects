<div class="fade-up">
    <?php
    require_once("../DatabaseConnection.php");
    $id = null;
    $row = null;
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT * FROM FamilyDB.Contacts WHERE idContacts=$id;";

        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        if ($connection->errno) {
            die("Failed to execute query " . $connection->error);
        }
    } else {
        $result = null;
    }


    ?>
    <?php if (!$row) {
        echo "<h1>I don't know how you got here, but you should try again</h1>";
        die("Because something went horribly wrong");
    }?>
    <h3>Update a contact.</h3>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>First Name<span class="text-danger">*</span></label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $row["ContactsFirstName"] ?>" required/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Last Name<span class="text-danger">*</span></label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $row["ContactsLastName"] ?>" required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $row["ContactsUsername"] ?>"/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo $row["ContactsPassword"] ?>"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $row["ContactsAddress"] ?>"/>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone" value="<?php echo $row["ContactsPhoneNum"] ?>" class="form-control"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $row["ContactsCity"] ?>"/>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>State</label>
                <select name="state" class="form-control">
                    <option value="">--select one--</option>
                    <?php
                    foreach ($states as $state) {
                        $name = $state->{"name"};
                        $abbr = $state->{"abbreviation"};
                        if ($abbr != $row["ContactsState"]) {
                            echo "<option value=$abbr>$name</option>";
                        } else {
                            echo "<option value=$abbr selected>$name</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Zip Code</label>
                <input type="text" name="zip" pattern="[0-9]{5-9\-}"
                       value="<?php echo $row["ContactsZip"] ?>"
                       class="form-control" maxlength="9"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-xs-6">
            <div class="form-group">
                <label>Birthday</label>

                <input type="date" name="birthday" value="<?php echo substr($row["ContactsBirthday"],0, 10) ?>" class="form-control"/>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6">
            <div class="form-group">
                <label>Relationship</label>
                <select name="relationship" class="form-control">
                    <option value="">--select one--</option>
                    <option value="relative"
                        <?php echo ($row["ContactsRelationship"] == "relative") ? "selected" : ""?>>Relative</option>
                    <option value="friend"
                        <?php echo ($row["ContactsRelationship"] == "friend") ? "selected" : ""?>>Friend</option>
                    <option value="coworker"
                        <?php echo ($row["ContactsRelationship"] == "coworker") ? "selected" : ""?>>Coworker</option>
                    <option value="acquaintance"
                        <?php echo ($row["ContactsRelationship"] == "acquaintance") ? "selected" : ""?>>Acquaintance</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6 col-xs-offset-3 col-md-offset-0">
            <label>Sex</label>
            <p>
                <label class="radio-inline">
                    <input name="sex" value="m" type="radio"
                        <?php echo ($row["ContactsSex"] == "m" ? "checked" : "")?>/> Male
                </label>
                <label class="radio-inline">
                    <input name="sex" value="f" type="radio"
                        <?php echo ($row["ContactsSex"] == "f" ? "checked" : "")?>/> Female
                </label>
            </p>
        </div>

    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <input type="submit" class="btn btn-primary btn-block" value="Update"/>
    </div>
    <input name="action" type="hidden" value="update"/>
    <input name="id" type="hidden" value="<?php echo $id?>"/>
</div>