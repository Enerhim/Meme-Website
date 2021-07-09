<h1>Your Preferences</h1>
<?php $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT nsfw FROM accounts WHERE username = '" . $_SESSION["name"] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>


<form action="settings.php?option=preferences&nsfw=sent" class="needs-validation" novalidate method="post">
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="nsfw" name="nsfw"/>
    <label class="form-check-label" for="nsfw">NSFW</label>
  </div> <br/> 
  <button type="submit" class="btn btn-primary">Save</button>
</form>
<script> 
  function toggleNSFW() {
    var h1 = document.getElementById("nsfw");
    var att = document.createAttribute("checked");
    h1.setAttributeNode(att);
  }
</script>
<?php if ($row["nsfw"] == 1) {
  echo "<script>toggleNSFW();</script>";
}
mysqli_close($conn);?>