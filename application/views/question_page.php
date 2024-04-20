<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
include("searchbar.php");
?>
<div class="container">
    <p class="question_topic">Fatal Error: Allowed Memory Size of 134217728 Bytes Exhausted</p>
    <p class="q_desc">I am trying to add HWIOAuthBundle to my project by running the below command.
composer require hwi/oauth-bundle php-http/guzzle6-adapter php-http/httplug-bundle
HWIOAuthBundle github: https://github.com/hwi/HWIOAuthBundle
 then I try to run composer require I am getting the out of memory error.</p>
    <div class="flex_layout">
        <div>Posted on</div>
        <div>Category</div>
        <div>Posted By</div>
        <div class="actions">
            <div class="comment">comment</div>
            <div class="vote">upvote</div>
            <div>34</div>
            <div class="vote">downvote</div>
        </div>
        
    </div>
    <div class="comments_panel">
        <div class="comments">
            <div>Comments</div>
            
            <div class="pagination">
                <div>previous</div>
                <div>next</div>
            </div>
        </div>
        <hr class="line">
        <p class="tiny_font">Have you done a composer self-update lately? Not sure if the 1.4.2 in your error message indicates version 1.4.2 but the latest version of composer is 1.6.2. And how much physical memory do you have? Is it a vm or cloud server? - robinwilliams87</p>
    </div>
    <div class="main_block">
        <div class="sub_block">
            <div>Answers: 13</div>
            <div>SORT BY:
                <select class="sorter">
                    <option value="1">Newest</option>
                    <option value="2">Oldest</option>
                    <option value="3">highest Votes</option>
                    <option value="4">Lowest Votes</option>
                </select>
            </div>
        </div>
        <div class="sub_block">
            <div><textarea cols="40" rows="3" name="q_desc" class="submit_comment"></textarea></div>
            <div class="vote">submit answer</div>
        </div>
            <hr class="line">
            <p class="q_desc">I am trying to add HWIOAuthBundle to my project by running the below command.
    composer require hwi/oauth-bundle php-http/guzzle6-adapter php-http/httplug-bundle
    HWIOAuthBundle github: https://github.com/hwi/HWIOAuthBundle
    then I try to run composer require I am getting the out of memory error.</p>
        <div class="flex_layout">
            <div>Answered on</div>
            <div>Answer By</div>
            <div class="actions">
                <div class="comment">comment</div>
                <div class="vote">upvote</div>
                <div>34</div>
                <div class="vote">downvote</div>
            </div>
            
        </div>
        <div class="comments_panel">
            <div class="comments">
                <div>Comments</div>
                
                <div class="pagination">
                    <div>previous</div>
                    <div>next</div>
                </div>
            </div>
            <hr class="line">
            <p class="tiny_font">Have you done a composer self-update lately? Not sure if the 1.4.2 in your error message indicates version 1.4.2 but the latest version of composer is 1.6.2. And how much physical memory do you have? Is it a vm or cloud server? - robinwilliams87</p>
        </div>
        <hr class="line">
            <p class="q_desc">I am trying to add HWIOAuthBundle to my project by running the below command.
    composer require hwi/oauth-bundle php-http/guzzle6-adapter php-http/httplug-bundle
    HWIOAuthBundle github: https://github.com/hwi/HWIOAuthBundle
    then I try to run composer require I am getting the out of memory error.</p>
        <div class="flex_layout">
            <div>Answered on</div>
            <div>Answer By</div>
            <div class="actions">
                <div class="comment">comment</div>
                <div class="vote">upvote</div>
                <div>34</div>
                <div class="vote">downvote</div>
            </div>
            
        </div>
        <div class="comments_panel">
            <div class="comments">
                <div>Comments</div>
                
                <div class="pagination">
                    <div>previous</div>
                    <div>next</div>
                </div>
            </div>
            <hr class="line">
            <p class="tiny_font">Have you done a composer self-update lately? Not sure if the 1.4.2 in your error message indicates version 1.4.2 but the latest version of composer is 1.6.2. And how much physical memory do you have? Is it a vm or cloud server? - robinwilliams87</p>
        </div>
    </div>  
</div>
</body>
</html>

<style>
 .main_block{
    background-color: #ffffff;
    padding:20px;
 }

 .sub_block{
    padding-bottom: 10px;
    display: flex;
    justify-content: space-between;
 }

 .submit_comment{
    background-color: #d9d9d9;
    width: 1210px;
    height: 100px;
 }

 .vote{
    height: 24px;
    padding: 5px;
    background-color: #69F845;
 }

 .sorter{
        font-family: "Inria Sans", sans-serif;
        background-color: #ffffff;
        font-size: 16px;
 }
 </style>