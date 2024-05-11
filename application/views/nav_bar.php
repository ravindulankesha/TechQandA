<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
	<meta charset="utf-8">
	<title>TechQA</title>

	<style type="text/css">
        body{
            background-color: #B9F1DD;
            font-family: "Inria Sans", sans-serif;
        }

        .logo {
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        h1{
            font-size: 32px;
        }

        .logo img {
            width: 43px;
            height: 43px; 
        }

        .nav_panel{
            background-color: #69F845;
            height: 79px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .first_block{
            margin-top: 25px;
            display:flex;
            justify-content: space-evenly;
        }

        .intro{
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            font-size: 20px;
            background-color: #ffffff;
            border-radius: 20px;
            padding: 25px;
            width: 583px;
            height: 300px;
        }

        .buttons{
            align-items: center;
            font-size: 24px;
            display:flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        .login{
            text-align: center;
            vertical-align: middle;
            line-height: 73px;       
            background-color: #69F845;
            width: 503px;
            height: 73px;
            border-radius: 19px;
        }

        .signup{
            vertical-align: middle;
            line-height: 73px;      
            text-align: center;
            background-color: #ffffff;
            width: 503px;
            height: 73px;
            border-radius: 19px;
        }

        .search-container{
            align-items: center;
            margin-top: 25px;
            display: flex;
            justify-content: space-evenly;
        }
        
        .search{
            font-family: "Inria Sans", sans-serif;
            font-size: 24px;
            padding-left: 25px;
            border-width: 0;
            display: block;
            width: 1028px;
            height: 63px;
            border-radius: 320px;
        }

        .search_btn{
            width: 121px;
            height: 43px;
            font-family: "Inria Sans", sans-serif;
            font-size: 24px;
            display: block;
            border-width: 0;
            background-color: #69F845;
        }

        .resultsMenu{
            padding-top: 25px;
            font-size: 20px;
            display: flex;
            justify-content: space-around;
        }

        .selectMenu{
            font-family: "Inria Sans", sans-serif;
            background-color: #B9F1DD;
            font-size: 20px;
        }

        .question_content{
            padding: 25px 35px 0 35px ;
        }

        .line{
            height: 0.5px;
            background-color: black;
            border-width: 0;
        }

        .question{
            font-size: 20px;
            padding: 10px 0 20px 0;
        }

        .question_details{
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            padding-bottom: 10px;
        }

        .modal{
            padding: 5px 0 5px 0;
            border-radius: 20px;
            background-color: #69F845;
            width: 825px;
            margin: auto;
        }

        .table{
            margin: auto;
        }

        .input_area{
            border-width: 0;
            border-radius: 19px;
            font-family: "Inria Sans", sans-serif;
            font-size: 20px;
            width:497px;
            height: 73px;
        }

        .labels{
            width:122px;
        }

        .modal_head{
            font-size: 24px;
            text-align: center;
        }

        tr{
            font-size: 20px;
            height: 100px;
        }

        .btn_area{
            text-align: center;
        }

        .btn{
            width: 368px;
            border-radius: 19px;
            font-family: "Inria Sans", sans-serif;
            border-width: 0;
            height: 73px;
            font-size: 24px;
            background-color: #ffffff;
        }

        .askQ_inputs{
            width: 1110px;
        }

        .askQ_labels {
            font-family: "Inria Sans", sans-serif;
            font-size: 16px;
        }

        .inputs{
            font-family: "Inria Sans", sans-serif;
            font-size: 16px;
            width: 1110px;
            height: 40px;
            border-width: 0;
        }

        .categories{
            display: none;
        }

        .buttons_set{
            background-color: #ffffff;
            padding: 0 5px 0 5px;
            margin-right: 20px;
            font-size: 16px;
        }

        .categories:checked ~ label {
            background-color: #69F845;
        }

        .post_Q{
            width: 285px;
            border-radius: 19px;
            font-family: "Inria Sans", sans-serif;
            border-width: 0;
            height: 61px;
            font-size: 20px;
            background-color: #69F845;
        }

        .description_input{
            font-family: "Inria Sans", sans-serif;
            font-size: 16px;
            margin: 20px 0 20px 0;
            width: 1110px;
            height: 100px;
            border-width: 0;
        }

        .container{
            padding: 0 45px 0 45px;
        }

        .profile_info{
            display: flex;
            justify-content: space-between;
            font-size: 24px;
        }

        .profile_nav{
            background-color: #69F845;
            height: 79px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            font-size: 24px;
        }

        .delete{
            color: #CE3737;
            cursor: pointer;
        }

        .selectMenu_profile{
            font-family: "Inria Sans", sans-serif;
            background-color: #ffffff;
            font-size: 20px;
        }

        .profile_content{
            background-color: #ffffff;
        }

        .question_topic{
            font-size: 20px;
        }
        .q_desc{

        }
        .flex_layout{
            display: flex;
            justify-content: space-between;      
        }

        .actions{
            font-size: 14px;
            width: 400px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .vote{
            padding: 5px;
            background-color: #69F845;
        }

        .comment{
            padding: 5px;
            background-color: #D9D9D9;
        }

        .comments_panel{
            padding: 5px 30px 5px 30px;
        }

        .comments{
            display: flex;
            justify-content: space-between;
            font-size: 16px;
        }

        .pagination{
            width: 150px;
            display: flex;
            justify-content: space-between;
        }

        .tiny_font{
            font-size: 14px;
        }
	</style>
</head>
<body>
    <div class="logo">
        <div>
            <img src="<?php echo base_url(); ?>assets/icon.png" alt="Icon">
        </div>
        <div>
            <h1>TECHQ&A</h1>
        </div>
    </div>  
    
    <div class="nav_panel">
        <div id="homepage" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/Welcome'">HOME</div>
        <?php if($this->session->userdata('userID')!=null): ?> 
        <div id="profile" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/ProfileNavigation/profileQuestions'">PROFILE</div>
        <div id="askQ" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/Navigation/askQuestion'">ASK QUESTION</div>
        <div id="logout" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/Navigation/logout'">LOGOUT</div>
        <?php endif; ?>
        <div id="questionsList" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/Navigation/questionsList'">QUESTIONS LIST</div>
        <?php if($this->session->userdata('userID')==null): ?>
        <div id="login" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/Navigation/login'">LOGIN</div>
        <div id="signup" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/Navigation/signup'">SIGNUP</div>
        <?php endif; ?>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js" type="text/javascript"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js" type="text/javascript"></script>
    <script>
    </script>