<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
    // 정보를 가져옴
    $myBoardID = $_POST['myBoardID'];
    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $youPass = $_POST['youPass'];
    $myMemberID = $_SESSION['myMemberID'];

    // 특수기호 방지
    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);

    //모든 정보를 서버에 보냄
    $sql = "SELECT youPass, myMemberID FROM myMember WHERE myMemberID = {$myMemberID}";
    $result = $connect -> query($sql);

    // 정보를 쪼개서 memberInfo에 저장
    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

    // 각각의 정보가 맞는지 검사
    if($memberInfo['youPass'] === $youPass && $memberInfo['myMemberID'] === $myMemberID){
        $sql = "UPDATE myBoard SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}' WHERE myBoardID = '{$myBoardID}'";
        
        //변경/수정한 데이터를 보낼때는 하단의 문구를 써 sql 테이블로 보내야함
        $connect -> query($sql);
    } else {
        echo "<script>alert('비밀번호가 일치하지 않습니다. 다시 한번 확인해주세요!!')</script>";
    }
?>
<script>
    location.href = "board.php";
</script>


</body>
</html>