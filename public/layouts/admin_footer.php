		<div id="footer">
			Copyright <?php echo date("Y", time()); ?>, Kalyan Srinivas L
		</div>
	</body>
</html>
<?php
	if(isset($database))
		$database->close_connection();
?>