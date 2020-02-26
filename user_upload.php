<html>
    <head>
        <meta charset="utf-8">
        <title> 지수 </title>
    </head>
    <body>
    <?php
        include './func.php';
        //$id = $_COOKIE['UserID'];
        $id = 'admin';
        $text = $_POST['textupload'];
        $food_no = 1;
        
        if (!$_COOKIE[UserID]){
            echo("
                <script>
                window.alert('로그인 후 댓글을 작성해주세요.')
                history.go(-1)
                </script>
            ");
            exit;
        }
            
        $con = mysqli_connect("localhost","rotation","sky0830*","rotation");

        mysqli_query($con, "set session character_set_connection=utf8;");
        mysqli_query($con, "set session character_set_results=utf8;");
        mysqli_query($con, "set session character_set_client=utf8;");

        $result = mysqli_query($con, "select * from food_reply where food_no=$food_no order by re_no");
        $total = mysqli_num_rows($result);
        $wdate = date("Y-m-d");	//   글 쓴 날짜 저장
        // 댓글에 대한 id부여
        if (!$total){
            $reid = 1;
        } else {
            $reid = $total + 1;
        }
        
        function upload_text(){
            mysqli_query($con, "insert into food_reply(food_no, re_no, re_time, re_comment, re_writer) values($food_no, $reid, '$wdate', '$text' , $id)");
        }
        
        function upload_img(){
            mysqli_query($con, "insert into food_reply(food_no, re_no, re_time, re_comment, re_img, re_writer) values($food_no, $reid, '$wdate', '$text', '$myFile', $id)");
        }

        var_dump($_FILES);
        $date = date("Y.m.d_his");
        $name = $id.'_'.$date;
//        $_FILES['myImage']['type'];
//        $_FILES['myImage']['tmp_name'];
    
        //임시 저장된 정보
        $myTempFile = $_FILES['fileToUpload']['tmp_name'];
    
        //파일 타입 및 확장자 구하기
        $fileTypeExtension = explode("/",$_FILES['fileToUpload']['type']);
    
        //파일 타입
        $fileType = $fileTypeExtension[0];
    
        //파일 확장자
        $extension = $fileTypeExtension[1];
    
        //이미지 파일이 맞는지 확인
        if($fileType == 'image'){
            //확장자를 jpg, bmp, gif, png
            if($extension == 'jpeg' || $extension == 'bmp' || $extension == 'gif' || $extension == 'png'){
                //임시 파일 옮길 저장 및 파일명 
                $myFile = './img_user/'.$name.'.'.$extension;
                //임시 저장된 파일을 우리가 저장할 장소 및 파일명으로 옮김
                $imageUpLoad = move_uploaded_file($myTempFile,$myFile);
                
                //업로드 성공 여부 확인
                if($imageUpLoad == true){
                    echo "파일이 정상적으로 업로드 되었습니다.";
                    echo "<img src ='{$myFile}' width='300' />";
                    upload_img();
                } else {
                    echo "파일이 업로드에 실패했습니다.";
                }
            }
            //확장자가 jpg, bmp, gif, png가 아닌 경우
            else {
                echo "허용하는 확장자 이미지 파일이 아닙니다.";
                exit;
            }
        }
        //type이 image가 아닌경우 
        else {
            echo "이미지 파일이 아닙니다.";
            exit;
        }
    ?>
    </body>
</html>