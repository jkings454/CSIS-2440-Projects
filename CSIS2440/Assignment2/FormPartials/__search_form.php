<div class="fade-up">
    <?php
    if ($_GET["action"] == "update") {
        echo "<p class='text-muted'>Search for a record to update.</p>";
    }
    ?>
    <div class="input-group input-group-lg">
        <input type="text" placeholder="Search for..." name="keywords" class="form-control"/>
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</div>
<input name="action" type="hidden" value="search">