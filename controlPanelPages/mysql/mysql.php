<?php
ob_start();
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
    var paraInit = document.createElement("p");
    var paraInit = document.createElement("p");
    var consInit = document.getElementById("consoleContent");
    paraInit.innerHTML = "Vítá Vás konzole PitrShell 1.0 <br> Pro zadání příkazů použijte textové pole dole a tlačítko 'Odeslat dotaz'."
    consInit.append(paraInit);

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
            type: 'POST',
            data: {sql: text},
            success: function (response) {
                var paraResponse = document.createElement("p");
                paraResponse.innerHTML = response;
                cons.append(paraResponse);
                console.log("odpoved: " + response);
                var elem = document.getElementById('consoleContent');
                elem.scrollTop = elem.scrollHeight;
                inputText.value = "";
            },
            error: function(){
                var paraResponse1 = document.createElement("p");
                var response = "Špatný SQL požadavek, zkontroluj dotaz.";
                paraResponse1.innerHTML = response;
                cons.append(paraResponse1);
            }
        });



    }
</script>

