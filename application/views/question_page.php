<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
include("searchbar.php");
?>
<div class="container">
    <p class="question_topic" id="mainTopic"></p>
    <p class="q_desc" id="mainDesc"></p>
    <div class="flex_layout">
        <div id='view_date'>Posted on</div>
        <div id='view_cat'>Category</div>
        <div id='view_name'>Posted By</div>
        <div class="actions">
            <div class="comment">comment</div>
            <div class="vote" id="ques_upvote">upvote</div>
            <div id="view_qvotes">34</div>
            <div class="vote" id="ques_downvote">downvote</div>
        </div>
        
    </div>
    <div class="comments_panel">
        <div class="comments">
            <div>Comments</div>
            
            <!-- <div class="pagination">
                <div>previous</div>
                <div>next</div>
            </div> -->
        </div>
        <div id="q_comments_panel">   
            <hr class="line">
            <p class="tiny_font">Have you done a composer self-update lately? Not sure if the 1.4.2 in your error message indicates version 1.4.2 but the latest version of composer is 1.6.2. And how much physical memory do you have? Is it a vm or cloud server? - robinwilliams87</p>
        </div>  
    </div>
    <div class="main_block">
        <div class="sub_block">
            <div id='countA'>Answers: 13</div>
            <div>SORT BY:
                <select class="sorter" id="sortAns">
                    <option value="oldest">Oldest</option>
                    <option value="newest">Newest</option>
                    <option value="highest">highest Votes</option>
                    <option value="lowest">Lowest Votes</option>
                </select>
            </div>
        </div>
        <div class="sub_block">
            <div><textarea id="ansarea" cols="40" rows="3" name="q_desc" class="submit_comment"></textarea></div>
            <div class="vote" onclick="anssubmit()">submit answer</div>
        </div>
        <div id="answer_panels">
            <hr class="line">
            <p class="q_desc"></p>
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
                    
                    <!-- <div class="pagination">
                        <div>previous</div>
                        <div>next</div>
                    </div> -->
                </div>
                <hr class="line">
                <p class="tiny_font">Have you done a composer self-update lately? Not sure if the 1.4.2 in your error message indicates version 1.4.2 but the latest version of composer is 1.6.2. And how much physical memory do you have? Is it a vm or cloud server? - robinwilliams87</p>
            </div>
        </div>
        <!-- <hr class="line">
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
        </div> -->
    </div>  
</div>
</body>
</html>
<script>
$(document).ready(function() {

    var urlParameters = new URLSearchParams(window.location.search);
    var param = urlParameters.get('qID'); 
    $.ajax({
        url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/questionDetails',
        type: 'GET',
        dataType: 'json',
        data: { 
            qID: param
        }, 
        success: function(response) {
            $('#ques_upvote').attr('onclick', "upvoteQ("+response[0]['QuestionID']+")");
            $('#ques_downvote').attr('onclick', "downvoteQ("+response[0]['QuestionID']+")");
            $('#mainTopic').html(response[0]['Title']);
            $('#mainDesc').html(response[0]['Description']);
            $('#view_cat').html('Category: '+response[0]['CategoryName']);
            $('#view_date').html('Posted On: '+response[0]['CreationDate'].substring(0,11));
            $('#view_name').html('Posted By: '+response[0]['Username']);
            $('#view_qvotes').html('Votes: '+response[0]['Votes']);
            $('#countA').html('Answers: '+response['answers'].length);
            var html='';
            $.each(response['comments'], function(index, item) {       
                html+= '<hr class="line"><p class="tiny_font">';  
                html+= item['Comment'];
                html+= '- ';
                html+= item['Username']     
                console.log(item['Comment']);
            });
            $('#q_comments_panel').html(html);
            var html2='';
            var html3='';
            $.each(response['answers'], function(index, item) { 
                html2+='<hr class="line"><p class="q_desc">'+item['Answer']+'</p><div class="flex_layout"><div>Answered on '+item['CreationDate'].substring(0,11)+'</div>';
                html2+='<div>Answer By '+item['Username']+'</div><div class="actions"><div class="comment">comment</div>';
                html2+='<div class="vote" onclick="upvoteAnswer('+item['AnswerID']+')">upvote</div><div id="voteA'+ item['AnswerID'] +'">'+item['Votes']+'</div><div class="vote" onclick="downvoteAnswer('+item['AnswerID']+')">downvote</div></div></div>';
                // html2+='<div class="comments"><div>Comments</div><div class="pagination"><div>previous</div><div>next</div></div></div>'
                html3='<div class="comments_panel">';
                $.each(item['comments'], function(i, v) { 
                html3+='<hr class="line"><p class="tiny_font">'+v['Comment']+'- '+v['Username']+'</p>';
                });
                html2+=html3+'</div>';
                html3='';
            });
            $('#answer_panels').html(html2);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data from the API:', error);
        }
    });

    var MyView = Backbone.View.extend({
        el: '#sortAns',
        events: {
            'change': 'render'
        },
    
        render: function() {
            var urlParams = new URLSearchParams(window.location.search);
            var paramValue = urlParams.get('qID'); 
            var html2='';
            var html3=''; 
            $.ajax({
            url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/questionInfo', 
            type: 'GET',
            data: { 
                qID: paramValue,
                sort:$('#sortAns').val()
            }, 
            success: function(response) {
                $.each(response, function(index, item) { 
                    html2+='<hr class="line"><p class="q_desc">'+item['Answer']+'</p><div class="flex_layout"><div>Answered on '+item['CreationDate'].substring(0,11)+'</div>';
                    html2+='<div>Answer By '+item['Username']+'</div><div class="actions"><div class="comment">comment</div>';
                    html2+='<div class="vote" onclick="upvoteAnswer('+item['AnswerID']+')">upvote</div><div id="voteA'+ item['AnswerID'] +'">'+item['Votes']+'</div><div class="vote" onclick="downvoteAnswer('+item['AnswerID']+')">downvote</div></div></div>';
                    // html2+='<div class="comments"><div>Comments</div><div class="pagination"><div>previous</div><div>next</div></div></div>';
                    html3='<div class="comments_panel">';
                    $.each(item['comments'], function(i, v) { 
                    html3+='<hr class="line"><p class="tiny_font">'+v['Comment']+'- '+v['Username']+'</p>';
                    });
                    html2+=html3+'</div>';
                    html3='';
                    });
                    $('#answer_panels').html(html2);
                },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
            });
            }
    });

    var myView = new MyView();
});

function upvoteAnswer($aID){
    $.ajax({
            url: 'http://localhost/TechQandA/index.php/apis/UserAPI/upvoteAnswer', 
            type: 'GET',
            data: { 
                aID: $aID
            }, 
            success: function(response) {
                $('#voteA'+$aID).html(response[0]['Votes']);
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

function downvoteAnswer($aID){
    $.ajax({
            url: 'http://localhost/TechQandA/index.php/apis/UserAPI/downvoteAnswer', 
            type: 'GET',
            data: { 
                aID: $aID
            }, 
            success: function(response) {
                $('#voteA'+$aID).html(response[0]['Votes']);
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

function upvoteQ($qID){
    $.ajax({
            url: 'http://localhost/TechQandA/index.php/apis/UserAPI/upvoteQuestion', 
            type: 'GET',
            data: { 
                qID: $qID
            }, 
            success: function(response) {
                $('#view_qvotes').html('Votes: '+response[0]['Votes']);
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

function downvoteQ($qID){
    $.ajax({
            url: 'http://localhost/TechQandA/index.php/apis/UserAPI/downvoteQuestion', 
            type: 'GET',
            data: { 
                qID: $qID
            }, 
            success: function(response) {
                $('#view_qvotes').html('Votes: '+response[0]['Votes']);
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

function anssubmit(){
    var urlParameters = new URLSearchParams(window.location.search);
    var param = urlParameters.get('qID');
    var answerval= $('#ansarea').val();
    $.ajax({
            url: 'http://localhost/TechQandA/index.php/apis/UserAPI/submitAnswer', 
            type: 'POST',
            data: { 
                qID: param,
                answer: answerval
            }, 
            success: function(response) {
                window.location.href = '<?php echo base_url();?>index.php/Navigation/questionPage?qID='+response;
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}
</script>
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