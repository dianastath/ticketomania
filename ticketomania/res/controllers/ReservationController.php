<?php
require_once 'database/DataBase.php';

class ReservationController {
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
    public function GetReservation($id = null) {
	    if ($id !== null) {
			$sql = "SELECT * FROM reservations WHERE res_id = $id";
	        $result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        } else {
			$sql = "SELECT * FROM reservations";
			$result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        }
    }
	//#############################################################
	//#############################################################
    public function GetMyReservation($id = null) {
	    if ($id !== null) {
			$sql = "SELECT * FROM reservations WHERE res_user_id = $id";
	        $result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        } else {
			$sql = "SELECT * FROM reservations";
			$result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        }
    }
	//#############################################################
    public function addReservation() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$res_user_id   = $data->data->res_user_id;
            $res_seats   = $data->data->res_seats;
            $res_date   = $data->data->res_date;
			$res_show_id   = $data->data->res_show_id;
			$res_status   = $data->data->res_status;
			$res_key = $data->data->res_key;
			$sql = "INSERT INTO reservations ( res_id, res_user_id ,res_date,res_seats, res_show_id , res_status , res_key ) VALUES 
			( null, '$res_user_id','$res_date','$res_seats', '$res_show_id' , '$res_status' , '$res_key'  )";
			$result = $this->db->query($sql);
			if ($result)
			{
				$LastID = $this->db->GetLastInsertedID();
				$sql = "SELECT * FROM reservations WHERE res_id = $LastID";
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
	public function CheckReservation() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$res_key = $data->data->res_key;
			$sql = "SELECT * FROM reservations WHERE (res_key = '$res_key' )";
			$result = $this->db->query($sql);
			$rowscount=0;
			if ($result) { $rowscount = mysqli_num_rows($result); }
			if ($rowscount > 0)
			{
				$rows = $result->fetch_all(MYSQLI_ASSOC);
				if ($rows[0]["res_status"] != 0)
				{
					echo json_encode(['Status' => 'ERROR' , 'Message' => 'ENTRY DENIED. ENTRY ALL READY DONE OR RESERVATION IS CANCELED']);
					return;
				}
			}

			$sql = "UPDATE reservations SET res_status='1' WHERE res_key = '$res_key'";
			$result = $this->db->query($sql);
			if ($result)
			{
			
				$sql = "SELECT * FROM reservations WHERE res_key = '$res_key'";
				$result = $this->db->query($sql);
				$rowscount=0;
				if ($result) { $rowscount = mysqli_num_rows($result); }
				if ($rowscount >0)
				{
					echo json_encode(['Status' => 'OK' , 'Message' => 'ENTRY APPROVED']);
				}
				else
				{
					echo json_encode(['Status' => 'ERROR' , 'Message' => 'ENTRY DENIED']);	
				}	
			}
			else
			{
				echo json_encode(['Status' => 'ERROR' , 'Message' => 'ENTRY DENIED']);
			}
		}
		else
		{
			http_response_code(400);
			echo json_encode(['Status' => 'ERROR' , 'Message' => 'Invalid JSON format']);
		}
    }
	//#############################################################
	public function CheckReservationByPhone($key) 
	{
			$res_key = $key;
   		    $sql = "UPDATE reservations SET res_status='1' WHERE res_key = '$res_key'";
			$result = $this->db->query($sql);
			if ($result)
			{
				$sql = "SELECT * FROM reservations WHERE res_key = '$res_key'";
				$result = $this->db->query($sql);
				$rowscount=0;
				if ($result) { $rowscount = mysqli_num_rows($result); }
				if ($rowscount >0)
				{
					echo "<h1>ENTRY APPROVED</h1>";
				}
				else
				{
					echo "<h1>ENTRY DENIED</h1>";	
				}	
			}
			else
			{
				echo "<h1>ENTRY DENIED</h1>";
			}
		
    }
	//#############################################################
	public function CancelReservation()
	{

		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$res_id = $data->data->res_id;	
			$sql = "UPDATE reservations SET res_status='-1' WHERE res_id = '$res_id'";
			$result = $this->db->query($sql);
			if ($result)
			{
				if ($result) 
				{
					echo json_encode(['Status' => 'OK' , 'Message' => 'RESERVATION CANCELED']);
				}
				else
				{
					echo json_encode(['Status' => 'ERROR' , 'Message' => 'RESERVATION NOT CANCELED']);	
				}	
			}
			else
			{
				echo json_encode(['Status' => 'ERROR' , 'Message' => 'RESERVATION NOT CANCELED']);
			}
		}
		else
		{
			http_response_code(400);
			echo json_encode(['Status' => 'ERROR' , 'Message' => 'Invalid JSON format']);
		}



	}
	public function deleteMovie($userId) {
        //$this->userModel->deleteUser($userId);
    }
	//###########################################################################################################################
		
}
?>
