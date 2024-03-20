<?php
require_once 'database/DataBase.php';

class MovieController {
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
    public function getMovie($id = null) {
	    if ($id !== null) {
			$sql = "SELECT * FROM movies WHERE movie_id = $id";
	        $result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        } else {
			$sql = "SELECT * FROM movies";
			$result = $this->db->query($sql);
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			echo json_encode(['Status' => 'OK' ,'Message' => 'DataBase Get OK' , 'Data'=>$rows ]);
        }
    }
	//#############################################################
    public function addMovie() 
	{
		$postdata  = file_get_contents("php://input");
		$moviedata = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$movie_title1   = $moviedata->data->movie_title1;
			$movie_title2   = $moviedata->data->movie_title2;
			$movie_image    = $moviedata->data->movie_image;
			$movie_category = $moviedata->data->movie_category;
			$movie_description = $moviedata->data->movie_description;
			$movie_duration = $moviedata->data->movie_duration;
			$movie_youtube  = $moviedata->data->movie_youtube;
			$movie_director = $moviedata->data->movie_director;
			$movie_script   = $moviedata->data->movie_script;
			$movie_actors   = $moviedata->data->movie_actors;
			
			$sql = "INSERT INTO movies ( movie_id, movie_title1 , movie_title2 , movie_image , movie_category , movie_description , movie_duration , movie_youtube , movie_director , movie_script , movie_actors) VALUES 
			( null, '$movie_title1', '$movie_title2' , '$movie_image' , '$movie_category' , '$movie_description' , '$movie_duration' , '$movie_youtube' , '$movie_director' , '$movie_script' , '$movie_actors' )";
			$result = $this->db->query($sql);
			if ($result)
			{
				$LastID = $this->db->GetLastInsertedID();
				$sql = "SELECT * FROM movies WHERE movie_id = $LastID";
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
	public function updateMovie() 
	{
		$postdata  = file_get_contents("php://input");
		$data = json_decode($postdata);
		if(isset($postdata) && !empty($postdata))
		{
			$movie_id       = $data->data->movie_id;
			$movie_title1   = $data->data->movie_title1;
			$movie_title2   = $data->data->movie_title2;
			$movie_image    = $data->data->movie_image;
			$movie_category = $data->data->movie_category;
			$movie_description = $data->data->movie_description;
			$movie_duration = $data->data->movie_duration;
			$movie_youtube  = $data->data->movie_youtube;
			$movie_director = $data->data->movie_director;
			$movie_script   = $data->data->movie_script;
			$movie_actors   = $data->data->movie_actors;

			$sql = "UPDATE movies SET movie_title1='$movie_title1' , movie_title2 = '$movie_title2' , movie_image = '$movie_image' ,
						              movie_category='$movie_category' , movie_description = '$movie_description' , movie_duration = '$movie_duration' ,
			                          movie_youtube='$movie_youtube' , movie_director = '$movie_director' , movie_script = '$movie_script' ,
									  movie_actors='$movie_actors'  WHERE movie_id = '$movie_id' LIMIT 1";
									  
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
	public function deleteMovie($userId) {
       
    }
	//###########################################################################################################################
		
}
?>
