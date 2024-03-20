<?php
require_once 'database/DataBase.php';

class CinemaHallController {
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
    public function GetCinemaHalls($id = null) {
	    if ($id !== null) {
			$sql = "SELECT * FROM cinema_hall WHERE hall_id = $id";
	        $result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        } else {
			$sql = "SELECT * FROM cinema_hall";
			$result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        }
    }
    
	//#############################################################
    public function addHall() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$hall_name   = $data->data->hall_name;
			$hall_seats = $data->data->hall_seats;

			
			$sql = "INSERT INTO cinema_hall ( hall_id, hall_name , hall_seats ) VALUES ( null, '$hall_name', '$hall_seats'  )";
			//$sql = "UPDATE cinema_hall SET  hall_name='$hall_name' ,  hall_seats='$hall_seats'  WHERE hall_id = '$hall_id' LIMIT 1";
			$result = $this->db->query($sql);
			if ($result)
			{
				$LastID = $this->db->GetLastInsertedID();
				$sql = "SELECT * FROM cinema_hall WHERE hall_id = $LastID";
		        $result = $this->db->query($sql);
				$rows = $result->fetch_all(MYSQLI_ASSOC);
				//return $rows;
				echo json_encode(['Status' => 'OK' , 'Message' => 'DataBase Create OK' , 'Data'=>$rows ]);
			}
			else
			{
				echo json_encode(['Status' => 'ERROR' , 'Message' => 'DataBase Insert Error']);
			}
			//$this->userModel->createUser(json_decode($postdata));
		}
		else
		{
			http_response_code(400);
            echo json_encode(['Status' => 'ERROR' , 'Message' => 'Invalid JSON format']);
		}
    }
	//#############################################################

	public function updateHall() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$hall_id     =$data->data->hall_id;
			$hall_name   = $data->data->hall_name;
			$hall_seats  = $data->data->hall_seats;


			$sql = "UPDATE cinema_hall SET hall_name='$hall_name' , hall_seats = '$hall_seats'   WHERE hall_id = '$hall_id' LIMIT 1";
									  
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
	public function deleteHall($Id) {
		$sql = "DELETE FROM cinema_hall WHERE hall_id='$Id' ";
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
	//###########################################################################################################################
		
}
?>
