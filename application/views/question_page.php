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
            <div class="comment" onclick="commentQues()">comment</div>
            <div class="vote" id="ques_upvote">upvote</div>
            <div id="view_qvotes">34</div>
            <div class="vote" id="ques_downvote">downvote</div>
        </div>
        
    </div>
    <div class="comments_panel">
        <div class="comments">
            <div>Comments</div>
            
        </div>
        <div id="q_comments_panel">   
            <hr class="line">
            <p class="tiny_font"></p>
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
                    
                </div>
                <hr class="line">
                <p class="tiny_font"></p>
            </div>
        </div>
        
    </div> 

</div>
<div class="center hideform">
    <button id="close" class="popupclose" style="float: right;">X</button>
    <form method="post" action="<?php echo base_url(); ?>index.php/QuestionsAndAnswers/submitAnswerComment">
        <input type="hidden" name="acommentInput" id="acommentInput">
        <textarea cols="40" rows="3" name="ans_comment" class="submitpopup"></textarea>
        <input type="submit" value="Submit Comment">
    </form>
</div>

<div class="qcomment hideform">
    <button id="closeqpopup" class="popupclose" style="float: right;">X</button>
    <form method="post" action="<?php echo base_url(); ?>index.php/QuestionsAndAnswers/submitQuestionComment">
        <input type="hidden" name="qcommentInput" id="qcommentInput">
        <textarea cols="40" rows="3" name="ques_comment" class="submitpopup"></textarea>
        <input type="submit" value="Submit Comment">
    </form>
</div>
</body>
</html>
<script>
$(document).ready(function() {

    $('#close').on('click', function () {
        $('.center').hide();
        $('.comment').show();
    });

    $('#closeqpopup').on('click', function () {
        $('.qcomment').hide();
        $('.comment').show();
    });


    var urlParameters = new URLSearchParams(window.location.search);
    var param = urlParameters.get('qID'); 
    $.ajax({
        url: '<?php echo base_url();?>index.php/apis/QuestionsAPI/questionDetails',
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
                html2+='<div>Answer By '+item['Username']+'</div><div class="actions"><div class="comment" onclick="commentAns('+item['AnswerID']+')">comment</div>';
                html2+='<div class="vote" onclick="upvoteAnswer('+item['AnswerID']+')">upvote</div><div id="voteA'+ item['AnswerID'] +'">'+item['Votes']+'</div><div class="vote" onclick="downvoteAnswer('+item['AnswerID']+')">downvote</div></div></div>';
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
            url: '<?php echo base_url();?>index.php/apis/QuestionsAPI/questionInfo', 
            type: 'GET',
            data: { 
                qID: paramValue,
                sort:$('#sortAns').val()
            }, 
            success: function(response) {
                $.each(response, function(index, item) { 
                    html2+='<hr class="line"><p class="q_desc">'+item['Answer']+'</p><div class="flex_layout"><div>Answered on '+item['CreationDate'].substring(0,11)+'</div>';
                    html2+='<div>Answer By '+item['Username']+'</div><div class="actions"><div class="comment" onclick="commentAns('+item['AnswerID']+')">comment</div>';
                    html2+='<div class="vote" onclick="upvoteAnswer('+item['AnswerID']+')">upvote</div><div id="voteA'+ item['AnswerID'] +'">'+item['Votes']+'</div><div class="vote" onclick="downvoteAnswer('+item['AnswerID']+')">downvote</div></div></div>';
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
            url: '<?php echo base_url();?>index.php/apis/UserAPI/upvoteAnswer', 
            type: 'GET',
            data: { 
                aID: $aID
            }, 
            success: function(response) {
                if(response!='none'){
                    $('#voteA'+$aID).html(response[0]['Votes']);
                }
                else{
                    console.log('success');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

function downvoteAnswer($aID){
    $.ajax({
            url: '<?php echo base_url();?>index.php/apis/UserAPI/downvoteAnswer', 
            type: 'GET',
            data: { 
                aID: $aID
            }, 
            success: function(response) {
                if(response!='none'){
                    $('#voteA'+$aID).html(response[0]['Votes']);
                }
                else{
                    console.log('success');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

function upvoteQ($qID){
    $.ajax({
            url: '<?php echo base_url();?>index.php/apis/UserAPI/upvoteQuestion', 
            type: 'GET',
            data: { 
                qID: $qID
            }, 
            success: function(response) {
                if(response!='none'){
                    $('#view_qvotes').html('Votes: '+response[0]['Votes']);
                }
                else{
                    console.log('success');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

function downvoteQ($qID){
    $.ajax({
            url: '<?php echo base_url();?>index.php/apis/UserAPI/downvoteQuestion', 
            type: 'GET',
            data: { 
                qID: $qID
            }, 
            success: function(response) {
                if(response!='none'){
                    $('#view_qvotes').html('Votes: '+response[0]['Votes']);
                }
                else{
                    console.log(response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

function commentAns($aID){    
    $('.center').show();
    $('.comment').hide();
    $('#acommentInput').val($aID);

}

function commentQues(){
    var urlParameters = new URLSearchParams(window.location.search);
    var param = urlParameters.get('qID');
    $('.qcomment').show();
    $('.comment').hide();
    $('#qcommentInput').val(param);

}

function anssubmit(){
    var urlParameters = new URLSearchParams(window.location.search);
    var param = urlParameters.get('qID');
    var answerval= $('#ansarea').val();
    $.ajax({
            url: '<?php echo base_url();?>index.php/apis/UserAPI/submitAnswer', 
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
    width: 72vw;
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

 .center {
    left: 5px;
    top: -210px;
    z-index: 1;
    background-color: #69F845;
    position: relative;
    margin: auto;
    width: 60%;
    padding: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.qcomment {
    left: 200px;
    top: 500px;
    z-index: 1;
    background-color: #69F845;
    position: absolute;
    margin: auto;
    width: 60%;
    padding: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.hideform {
    display: none;
}

.submitpopup{
    background-color: #d9d9d9;
    width: 99%;
    height: 80px;
 }
 </style>