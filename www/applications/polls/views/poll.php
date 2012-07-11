<div id="poll">
<?php	
	if(isset($poll["answers"])) {
		if(!COOKIE("ZanPoll")) {
			?>
				<form id="polls" method="post" action="<?php echo path("polls/vote"); ?>">			
					<p>
						<strong><?php echo $poll["question"]["Title"];?></strong>
					</p>
							
					<?php 
						$i = 1; 
						
						foreach($poll["answers"] as $answer) {
							echo '	<label for="answer_'. $i .'">
										<input id="answer_'. $i .'" name="answer" type="radio" value="'. $answer["ID_Answer"] .'"/>'. $answer["Answer"] .'<br />
									</label>';
							$i++;
						}
					?>
					
					<input name="ID_Poll" type="hidden" value="<?php echo $poll["question"]["ID_Poll"]; ?>" /><br />
				  
					<label for="send-vote">
						<input id="send-vote" name="send" type="submit" value="<?php echo __("Vote");?>" class="poll-submit" />
					</label>
				</form>
			<?php
		} else {
			if(isset($poll)) {
				$color[0] = _pollColor1;
				$color[1] = _pollColor2;
				$color[2] = _pollColor3;
				$color[3] = _pollColor4;
				$color[4] = _pollColor5;
				$color[5] = _pollColor6;
				$total    = 0;
				
				foreach($poll["answers"] as $answers) {
					$total = (int) ($total + $answers["Votes"]);
				}
				
				?>
					<p class="section">					
						<p>
							<strong><?php echo $poll["question"]["Title"]; ?></strong>
						</p>
					
						<?php 
							$i = 0;
							$percentage = 0;
							
							foreach($poll["answers"] as $answers) {
								if((int) $answers["Votes"] > 0) {								
									$percentage = ($answers["Votes"] * 100) / $total;
									
									if($percentage >= 10) {
										$percentage = substr($percentage, 0, 5);
									} else {
										$percentage = substr($percentage, 0, 4);
									}
								}			

								$style = "width: ". intval($percentage) ."%; background-color: ". $color[$i] .";";
						?>
								
								<span style="margin-left:5px;"><?php echo $answers["Answer"]; ?></span> <br />
								
								<div class="poll-graphic" style="border: 1px solid <?php echo $color[$i]; ?>;">
									<span class="poll-graphic-bar bold" style="<?php echo $style; ?>"><?php echo $percentage; ?>%</span>
								</div>
								
						<?php
								$i++;
								
								$percentage = 0;
							}
							
							$show = ($total === 1) ? '1 ' . __("vote") : $total .' '. __("votes");
						?>
						
						<br />
						<strong><?php echo __("Total");?>:</strong> <?php echo $show; ?>
					</p>
					<?php
			}
		}
	}
?>
</div>