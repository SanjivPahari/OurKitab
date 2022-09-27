	<hr>
<h1>Update Notice</h1>
<hr>
<form role="form" method="post" action="/panel.php">
<div class="form-group">
<input  class="form-control form-control-lg" name="notice" value="<?PHP echo file_get_contents("notice.txt"); ?>" width="100%">
</div>

<button type="submit" class="btn btn-warning btn-lg" name="update_notice">
							Update
						</button>
</form>
