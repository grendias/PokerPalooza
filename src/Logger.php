<?php

class Logger
{
    private $logfilepath = 'D\:\Projects\Pokerpalooza\www\logs\dashboard-log.txt';
	public function __construct()
	{
		$this->SetLogFile();
	}

	private function SetLogFile()
	{
        if (!$logfile = fopen($this->logfilepath, "a+")) 
        {
            echo "Cannot open file ($logfile)";
            exit;
        }

        // Read the log date from the beginning of the file
        $logdate = fread($logfile, 10);

        // If the date is not today, rename the file to archive it
        $today =  date('m-d-Y');
        if (strpos($logdate, '-') && $logdate !== $today)
        {
            fclose($logfile);
            $current = $this->logfilepath;
            rename($current, "D\:\Projects\Pokerpalooza\www\logs\dashboard-log_$logdate.txt");
            $logfile = fopen($this->logfilepath, "a+");
            fclose($logfile);
        }
	}

	public function Write($level, $source, $text)
	{
        if (!$logfile = fopen($this->logfilepath, "a+")) 
        {
            echo "Cannot open file ($this->logfilepath)";
            exit;
        }

        $source = str_pad($source, 6, " ");
        $timestamp = date('m-d-Y h:m:s');
        $entry = "$timestamp $level $source - $text \r\n";
        
        if (fwrite($logfile, $entry) === FALSE) {
            echo "Cannot write to file ($this->logfilepath)";
            exit;
        }

        fclose($logfile);
	}

	// public function GetBlinds($gameID)
	// {
	// 	$sql = '
	//     	SELECT 	b.BlindID,
	//     			SmallBlind,
	//     			LargeBlind,
	//     			ChipUpID,
	// 				(SELECT ImageFilename FROM chips WHERE ChipID = ChipUpID) AS ChipUpIMG,
	//     			EndOfRebuy,
	// 				(SELECT EXISTS( SELECT * FROM completedblinds cb WHERE cb.BlindID = b.BlindID and cb.GameID = :gameid)) AS Completed
	//     	FROM 	blinds b
	//     	WHERE 	Status > 0
	// 	';

	// 	$statement = $this->database->prepare($sql);
	// 	$statement->bindValue(':gameid', $gameID);
	// 	$statement->execute();
	// 	return $statement->fetchAll(PDO::FETCH_ASSOC);		
	// }

	// function ClearSavedTime($data)
	// {
	// 	$sql = '
	// 		UPDATE	timervalues
	// 		SET		Status = 0
	// 		WHERE	Status = 1
	// 		AND		GameID = :gameid
	// 	';

	//     $statement = $this->database->prepare($sql);
	// 	$statement->bindValue(':gameid', $data['gameid']);

	// 	$result = array(
    //         "success" => $statement->execute(),
    //         "message" => $statement->errorCode()
	//     );

	// 	json_encode($result);
	// }
	
	// function UpsertEndBlind($blind)
	// {
    //     $sql = '
    //         INSERT INTO completedblinds 
    //             (BlindID, 
    //             GameID)
    //         VALUES 
    //             (:blindid,
    //             :gameid)
    //         ';

	//     $statement = $this->database->prepare($sql);
	// 	$statement->bindValue(':blindid', $blind['BlindID']);
	// 	$statement->bindValue(':gameid', $blind['GameID']);

	// 	$result = array(
    //         "success" => $statement->execute(),
    //         "message" => $statement->errorCode()
	//     );
	// }
}

?>