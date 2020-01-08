<div class="row">
	<div class="col-8 offset-2">
		<h2>Add a new item</h2>
		<hr/>
		<br d
		<?php
			echo $this->Form->create($item); 
			
			echo "<div class='row'>";
				echo '<div class="col-6">';
					echo $this->Form->control("Item_name", 
						[
							"class" => 'form-control',
							"placeholder" => "Please enter Item name"
						]);				
				echo "</div>";					
			echo "<div class='row mt-3'>";
				echo '<div class="col-4">';
					echo $this->Form->control("Item_Price", 
					[
						"placeholder" => "Please enter price",
						"class" => 'form-control',
					]);
				echo "</div>";
				echo '<div class="col-4">';
					echo $this->Form->control("Item_Disc", 
					[
						"class" => 'form-control',
					]);
                echo "</div>";
                echo '<div class="col-4">';
					echo $this->Form->control("Item_public", array(
                    'type' => 'checkbox',
                    )) ;
                echo "</div>";
                echo '<div class="col-4">';

                echo $this->Form->input('Item_Image', ['type' => 'file']); 
                echo "</div>";
					
				
			echo "</div><br/>";
			
			echo $this->Form->button("Add Item", 
				[
					"class" => 'form-control btn btn-danger'
				]);
			