<?php
    echo "The process has begun ...";
    $fn = fopen("file.txt","r"); // open the file 
    $data = [];
    while(! feof($fn))  { // read the file by lines
        $result = fgets($fn);
        array_push($data, $result); // store the lines in array 
    }
    fclose($fn); // close file
    $parameter = explode(" ",$data[0]); // create an array from parameter
    $m1 = $parameter[0];
    $m2 = $parameter[1];
    $n = $parameter[2];
    $inst1 = trim(preg_replace('/\s\s+/', '', $data[1])); // erase the eol from the instruntion
    $inst2 = trim(preg_replace('/\s\s+/', '', $data[2])); // erase the eol from the instruntion
    $message = $data[3];


    $char = "-"; // init the character from compartion
    $clearMessage = "";
    for($i = 0; $i < strlen($message); $i++){ // erase the duplicate characters 
        if($message[$i] != $char){
            $char = $message[$i];
            $clearMessage .= $message[$i];
        }
    }
    $txt = "";
    $myfile = fopen("result.txt", "w") or die("Unable to open file!"); // open or create the response.txt file
    if(strlen($inst1) != $m1){ // validate the length of the first instruction
        fwrite($myfile, "NO\r\n"); // write no if they not match
    }else{
        $pos = strpos($clearMessage, $inst1); // search for the command 
        $txt = $pos === false ? 'No': 'Si';  // validate if there is an instruction
        fwrite($myfile, $txt."\r\n"); // write the answer
    }
    if(strlen($inst2) != $m2){ // validate the length of the second instruction
        fwrite($myfile, "NO\r\n"); // write no if they not match
    }else{
        $pos = strpos($clearMessage, $inst2);
        $txt = $pos === false ? 'No': 'Si'; // validate if there is an instruction
        fwrite($myfile, $txt."\r\n"); // write the answer
    }
    
    fclose($myfile); // close file
    echo "<br>The process had ended ..."
?>