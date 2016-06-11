<?php if ($game['GameID'] > 0) { ?>
	<div class="timer hidden">
		<audio id="siren" src="sounds/siren_noise.wav" controls preload="auto" autobuffer></audio>
		<table>
			<tbody>
				<tr class="display">
					<td class="first"><span class="minutes"><?=$timer['Minutes']?></span></td>
					<td><span class="separator">:</span></td>
					<td class="last"><span class="seconds"><?=$timer['Seconds']?></span></td>
					<td class="adjustments" rowspan="2">
						<div class='button' id="add_time">&#x25B2;</div>
						<div class='button' id="remove_time">&#x25BC;</div>
					</td>
				</tr>
				<tr class="control">
					<td class="first"><div class='button' id="start_timer">Start</div></td>
					<td><div class='button' id="stop_timer">Stop</div></td>
					<td class="last"><div class='button' id="clear_timer">Clear</div></td>
				</tr>
			</tbody>
		</table>
	</div>
<?php } ?>