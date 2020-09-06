<?php
    require('../app/functions.php');
    $setNumber = filter_input(INPUT_GET,'setNumber');
    $marks = $_POST['marks'];
    $numbers = $_POST['numbers'];
    if($setNumber){
        
    }else{
        $setNumber = $_POST['setNumber'];
    }
    $addCount = (int)$_POST['countPlay'];
    $countPlay = 1+$addCount;
    $deck=1+$_POST['deck'];
    $countClear = 0;
    $beforeCard;
    $answer= $_POST['answer'];
    if($countPlay === 1){
        $cards = cardSet();
    }else{
        $cards = makeCards($marks,$numbers);
        $trashCard = $_POST['trashCard'];
        $beforeMark = $_POST['beforeMark'];
        $beforeNumber =$_POST['beforeNumber'];
        $beforeCard = ['mark'=>$beforeMark,'number'=>$beforeNumber];
    }
    
    $nowCard = $cards[$countPlay-1];
    $winCount = 0 + $_POST['winCount'];
    if($countPlay > 1){
        $battle = battle((int)$beforeCard['number'],(int)$nowCard['number']);
        $answer = $_POST['answer'];
        $lossOrWin = judge($answer,$battle);
    }
    if($lossOrWin === "Win"){
        $winCount ++;
    }else{
        $winCount = 0;
    }
    array_push($trashCard, $nowCard);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>挑戦中-連続High&Lowゲーム</title>
    <link rel="stylesheet" href="../css/game.css">
</head>

<body>
    <header>
        <h1>High&Lowゲーム</h1>
        <p>ハイレベル</p>
    </header>


    <div class="container">
        <div class="announce">
    
    <?php
    if($lossOrWin){
        if ($lossOrWin === "Win"){
         echo '<p class="right">正解！！</p>';
        }else{
            echo '<p class="sorry">ドンマイ</p>';
        }
    }
    
    if ($setNumber <= $winCount){
        echo '<fieldset><p class="pass">👑クリア👑</p>';
        echo  '<form action="../index.html"><p><input type="submit" class="btn" value="メニューに戻る"></p></form>';
        echo  '<form action="game.php" method="get"><p><input type="submit" class="btn" value="次の人がやる"></p><p><input type="hidden" name="setNumber" value="'.$setNumber.'"></p></form></fieldset>';
    } else if ($setNumber >= 52-$countPlay){
        echo  '<form action="game.php" method="get"><p><input type="submit" class="btn" value="山札をシャッフルする"></p><p><input type="hidden" name="setNumber" value="'.$setNumber.'"></p><p><input type="hidden" name="deck" value="'.$deck.'"></p></form>';
    }
    
   
    
    ?>
    
        </div>
        
            
            <p class="deck">🃏<?php echo $deck;?>束目：残り<?php echo 52-$countPlay; ?>枚</p>
        
        <div class="field">
        <p class="now"><?php echo $setNumber; ?>枚で挑戦中</p>
            <h2>〜フィールド〜</h2>
            <p class="nowCardInfo"><?php 
            if($winCount > 0){
                echo $winCount.'回連続正解中';
            }
            ?>
            </p>
            <div class="card">
                <div class="open">
                <img src="../img/<?php echo translationUrl($nowCard) ?>.png" alt="現在のカード">
                </div>
                <div class="next">
                    <img src="../img/card-back.png" alt="次のカード">
                </div>

            </div>
        </div>    
            
        <div class="answer">
            <fieldset>
                <legend>次に来るのは？</legend>
                <form action="game.php" method="post" class="answerform">
                    
                        <input type="submit" name="answer" value="High" class="bluebtn">
                    
                    <p>
                        <input type="submit" name="answer" value="Dlow" class="bluebtn">
                    </p>
                    <p>
                        <input type="submit" name="answer" value="Low" class="bluebtn">
                    </p>
                    <p>
                    <input type="hidden" name="countPlay" value="<?php echo $countPlay ?>">
                    <input type="hidden" name="setNumber" value="<?php echo $setNumber ?>">
                    <input type="hidden" name="beforeMark" value="<?php echo $nowCard['mark'] ?>">
                    <input type="hidden" name="beforeNumber" value="<?php echo $nowCard['number'] ?>">
                    <input type="hidden" name="winCount" value="<?php echo $winCount ?>">
                    <?php

                    for($i = 0;$i <= count($cards);$i++){
                        echo '<input type="hidden" name="marks[]" value="'.$cards[$i]['mark'].'">';
                        echo '<input type="hidden" name="numbers[]" value="'.$cards[$i]['number'].'">';
                    }

                    ?>
                    </p>
                </form>
            </fieldset>
        </div>
        <div class="history">
            <h2>ここまで出たカードを見る</h2>
            <p>〜Coming soon〜</p>
            <p>この機能は近日公開予定です。</p>
            <!-- <table border="1">
                <tr>
                    <th>数字</th>
                    <th>枚数</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>○枚</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>○枚</td>
                </tr>
            </table> -->
        </div>
        <form action="../index.html">
            <p>
                 <input type="submit" class="btn" value="メニューに戻る">
            </p>
        </form>
    </div>
    <footer></footer>

</body>

</html>