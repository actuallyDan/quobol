<?php


class ErrorMessage {
	public function displayError($message){
		echo 
		"<div id='modalError' class='modal hoverable' style='display: inline-block;position: absolute; top: 20%; z-index: 1010; height: 150px;'>
			<nav>
				<div class='nav-wrapper bknd-blue container-fluid'>
					<h1 class='brand-logo center' style='padding-top: 15px; font-size:20px;'>Error</h1>
					<a id='closeErrorMessage' class='right text-blue-light modal-close' style='padding-right:15px;'><i class='material-icons'>clear</i></a>
				</div>
			</nav>  
			<p class='center-align center text-grey'>" . $message . "</p>
			<br>
			<div class='row' style='margin: 20px;'>
				<div class='modal-footer col l12' style='text-align:center;'>
				</div>
			</div>
		</div>";
	}
		public function displayMessage($message){
		echo 
		"<div id='modalError' class='modal hoverable' style='display: inline-block;position: absolute; top: 20%; z-index: 1010; height: 150px;'>
			<nav>
				<div class='nav-wrapper bknd-blue container-fluid'>
					<h1 class='brand-logo center' style='padding-top: 15px; font-size:20px;'></h1>
					<a id='closeErrorMessage' class='right text-blue-light modal-close' style='padding-right:15px;'><i class='material-icons'>clear</i></a>
				</div>
			</nav>  
			<p class='center-align center text-grey'>" . $message . "</p>
			<br>
			<div class='row' style='margin: 20px;'>
				<div class='modal-footer col l12' style='text-align:center;'>
				</div>
			</div>
		</div>";
	}
}
?>