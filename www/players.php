<?php if ($game['GameID'] > 0) { ?>
	<div class="players">
		<div class="button" title="Add player" id="Add_Player">Add Player</div>
		<div class="button" title="Add a few players" id="Add_Players">Add Multi</div>
		<ul>
			<?php foreach ($players as $player) { ?>
				<li class='paidx<?=$player['BuyinCount']?> boosted-<?=$player['Boosted']?>' data-id='<?=$player['PlayerID']?>' data-gameplayerid='<?=$player['GamePlayerID']?>' data-name='<?=$player['FirstName']?> <?=$player['LastName']?>'>
					<span><?=$player['FirstName']?></span>
					<?php if ($player['BuyinCount'] > 0) { $buyincount++; } ?>
					<?php for ($inx = $player['BuyinCount']; $inx > 1; $inx--) { ?>
						<?php $buyincount++ ?>
						<div class='rebuy'>
							&#9736;
						</div>
					<?php } ?>
					<?php if ($player['Boosted'] > 0) { $bumpcount++; ?>
						<div class='boost'>
							&#8673;
						</div>
					<?php } ?>
					
					<div class="placing"><?=$player['Placing']?></div><div class="clear"></div>
					
					<div class="player-menu hidden">
						<div>
							<h2></h2>
							<?php if ($player['BuyinCount'] > 0) { ?>
								<div class="button rebuy">Rebuy</div>
								<?php if ($player['Boosted'] < 1) { ?>
									<div class="button boost">Boost</div> 
								<?php } ?>
								<?php if (empty($player['Placing'])) { ?>
									<div class="button place">Place</div>
								<?php } ?>
								<div class="button disabled" title="this feature is under construction" id="Button_Refund">Refund</div>
							<?php } else { ?>
								<div class="button buy-in">Buy In</div>
								<div class="button remove-player">Remove</div>
							<?php } ?>
							<?php if (!empty($game['GameID']) && $game['GameID'] > 0) { ?>
								<div class="button player-menu-collapse">Close</div>
							<?php } ?>
						</div>
					</div>
				</li>
			
			<?php }	?>
		</ul>
	</div>
<?php }	?>