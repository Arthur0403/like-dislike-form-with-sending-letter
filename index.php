<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Like/dislike</title>
    <style>
        .feedback-module{
            border: 1px solid black;
            width: 860px;
        }
        .like-dislike{
            margin: 0 auto;
            width: 300px;
        }
        button{
            margin: 10px;
        }

        .like-form, .dislike-form{
            width: 700px;
            margin: 10px auto;
            text-align: justify;
            display: none;
        }

        /* .like-form{
            background-color: lightgreen;
        } */

        /* .dislike-form{
            background-color: lightcoral;
        } */

        .block{
            display: block !important;
        }
        .unblock{
            display: none;
        }

        * {
            font-family: MagistralCTT, sans-serif;
        }

        .like-form p {
            margin: -10px 0;
        }

        .elegant-aero {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-left: auto;
            margin-right: auto;
            margin-top: 25px;
        }

        .elegant-aero .form-control {
            width: 340px;
            height: 100px;
            margin: 10px 20px 10px 0;
        }

        .elegant-aero .form {
            margin: 10.5px 0;
            width: 330px;
            height: 36px;
        }

        .elegant-aero .form-block {
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
        }

        .button {
            width: 100%;
            height: 30px;
            background: #d0ec99;
            border-radius: 10px;
            border: 2px solid #bee05c;
        }

        .button-click {
            width: 120px;
            height: 30px;
            background: #d0ec99;
            border-radius: 5px;
            border: 2px solid #bee05c;
        }

        .dislike {
            background: #dadada;
            border: 2px solid #bebebe;
        }

        .ar_form {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            width: 700px;
            height: 180px;
            margin: 10px auto;
        }

        .ar_form .ar_radios {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .ar_form .ar_radios .ar_radio_label {
            width: 700px;
        }

        .ar_form .ar_radios .ar_radio {
            margin-right: 5px;
        }

        .review {
            display: none;
            width: 700px;
            height: 80px;
            padding: 40px;
            margin: auto;
            background: #d0ec99;
            border: 5px solid #bee05c;
            border-radius: 15px;
            text-align: center;
        }

        .error{
            border: 2px solid red;
        }

    </style>
</head>
<body>
<script>
    (function(){
        window.onload = function(){
            let likeDislike = document.querySelector('.like-dislike');
            let likeForm = document.querySelector('.like-form');
            let disLikeForm = document.querySelector('.dislike-form');
            let thank =  document.querySelector('.review');
            let feedbackModule = document.querySelector('.feedback-module');

            /* Object with all buttons */
            let buttons = {
                likeButton: document.querySelector('.like'),
                dislikeButton: document.querySelector('.dislike'),
                likeFormButton: document.querySelector('.send-button-good'),
                dislikeFormButton: document.querySelector('.send-button-bad')
            };


            /* Like/dislike form function */
            (buttons.likeButton).addEventListener('click', function(event){
                event.preventDefault();
                likeForm.classList.add('block');
                likeDislike.classList.add('unblock');
            });

            (buttons.dislikeButton).addEventListener('click', function(event){
                event.preventDefault();
                disLikeForm.classList.add('block');
                likeDislike.classList.add('unblock');
            });

            /* Like form function */
            (buttons.likeFormButton).addEventListener('click', function(event){
                event.preventDefault();

                    let userMessage = document.querySelector('.form-textarea').value;
                    let userName = document.querySelector('.form-name').value;
                    let userMail = document.querySelector('.form-email').value;
                    let likeIndicator = "LikeForm";

                    if(!userMail){
                        event.preventDefault();
                        document.querySelector('.form-email').classList.add('error');
                    }else{
                        thank.classList.add('block');
                        feedbackModule.classList.add('unblock');

                        let xhr = new XMLHttpRequest();

                        xhr.open('POST', 'index.php');
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.send("name=" + encodeURIComponent(userName) + "&mail=" + encodeURIComponent(userMail) + "&message=" + encodeURIComponent(userMessage) + "&indicator=" + encodeURIComponent(likeIndicator));// Отправляем POST-запрос
                        xhr.onreadystatechange = function() { // Ждём ответа от сервера
                            if (xhr.readyState == 4) { // Ответ пришёл
                                if(xhr.status == 200) { // Сервер вернул код 200 (что хорошо)
                                    console.log('Success');
                                    console.log(userMail);

                                }
                            }
                        };
                    }


            });

            (buttons.dislikeFormButton).addEventListener('click', function(event){
                event.preventDefault();
                thank.classList.add('block');
                feedbackModule.classList.add('unblock');

                let noInform= document.getElementById('ratearticle_notrated_response_1');
                let noQuestion = document.getElementById('ratearticle_notrated_response_2');
                let stupid = document.getElementById('ratearticle_notrated_response_3');
                let dislikeIndicator = "DislikeForm";

                let xhr = new XMLHttpRequest();

                xhr.open('POST', 'index.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send("noInform=" + encodeURIComponent(noInform.checked) + "&noQuestion=" + encodeURIComponent(noQuestion.checked) + "&stupid=" + encodeURIComponent(stupid.checked) + "&indicator=" + encodeURIComponent(dislikeIndicator));// Отправляем POST-запрос
                xhr.onreadystatechange = function() { // Ждём ответа от сервера
                    if (xhr.readyState == 4) { // Ответ пришёл
                        if(xhr.status == 200) { // Сервер вернул код 200 (что хорошо)
                            console.log('Success');

                        }
                    }
                };
            });

            document.querySelector('.cross').addEventListener('click', function (event) {
                event.preventDefault();
                thank.classList.remove('block');

            });

        };
    })();
</script>
<div class="feedback-module">
    <div class="like-dislike">
        <button class="like button-click">Like</button>
        <button class="dislike button-click">Dislike</button>
    </div>
    <div class="like-form">
        <h2>Отлично!</h2>
        <p>Если у вас есть минутка, расскажите нам, что вам больше всего помогло в этой статье.</p>
        <form name="exampleForm" class="elegant-aero" method="POST">
            <div class="form-block">
                <textarea type="text" name="userMessage" class="form-control form-textarea" rows="4" ng-model="message" ng-minlength="10" ng-maxlength="100" placeholder="Напишите свой отзыв здесь..." required></textarea>
                <div ng-messages="exampleForm.userMessage.$error">
                    <!-- <div ng-message="required">Это поле обязательно к заполнению</div> -->
                </div>
            </div>
            <div class="form-block">
                <input type="text" name="userFirstName" class="form form-name" ng-model="firstName"  placeholder="Имя" required />
                <div ng-messages="exampleForm.userFirstName.$error">
                    <!-- <div ng-message="required">Это поле обязательно к заполнению</div> -->
                </div>
                <!-- сделать чтобы почта была не обязательна -->
                <input type="email" name="userEmail" class="form form-email" ng-model="email" placeholder="Email(Обязательно)" required />
                <div ng-messages="exampleForm.userEmail.$error">
                    <!-- <div ng-message="email">Ваш адрес электронной почты недействителен</div> -->
                </div>
            </div>
            <div class="button">
                <input class="button send-button-good" type="button" value="ОТПРАВИТЬ ОТЗЫВ">
            </div>
        </form>
    </div>
    <div class="dislike-form">
        <h2>Приносим извинения. :(</h2>
        <p>Что случилось?</p>
        <form class="ar_form" id="ar_form_radios">
            <div class="ar_radios">
                <label for="ratearticle_notrated_response_1" class="ar_radio_label">
                    <input type="radio" class="ar_radio" name="ar_radio" id="ratearticle_notrated_response_1" value="ratearticle_notrated_response_1" checked>Статья не информационная.</label>
                <label for="ratearticle_notrated_response_2" class="ar_radio_label">
                    <input type="radio" class="ar_radio" name="ar_radio" id="ratearticle_notrated_response_2" value="ratearticle_notrated_response_2">Статья не ответила на мой вопрос.</label>
                <label for="ratearticle_notrated_response_3" class="ar_radio_label">
                    <input type="radio" class="ar_radio" name="ar_radio" id="ratearticle_notrated_response_3" value="ratearticle_notrated_response_3">Это глупая тема или статья.</label>
            </div>
            <input type="submit" class="button send-button-bad" value="ОТПРАВИТЬ">
        </form>
    </div>
</div>

<div class="review">
    <p>Спасибо за отзыв!</p>
    <a href="#" class="cross">X</a>
</div>

<!--<p id="output"></p>-->
<?php
//xhr.send("noInform=" + encodeURIComponent(noInform.checked) + "&noQuestion=" + encodeURIComponent(noQuestion.checked) + "&stupid=" + encodeURIComponent(stupid.checked) + "&indicator" + encodeURIComponent(dislikeIndicator));// Отправляем POST-запрос
if ($_REQUEST['indicator'] === 'LikeForm'){
    $URI = $_SERVER['REQUEST_URI'];
    $name = $_REQUEST['name'];
    $mail = $_REQUEST['mail'];
    $feedback = $_REQUEST['message'];
    $likeIndicator = $_REQUEST['indicator'];

    echo $name.' '.$mail.' '.$feedback . ' ' . $URI;

    $message = 'Who:' . $name.' From:'.$mail.' Message:'. $feedback . ' Page url:' . $URI;

    mail('lobanovartur1989@gmail.com', $likeIndicator, $message, 'From: yarus-market.ru');
}else if($_REQUEST['indicator'] === 'DislikeForm'){
    $baduri = $_SERVER['REQUEST_URI'];
    $noInform = $_REQUEST['noInform'];
    $noQuestion = $_REQUEST['noQuestion'];
    $stupid = $_REQUEST['stupid'];
    $dislikeIndicator = $_REQUEST['indicator'];

    $message = 'Статья не информационная:' .$noInform.' Статья не ответила на мой вопрос:'.$noQuestion.' Это глупая тема или статья:'.$stupid . ' Page url:' . $baduri;
    mail('lobanovartur1989@gmail.com', $dislikeIndicator, $message, 'From: yarus-market.ru');
}


?>
</body>
</html>
