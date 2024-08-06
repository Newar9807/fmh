<!-- PHP FOR ROOM TABLE -->
<?php
    include('include.php');
    if(isset($_POST['reset'])){
        header('location:'.ROOM);
    }
    elseif((isset($_POST['add'])) && (($_POST['price']) == "" || ($_POST['per']) == "" || ($_POST['nego']) == "" || ($_POST['room_size']) == "" || ($_POST['type']) == "" || ($_POST['furnished']) == "" || (empty('files')))){
        $_SESSION['comment'] = "<span class='fail'><center>Please fill up all boxes first</center></span>";              
        header('location:'.ROOM);
    }
    elseif(isset($_POST['add'])){
        $location = strtolower($_POST['location']);
        $location = ucwords($location);
        header('location:'.ROOM);
        $price = ($_POST['price']);
        $per = ucfirst($_POST['per']);
        if($per == ""){
            $per = "Month";
        }
        $nego = ucfirst($_POST['nego']);
        if($nego == ""){
            $nego = "Negotiable";
        }
        $room_size = ucwords($_POST['room_size']);
        if($room_size == ""){
            $room_size = "Medium";
        }
        
        $type = ucfirst($_POST['type']);
        $floor = ($_POST['floor']);
        // if
        // If the owner has flat
        
        if((($type == "Flat") && ($_POST['bhk'] == "") || ($type == "Single Room"))){
            $bhk = 1;
        }
        elseif(($type == "Flat") && ($_POST['bhk'] != "")){
            $bhk = $_POST['bhk'];
        }
        elseif($type==""){
            $type="Room";
        }
        $furnished = ucwords($_POST['furnished']);
        if($furnished == ""){
            $furnished = "Not Furnished";
        }
        // $message = strtolower($_POST['message']);
        // $message = ucfirst($message);
        // if($message == ""){
        //     $message = "It\'s not how big the house is, It\'s how happy you are ..";
        // }
        // else{
        //     $message = str_ireplace('"', '\"', $message);
        //     $message = str_ireplace("'", "\'", $message);
        // }
        $services = strtolower($_POST['services']);
        $services = ucwords($services);
        $services = str_ireplace('"', '\"',$services);
        $services = str_ireplace("'", "\'",$services);

        $latitude = $_POST['lat'];
        $longitude = $_POST['lng'];

        $conn = mysqli_connect('localhost','root','','fmh');

        $sql = "INSERT INTO `tbl_room`(`f_id`, `location`, `price`, `per`, `negotiable`, `roomSize`, `type`, `floor`, `bhk`, `furnishing`, `services`, `latitude`, `longitude`) 
        VALUES ('1', '$location', '$price', '$per', '$nego', '$room_size', '$type', '$floor', '$bhk', '$furnished', '$services', '$latitude', '$longitude')
        ";

        $res = mysqli_query($conn, $sql) ;

        if($res == true){
                // mysqli_close($conn);
                //Stores the user images in upload folder
                $targetDir = "uploads/"; 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                
                $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
                $fileNames = array_filter($_FILES['files']['name']);
                if(!empty($fileNames)){ 
                    //Get Max. primary key from room table
                    $conn = mysqli_connect('localhost', 'root', '', 'fmh');

                    $sql = "SELECT MAX(`r_id`) AS 'Thulo' FROM `tbl_room`";

                    $res = mysqli_query($conn, $sql);

                    $max = mysqli_fetch_array($res);


                    // mysqli_close($conn);

                    foreach($_FILES['files']['name'] as $key=>$val){ 
                        // File upload path 
                        $fileName = basename($_FILES['files']['name'][$key]); 
                        $targetFilePath = $targetDir . $fileName; 
                        
                        // Check whether file type is valid 
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                        if(in_array($fileType, $allowTypes)){ 
                            // Upload file to server 
                            if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                                // Image db insert sql 
                                $insertValuesSQL .= "(".($max[0]).",'uploads/".$fileName."'),"; 
                            }else{ 
                                // $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                                mkdir("uploads");
                                move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);
                                $insertValuesSQL .= "(".($max[0]).",'uploads/".$fileName."'),"; 
                            } 
                        }else{ 
                            $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
                        } 
                    } 
                    
                    // Error message 
                    $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                    $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                    $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                    
                    if(!empty($insertValuesSQL)){ 
                        $insertValuesSQL = trim($insertValuesSQL, ','); 
                        $db = new mysqli('localhost', 'root', '', 'fmh');
                        if($db->connect_error){
                            die("Image DB Connection Failed".$db->connect_error);
                        }
                        // Insert image file name into database
                        $insert = $db->query("INSERT INTO `tbl_img`(`r_id`, `image`) VALUES $insertValuesSQL");
                        if($insert){ 
                            $passMsg = "all "; 
                        }else{
                            $statusMsg = "<span class='fail'><center>Sorry, there was an error uploading your file</center></span><br>"; 
                            $_SESSION['comment'] = $statusMsg;
                            header('location:'.HOME);
                        } 
                        mysqli_close($db);
                    }else{ 
                        $statusMsg = "<span class='fail'><center>Upload failed! ".$errorMsg."</center></span><br>"; 
                        $_SESSION['comment'] = $statusMsg;
                        header('location:'.HOME);
                    } 
                }else{ 
                    $statusMsg = "<span class='fail'><center>Please select a image to upload</center></span><br>"; 
                    $_SESSION['comment'] = $statusMsg;
                    header('location:'.ROOM);
                }
                $statusMsg = "<span class='success'><center>Your ".$passMsg."details have been submitted to Database</center></span><br>";
                $_SESSION['ownerComment'] = $statusMsg;
                header('location:'.HOME);
        }
        else{
            $statusMsg = "<span class='fail'><center>Error in Query</center></span><br>";
            $_SESSION['comment'] = $statusMsg;
            header('location:'.ROOM);
        }
    }
?>