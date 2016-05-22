<div class="popup main-menu plaque hidden">
	<div class="bevel">
		<?php if (empty($game['GameID']) || $game['GameID'] == 0) { ?>
			<div class="button" id="New_Game">New Game</div>
		<?php } else { ?>
			<div class="button" title="End running game and start new" id="New_Game">New Game</div>
			<div class="button" id="Close_Game">Close Game</div>
		<?php } ?>
		<div class="button disabled" title="this feature is under construction" id="Stats">Statistics</div>
		<?php if (!empty($game['GameID']) && $game['GameID'] > 0) { ?>
			<div class="button menu-collapse">Back to Game</div>
		<?php }
		if (isset($game['GameID'])) { ?>
			<select id="Theme_Picker">
				<?php foreach ($themes as $theme) { 
					if ($game['Theme'] == $theme['Filename']) {?>
						<option selected="selected" value="<?=$theme['ThemeID']?>" data-file="<?=$theme['Filename']?>"><?=$theme['Name']?></option>
					<?php } else { ?>
						<option value="<?=$theme['ThemeID']?>" data-file="<?=$theme['Filename']?>"><?=$theme['Name']?></option>
				<?php }} ?>
			</select>
		<?php } ?>
	</div>
</div>