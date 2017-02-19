<?php

require_once('../src/Repository.php');

$repo = new Repository();
$logs = $repo->GetTodayLogs();

?>

<html>
    <head>
        <title>Pokerpalooza-Logs</title>
        <link rel="stylesheet" href="styles/logs.css" type="text/css" />
    </head>
    <body>
        <div class="header plaque">
            <div class="bevel">
                <h1 class="header-text">PokerPalooza</h1>
				<h4 class="header-text2">Log viewer</h3>
				<hr />
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

							if ($isequal == 0 || $isequal) { 
								$formattedforlog = date('Y-m-d H:i:s', $realtimestamp); ?>
							
								<li class="log-<?=$log['Level']?>" data-id="<?=$log['LogID']?>">
									<span><?=$formattedforlog?>&nbsp;[<?=$log['Level']?>]&nbsp;(<?=$log['Source']?>)&nbsp;<?=$log['Message']?></span>
								</li>
						
						<?php } } ?>
					</ul>
				<?php } ?>
			</div>
		</div>
    </body>
</html>
