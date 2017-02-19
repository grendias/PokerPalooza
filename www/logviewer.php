<?php

require_once('../src/Repository.php');

$repo = new Repository();
$logs = $repo->GetTodayLogs();

?>

<html>
    <head>
        <title>Pokerpalooza-Logs</title>
    </head>
    <body>
        <div class="header plaque">
            <div class="bevel">
                <div class="header-text">PokerPalooza</div>
				<div class="header-text2">Log viewer</div>
            </div>
        </div>
        <div id="body">
			<div id="log_stream">
				<?php if (!isset($logs) || count($logs) === 0) { ?>
					<p>
						There don't seem to be any logs for today.
					</p>

					<?php } else { ?>
					
					<ul>
						<?php foreach ($logs as $log) { 
							
							$todate = strtotime($log['Timestamp']);
							//echo(" {$todate} - ");
							
							$realtimestamp = strtotime('-8 hour' , $todate) ;
							//echo(" {$realtimestamp} - ");

							$formatted = date('Y-m-d', $realtimestamp);
							//echo(" {$formatted} -");

							$today = date('Y-m-d');
							//echo(" {$formatted} *********");

							$isequal = strcmp($today, $formatted);
							//echo("IsEqual = {$isequal}");

							if ($isequal == 0) { 
								$formattedforlog = date('Y-m-d H:i:s', $realtimestamp); ?>
							
								<li data-id="<?=$log['LogID']?>">
									<span><?=$formattedforlog?>&nbsp;<?=$log['Level']?>&nbsp;<?=$log['Source']?>&nbsp;<?=$log['Message']?></span>
								</li>
						
						<?php } } ?>
					</ul>
				<?php } ?>
			</div>
		</div>
    </body>
</html>
