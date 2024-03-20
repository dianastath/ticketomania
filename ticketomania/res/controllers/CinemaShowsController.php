<?php
require_once 'database/DataBase.php';

class CinemaShowsController {
	//#############################################################
	private $db;	
	public function __construct() 
	{
        $this->db = new Database();
    }
	public function __destruct() 
	{
        $this->db->close();
    }
	//#############################################################
    public function GetCinemaShows($id = null) {
	    if ($id !== null) {
			$sql = "SELECT * FROM cinema_shows WHERE show_id = $id";
	        $result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        } else {
			$sql = "SELECT * FROM cinema_shows";
			$result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        }
    }
	//#############################################################
    public function GetCinemaShowsByMovie($id = null) {
	    if ($id !== null) {
			$sql = "SELECT * FROM cinema_shows WHERE movie_id = $id";
	        $result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        } else {
			$sql = "SELECT * FROM cinema_shows";
			$result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        }
    }
	//#############################################################
	public function addShow() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$show_id   = $data->data->show_id;
  			$movie_id  = $data->data->movie_id;
  			$hall_id   = $data->data->hall_id;
  			$show_time = $data->data->show_time;
  			$start_date= $data->data->start_date;
  			$end_date  = $data->data->end_date;
			
			$sql = "INSERT INTO cinema_shows ( show_id, movie_id , hall_id , show_time , start_date , end_date  ) 
			VALUES ( null, '$movie_id', '$hall_id' , '$show_time' , '$start_date' , '$end_date' )";

			$result = $this->db->query($sql);
			if ($result)
			{
				$LastID = $this->db->GetLastInsertedID();
				$sql = "SELECT * FROM cinema_shows WHERE show_id = $LastID";
		        $result = $this->db->query($sql);
				$rows = $result->fetch_all(MYSQLI_ASSOC);
				echo json_encode(['Status' => 'OK' , 'Message' => 'DataBase Create OK' , 'Data'=>$rows ]);
			}
			else
			{
				echo json_encode(['Status' => 'ERROR' , 'Message' => 'DataBase Insert Error']);
			}
		}
		else
		{
			http_response_code(400);
            echo json_encode(['Status' => 'ERROR' , 'Message' => 'Invalid JSON format']);
		}
    }
	//#############################################################
	public function updateShow() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$show_id   = $data->data->show_id;
  			$movie_id  = $data->data->movie_id;
  			$hall_id   = $data->data->hall_id;
  			$show_time = $data->data->show_time;
  			$start_date= $data->data->start_date;
  			$end_date  = $data->data->end_date;
			
			$sql = "UPDATE cinema_shows SET  hall_id='$hall_id' , movie_id='$movie_id' , show_time='$show_time' , start_date='$start_date' , end_date='$end_date'  WHERE show_id = '$show_id' LIMIT 1 ";
			$result = $this->db->query($sql);

			if ($result)
			{
				echo json_encode(['Status' => 'OK' , 'Message' => 'DataBase Update OK']);
			}
			else
			{
				echo json_encode(['Status' => 'ERROR' , 'Message' => 'DataBase Update Error']);
			}
		}
		else
		{
			http_response_code(400);
            echo json_encode(['Status' => 'ERROR' , 'Message' => 'Invalid JSON format']);
		}
    }
	//#############################################################
	public function deleteshow($Id) 
	{
		$sql = "DELETE FROM cinema_shows WHERE show_id='$Id' ";
		$result = $this->db->query($sql);
		if ($result)
		{
			echo json_encode(['Status' => 'OK' , 'Message' => 'DataBase Delete OK']);
		}
		else
		{
			http_response_code(400);
			echo json_encode(['Status' => 'ERROR' , 'Message' => 'DataBase Delete Error']);
		}


	}


}

    ?>