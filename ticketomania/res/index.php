<?php
//header("Content-Type: application/json");   // ????
//header("Access-Control-Allow-Origin: *");
require_once 'controllers/UserController.php';
require_once 'controllers/FileController.php';
require_once 'controllers/MovieController.php';
require_once 'controllers/CinemaHallController.php';
require_once 'controllers/CinemaShowsController.php';
require_once 'controllers/ReservationController.php';


// Extract the clean URL path
$request_path = trim($_SERVER['REQUEST_URI'], '/');
$path_segments = explode('/', $request_path);
//echo getcwd() . "\n";
//print_r($path_segments);
$pos = strpos(getcwd(),$path_segments[0]);
if ($pos !== false) { array_shift($path_segments);}
//print_r($path_segments);
// Route based on the first segment of the path
$FirstPathSegment=1;
$SecondPathSegment=2;

$endpoint = isset($path_segments[$FirstPathSegment]) ? $path_segments[$FirstPathSegment] : '';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ($endpoint === 'user') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
			$userController = new UserController();
            $userController->getUser($Id);
        } 
		elseif ($endpoint === 'usertype') {
			$Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
			$userController = new UserController();
			$userController->getUserType($Id);
		}
		elseif ($endpoint === 'movie') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
			$movieController = new MovieController();
            $movieController->getMovie($Id);
        } 
		else if ($endpoint === 'login') {
            $userController->LogInUser();
        }
		else if ($endpoint === 'moviesphotonames') {
            $fileController = new FileController();
			$fileController->GetMoviesPhotoNames();
        }
        else if ($endpoint === 'cinemahall') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
            $CinemaHallController = new CinemaHallController();
			$CinemaHallController->GetCinemaHalls($Id);
        }
        else if ($endpoint === 'show') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
            $CinemaShowsController = new CinemaShowsController();
			$CinemaShowsController->GetCinemaShows($Id);
        }
        else if ($endpoint === 'showbymovie') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
            $CinemaShowsController = new CinemaShowsController();
			$CinemaShowsController->GetCinemaShowsByMovie($Id);
        }
        else if ($endpoint === 'reservation') {
          $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
          $ReservationController = new ReservationController();
          $ReservationController->GetReservation($Id);
      }
      else if ($endpoint === 'myreservation') {
        $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
        $ReservationController = new ReservationController();
        $ReservationController->GetMyReservation($Id);
    }
      else if ($endpoint === 'checkreservationfromphone') {
        $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
        $ReservationController = new ReservationController();
        $ReservationController->CheckReservationByPhone($Id);
    }
      else {
            http_response_code(404);
			echo json_encode(['Status' => 'ERROR' , 'Message' => 'Endpoint not found']);
      }
    break;
    case 'POST':
		if ($endpoint === 'user') {
		    $userId = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null; 
			$userController = new UserController();
            $userController->createUser();
        } 
		else if ($endpoint === 'movie') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
			$movieController = new MovieController();
            $movieController->addMovie();
        } 
		else if ($endpoint === 'login') {
		    $userController = new UserController();
            $userController->LogInUser();
        }
		else if ($endpoint === 'upload') {
            $fileController = new FileController();
			$fileController->uploadFile();
        }
        else if ($endpoint === 'cinemahall') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
            $CinemaHallController = new CinemaHallController();
			      $CinemaHallController->addHall();
        }
        else if ($endpoint === 'show') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
            $CinemaShowsController = new CinemaShowsController();
			$CinemaShowsController->addShow();
        }
        else if ($endpoint === 'reservation') {
          $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
          $ReservationController = new ReservationController();
          $ReservationController->addReservation();
       }
       else if ($endpoint === 'checksocialuser') {
          $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
          $userController = new UserController();
          $userController->ChekSocialUser();
       }
       else {
            http_response_code(404);
			echo json_encode(['Status' => 'ERROR' , 'Message' => 'Endpoint not found']);
        }
    break;
	case 'PUT':
        if ($endpoint === 'user') {
		    $userController = new UserController();
			$userController->updateUser();
        }
        elseif ($endpoint === 'movie') {
			$movieController = new MovieController();
            $movieController->updateMovie();
        } 
        else if ($endpoint === 'cinemahall') {
            $CinemaHallController = new CinemaHallController();
			$CinemaHallController->updateHall();
        }
        else if ($endpoint === 'show') {
            $Id = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
            $CinemaShowsController = new CinemaShowsController();
			$CinemaShowsController->updateShow();
        }
        else if ($endpoint === 'checkreservation') {
            $ReservationController = new ReservationController();
            $ReservationController->CheckReservation();
        }
        else if ($endpoint === 'cancelreservation') {
            $ReservationController = new ReservationController();
            $ReservationController->CancelReservation();
        }
        else {
            http_response_code(404);
			echo json_encode(['Status' => 'ERROR' , 'Message' => 'Endpoint not found']);        
        }
    break;	
	case 'DELETE':
        if ($endpoint === 'user') {
		    $userController = new UserController();
		    $userId = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
            $userController->deleteUser($userId);
        } 
        
        else if ($endpoint === 'cinemahall') {
            $CinemaHallController = new CinemaHallController();
            $hallID = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
			$CinemaHallController->deleteHall($hallID);
        }
        if ($endpoint === 'show') {
		    $CinemaShowsController = new CinemaShowsController();
		    $showId = isset($path_segments[$SecondPathSegment]) ? $path_segments[$SecondPathSegment] : null;
            $CinemaShowsController->deleteshow($showId);
        } 
        
        else {
            http_response_code(404);
      		echo json_encode(['Status' => 'ERROR' , 'Message' => 'Endpoint not found']);
        }
    break;
    default:
        http_response_code(405);
		echo json_encode(['Status' => 'ERROR' , 'Message' => 'Method Not Allowed']);
        break;
}
?>
