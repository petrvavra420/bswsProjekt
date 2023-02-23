<?php
include_once("dbcon.php");

?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="css/sqlTerminal.css">
</head>


<div class="console">
    <div id="consoleContent" class="consoleContent"></div>
    <div class="consoleFlex">
        <input id="consoleInput" type="text" class="consoleInput">
        <button onclick="changeContent()" class="consoleBtn">Odeslat dotaz</button>
    </div>
</div>
<script>
    function changeContent() {
        var inputText = document.getElementById("consoleInput");
        var text = inputText.value;
        var para = document.createElement("p");
        var cons = document.getElementById("consoleContent");
        para.innerHTML = text;
        cons.append(para);
        console.log(text);
        $.ajax({
            url: 'controlPanelPages/mysql/handleQuerry.php',
            type: 'post',
            data: {sql: text},
            success: function (response) {
                var paraResponse = document.createElement("p");
                paraResponse.innerHTML = response;
                cons.append(paraResponse);
                console.log("odpoved: " + response);
                var elem = document.getElementById('consoleContent');
                elem.scrollTop = elem.scrollHeight;
            }
        });


    }
</script>

