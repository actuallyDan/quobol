<html>
<body>
	<ul class="collection z-depth-1" style="margin-left:10px; margin-right: 10px;">
	<?php //require_once 'linkDB/manageEvents.php';
	if (isset($_POST['searchForEvent'])) {
		EventManage::getEventsOnSearch($link);
	} else {
	EventManage::getEvents($link, $lat, $lng); 
	}?>   
	</ul>
</body>
</html>