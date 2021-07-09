<h1>Your Profile</h1>
<form action="settings.php?option=profile" class="needs-validation" novalidate method="post">
    <div class="form-group">
        <label for="uname">Username:</label>
        <?php include "boostraplink.php" ?>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo $_SESSION["name"] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>