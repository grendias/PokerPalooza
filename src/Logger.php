<?php

class Logger
{
    private $logfilepath = 'D:\\Projects\\Pokerpalooza\\www\\logs\\dashboard-log.txt';
	public function __construct()
	{
		$this->SetLogFile();
	}

	private function SetLogFile()
	{
        
	}

	public function Write($level, $source, $text)
	{
        
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
