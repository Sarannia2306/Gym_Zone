<?php

require'../inc/dbcon.php';

function error422($message){
    
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}

function storeCustomer($customerInput){
    
    global $conn; 
        
    $fullname = mysqli_real_escape_string($conn, $customerInput['fullname']);
    $username = mysqli_real_escape_string($conn, $customerInput['username']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $age = mysqli_real_escape_string($conn, $customerInput['age']);
    $phone_number = mysqli_real_escape_string($conn, $customerInput['phone_number']);
    $height = mysqli_real_escape_string($conn, $customerInput['height']);
    $weight = mysqli_real_escape_string($conn, $customerInput['weight']);
    $gender = mysqli_real_escape_string($conn, $customerInput['gender']);
    
    if(empty(trim($fullname))){
        
        return error422('Enter you fullname');
    }elseif(empty(trim($username))){
        
        return error422('Enter you username');    
    }elseif(empty(trim($email))){
        
        return error422('Enter you email');
    }elseif(empty(trim($age))){
        
        return error422('Enter you age'); 
    }elseif(empty(trim($phone_number))){
        
        return error422('Enter you phone_number');
    }elseif(empty(trim($height))){
     
        return error422('Enter you height');
    }elseif(empty(trim($weight))){
        
        return error422('Enter you weight');
    }elseif(empty(trim($gender))){
    
        return error422('Enter you gender');
    }
    else
    {
        $query = "INSERT INTO user_data (username, email, fullname, age, gender, height, weight, phone_number) 
                VALUES('$username', '$email', '$fullname', '$age', '$gender', '$height', '$weight', '$phone_number')";
        $result = mysqli_query($conn, $query);

        if($result){  
            $data = [
                'status' => 201,
                'message' => 'Customer Created Successfully',   
            ];
            header("HTTP/1.0 201 Created");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',   
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($data);
        }

    }
}


function getCustomerList(){
    
    global $conn;
    
    $query = "SELECT * FROM user_data";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run){
        
        if(mysqli_num_rows($query_run)> 0){
            
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            
            $data = [
                        'status' => 200,
                        'message' => 'Customer List Fetched Succesfully',  
                        'data' => $res
                    ];
            header('HTTP/1.0 200 Success');
            return json_encode($data);
     
            
        }else{
            $data = [
                        'status' => 404,
                        'message' => 'No Customer Found',   
                    ];
            header('HTTP/1.0 404 No Customer Found');
            return json_encode($data);
    
        }
        
    }
    else
    {
        $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',   
                ];
        header('HTTP/1.0 500 Internal Server Error');
        return json_encode($data);
    
    }
}

function getCustomer($customerParams){
    global $conn;
    
     if($customerParams['id'] == null){
        
        return error422('Enter your customer id');
     }
    
     $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
     
     $query = "SELECT * FROM user_data WHERE id= '$customerId' LIMIT 1";
     $result = mysqli_query($conn, $query);
     
     if($result){
         
         if(mysqli_num_rows($result) == 1)
         {
            $res = mysqli_fetch_assoc($result);
             
            $data = [
                        'status' => 200,
                        'message' => 'Customer Fetched Success',
                        'data' => $res

                    ];
            header("HTTP/1.0 200 Success");
            return json_encode($data);
         
         }
         else
         {
            $data = [
                    'status' => 404,
                    'message' => 'No Customer Found',

                ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
         }
         
     }else{
         
        $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',

                ];
         header("HTTP/1.0 500 Internal Server Error");
         return json_encode($data);
     }
}


function updateCustomer($customerInput, $customerParams)
{
    global $conn;

    if (!isset($customerParams['id'])) {
        return error422("Customer id not found in URL");
    } elseif ($customerParams['id'] == null){
        return error422("Enter the customer id");
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    $fullname = mysqli_real_escape_string($conn, $customerInput['fullname']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone_number = mysqli_real_escape_string($conn, $customerInput['phone_number']);
    $weight = mysqli_real_escape_string($conn, $customerInput['weight']);
    $height = mysqli_real_escape_string($conn, $customerInput['height']);
    $age = mysqli_real_escape_string($conn, $customerInput['age']);

    if (empty(trim($fullname))) {
        return error422('Enter your fullname');
    } elseif (empty(trim($email))) {
        return error422('Enter your email');
    } elseif (empty(trim($age))) {
        return error422('Enter your age');
    } elseif (empty(trim($phone_number))) {
        return error422('Enter your phone_number');
    } elseif (empty(trim($height))) {
        return error422('Enter your height');
    } elseif (empty(trim($weight))) {
        return error422('Enter your weight');
    }

    $query = "UPDATE user_data SET fullname='$fullname', email='$email', age='$age', height='$height', weight='$weight', phone_number='$phone_number' WHERE id='$customerId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Update successful.";

        $data = [
            'status' => 201,
            'message' => 'Customer Updated Successfully',
        ];
        header("HTTP/1.0 200 Success");
        echo json_encode($data);
    } else {
        
        echo "Update failed: " . mysqli_error($conn);

        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
}


function deleteCustomer($customerParams){
    
    global $conn;
    
    
    if (!isset($customerParams['id'])) {
        return error422("Customer id not found in URL");
    } elseif ($customerParams['id'] == null){
        return error422("Enter the customer id");
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    
    $query = "DELETE FROM user_data WHERE id= '$customerId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if($result){
        
          $data = [
            'status' => 200,
            'message' => 'Customer Deleted Successfully',
        ];
        header("HTTP/1.0 200 Deleted");
        echo json_encode($data);
        
    }else{
        
        $data = [
            'status' => 404,
            'message' => 'Customer Not Found',
        ];
        header("HTTP/1.0 404 Customer Not Found");
        echo json_encode($data);
    }
}

?>