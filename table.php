<?php


	//table.php
	require_once("functions.php");
	//kas kasutaja tahab kustutada
	//kas aadressireal on ?delete=???
	if(isset($_GET["delete"])){
		
		//saadan kaasa id, mida kustutada
		deleteCar($_GET["delete"]);
		
		
	}
	$car_list = getCarData();
	//var_dump($array);
	
	
?>
<table border=1 >
<tr>
	<th>id</th>
	<th>auto nr märk</th>
	<th>kasutaja id</th>
	<th>värv</th>
</tr>

		<?php
		
		
		for($i = 0; $i < count($car_list); $i++){
			
			//kui on see rida, mida kasutaja tahab muuta, siis kuvan input v'ljad
		if(isset($_GET["edit"]) && $car_list[$i]->id == $_GET["edit"]){
			
			echo "<tr>";
			echo "<form>";
			echo "<td>".$car_list[$i]->id."</td>";
			echo "<td><input name='number_plate' value='".$car_list[$i]->number_plate."'></td>";
			echo "<td>".$car_list[$i]->user_id."</td>";
			echo "<td><input name='color' value='".$car_list[$i]->color_from_db."'></td>";
			echo "<td><input type='submit' name='update'></td>";
			echo "<td><a href='table.php'>cancel</a></td>";			
						
			
			echo "</form>";
			echo "</tr>";
			
		}else{
			
			echo "<tr>";
			
			echo "<td>".$car_list[$i]->id."</td>";
			echo "<td>".$car_list[$i]->number_plate."</td>";
			echo "<td>".$car_list[$i]->user_id."</td>";
			echo "<td>".$car_list[$i]->color_from_db."</td>";
			echo "<td><a href='?delete=".$car_list[$i]->id."'>X</a></td>";
			echo "<td><a href='?edit=".$car_list[$i]->id."'>edit</a></td>";
			echo "<td><a href='edit.php?edit=".$car_list[$i]->id."'>edit.php</a></td>";
			
			echo "</tr>";}
			
			
			
		}
		?>


</table>