<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
?>

    <div class="container">
        <div class="profile_info">
            <div>Ravindu</div>
            <div>joined: 2022/09/11</div>
            <div class="delete">Delete Profile</div>
        </div>
        <div class="profile_nav">
            <div id="profileQ" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/ProfileNavigation/profileQuestions'">Questions asked</div>
            <div id="profileA" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/ProfileNavigation/profileAnswers'">Your answers</div>
            <div id="profileC" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/ProfileNavigation/profileComments'">Your Comments</div>
        </div>

        <div class="profile_content">

