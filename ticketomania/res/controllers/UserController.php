<?php
require_once 'database/DataBase.php';
class UserController {
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
    public function getUser($userId = null)
	{
	
		 if ($userId !== null) {
			$sql = "SELECT * FROM users WHERE user_id = $userId";
	        $result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        } else {
			$sql = "SELECT * FROM users";
			$result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        }
    }
	//#############################################################
    public function createUser() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$password  = $data->data->user_password;
			$user_name      = $data->data->user_name;
			$email     = $data->data->user_email;
			$user_type = $data->data->user_type;
			$sql = "INSERT INTO users ( user_id,user_name ,user_password , user_email , user_type ) VALUES ( null, '$user_name','$password', '$email', '$user_type' )";
			$result = $this->db->query($sql);
			if ($result)
			{
				$LastID = $this->db->GetLastInsertedID();
				$sql = "SELECT * FROM users WHERE user_id = $LastID";
		        $result = $this->db->query($sql);
				$rows = $result->fetch_all(MYSQLI_ASSOC);
				//return $rows;
				echo json_encode(['Status' => 'OK' , 'Message' => 'DataBase Create OK' , 'Data'=>$rows ]);
			}
			else
			{
				echo json_encode(['Status' => 'ERROR' , 'Message' => 'Το email που βάλατε υπάρχει ήδη']);
			}
		}
		else
		{
			http_response_code(400);
            echo json_encode(['Status' => 'ERROR' , 'Message' => 'Invalid JSON format']);
		}	
    }
	//#############################################################
	public function updateUser() 
	{
    	$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$user_id        = $data->data->user_id;
			$user_name      = $data->data->user_name;
			$user_password  = $data->data->user_password;
			$user_email     = $data->data->user_email;
			$user_type      = $data->data->user_type;
			$sql = "UPDATE users SET  user_name='$user_name' ,  user_email='$user_email' , user_password = '$user_password' , user_type = '$user_type' WHERE user_id = '$user_id' LIMIT 1";
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
	public function deleteUser($Id) 
	{
        $sql = "DELETE FROM users WHERE user_id='$Id' ";
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
    public function getUserType($Id = null) {
		 if ($Id !== null) {
			$sql = "SELECT * FROM users_type WHERE type_id = $Id";
	        $result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        } else {
			$sql = "SELECT * FROM users_type";
			$result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        }
    }
	//###########################################################################################################################
    public function LogInUser() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$email     = $data->data->user_email;
			$password  = $data->data->user_password;
			$sql = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password' ";
			$result = $this->db->query($sql);
			$rowscount = mysqli_num_rows($result);
			if ($result)
			{
				if ($rowscount >0)
				{
					$rows = $result->fetch_all(MYSQLI_ASSOC);
					echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase login OK' , 'UserData'=>$rows ]);	
				}
				else
				{
					echo json_encode(['Status' => 'ERROR' , 'Message' => 'No User Found']);
				}	
			}
		}	
		else
		{
			http_response_code(400);
            echo json_encode(['Status' => 'ERROR' , 'Message' => 'Invalid JSON format']);

		}
    }
	//###########################################################################################################################
	public function ChekSocialUser($userId = null)
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$user_id        = $data->data->user_id;
			$user_name      = $data->data->user_name;
			$user_password  = $data->data->user_password;
			$user_email     = $data->data->user_email;
			$user_type      = $data->data->user_type;

			$sql = "SELECT * FROM users WHERE user_email = '$user_email'";
			$result = $this->db->query($sql);
			if ($result)
			{
				$rows = $result->fetch_all(MYSQLI_ASSOC);
				$rowscount = mysqli_num_rows($result);
				if ($rowscount >0)
				{
					echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase login OK' , 'Data'=>$rows ]);	
				}
				else
				{
					$sql = "INSERT INTO users ( user_id,user_name ,user_password , user_email , user_type ) VALUES ( null, '$user_name','$user_password', '$user_email', '4' )";
					$result = $this->db->query($sql);
					if ($result)
					{
						$LastID = $this->db->GetLastInsertedID();
						$sql = "SELECT * FROM users WHERE user_id = $LastID";
		        		$result = $this->db->query($sql);
						$rows = $result->fetch_all(MYSQLI_ASSOC);
						//return $rows;
						echo json_encode(['Status' => 'OK' , 'Message' => 'DataBase Create OK' , 'Data'=>$rows ]);
					}
					else
					{
						echo json_encode(['Status' => 'ERROR' , 'Message' => 'DataBase Check Social User Error 1']);
					}
				}	
			}
			else
			{
				$sql = "INSERT INTO users ( user_id,user_name ,user_password , user_email , user_type ) VALUES ( null, '$user_name','$user_password', '$user_email', '4' )";
				$result = $this->db->query($sql);
				if ($result)
				{
					$LastID = $this->db->GetLastInsertedID();
					$sql = "SELECT * FROM users WHERE user_id = $LastID";
					$result = $this->db->query($sql);
					$rows = $result->fetch_all(MYSQLI_ASSOC);
					//return $rows;
					echo json_encode(['Status' => 'OK' , 'Message' => 'DataBase Create OK' , 'Data'=>$rows ]);
				}
				else
				{
					echo json_encode(['Status' => 'ERROR' , 'Message' => 'DataBase Check Social User Error 3']);
				}
			}
		}
		else
		{
			http_response_code(400);
			echo json_encode(['Status' => 'ERROR' , 'Message' => 'Invalid JSON format']);
		}
    }
    //###########################################################################################################################
		
}
?>
