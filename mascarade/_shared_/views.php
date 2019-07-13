<?php

function showPages(){

	global $nbrPages;
	global $currentPage;
	?>

	<div class ="pagination"> Pages :

		<?php
		for ($i=1; $i <= $nbrPages ; $i++) {

			if ($nbrPages > 6) {
				if ($i <= 3 or $i >= $nbrPages-2) {
					if ($i==$currentPage) {
						echo "<span style='color:#c8c8c8'>".$i."</span>";
					}
					else{
						$file = explode('&page', $_SERVER['REQUEST_URI'])[0];
						echo "<a href='".$file."&page=".$i."'>".$i."</a> ";
					}
					if ($i<$nbrPages) {
						echo " - ";
					}					
				}else{
					echo "... - ";
				}
			}else{
				if ($i==$currentPage) {
					echo "<span style='color:#c8c8c8'>".$i."</span>";
				}
				else{
					$file = explode('&page', $_SERVER['REQUEST_URI'])[0];
					echo "<a href='".$file."&page=".$i."'>".$i."</a> ";
				}
				if ($i<$nbrPages) {
					echo " - ";
				}
			}
		} ?>
	</div>
<?php
}




?>