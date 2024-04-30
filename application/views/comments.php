<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("profile_base.php");
?>
    <div class="resultsMenu">
    <div id="profile_comms">RESULTS: 3</div>
    <div>SORT BY:
        <select class="selectMenu_profile" id="profile_comms_sort">
            <option value="oldest">Oldest</option>
            <option value="newest">Newest</option>
        </select>
    </div>
</div>
<div class="question_content" id="profile_comms_results">
    <!-- <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>Go to question page</div>
        <div>edit</div>
        <div class="delete">Delete</div>
    </div>   
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>Go to question page</div>
        <div>edit</div>
        <div class="delete">Delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>Go to question page</div>
        <div>edit</div>
        <div class="delete">Delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>Go to question page</div>
        <div>edit</div>
        <div class="delete">Delete</div>
    </div> -->

</div>
    </div>
</div>
<div class="overlay">
    <div class="center">
        <button id="close" class="popupclose" style="float: right;">X</button>
        <form method="post" action="<?php echo base_url(); ?>index.php/QuestionsAndAnswers/submitAnswerComment">
            <input type="hidden" name="commentid" id="acommentInput">
            <textarea cols="40" rows="3" name="edit_comment" id="editcomment" class="submitpopup"></textarea>
            <input type="submit" value="Edit Comment">
        </form>
    </div>
</div>
</body>
</html>
<script>
$(document).ready(function() {

    $('#close').on('click', function () {
        $('.overlay').hide();
    });

    $.ajax({
        url: 'http://localhost/TechQandA/index.php/apis/UserAPI/userComments', 
        type: 'GET',
        // data: {
        //     filter: $('#profile_select_Qs').val(),
        //     sort: $('#profile_select_sort').val()
        // },
        success: function(response) {
            $('#profile_comms').html('RESULTS: '+ response.length);
            var html='';
            $.each(response, function(index, item) {                   
                html+='<hr class="line"><div class="question">'+ item['Comment']+'</div><div class="question_details">';
                html+='<div>Submitted On: '+item['CreationDate'].substring(0,11)+'</div>';
                // html+='<div onclick="edit('+item['CommentID']+','+item['Comment']+')">edit</div>';
                html+='<div onclick="edit('+item['CommentID']+','+'\''+item['Comment']+'\''+')">edit</div>';

                html+='<div class="delete">delete</div>';
                html+='<div><a href="<?php echo base_url();?>index.php/Navigation/questionPage?qID='+item['QuestionID']+'"> Go to Question Page</a></div></div>';
            });
            $('#profile_comms_results').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });

    var CommentView = Backbone.View.extend({
        el: '#profile_comms_sort',
        events: {
            'change': 'render'
        },
        render: function() {
            $.ajax({
                url: 'http://localhost/TechQandA/index.php/apis/UserAPI/userComments', 
                type: 'GET',
                data: {
                    sort: $('#profile_comms_sort').val()
                },
                success: function(response) {
                    $('#profile_comms').html('RESULTS: '+ response.length);
                    var html='';
                    $.each(response, function(index, item) {                   
                        html+='<hr class="line"><div class="question">'+ item['Comment']+'</div><div class="question_details">';
                        html+='<div>Submitted On: '+item['CreationDate'].substring(0,11)+'</div>';
                        html+='<div onclick="edit('+item['CommentID']+','+'\''+item['Comment']+'\''+')">edit</div>';
                        html+='<div class="delete">delete</div>';
                        html+='<div><a href="<?php echo base_url();?>index.php/Navigation/questionPage?qID='+item['QuestionID']+'"> Go to Question Page</a></div></div>';
                    });
                    $('#profile_comms_results').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
    var commentView = new CommentView({el: '#profile_comms_sort' });
});

function edit(id,text){
    $('.overlay').show();
    $('#editcomment').val(text);
}
</script>
<style>
    #profile{
        color: #ffffff;
    }
    
    #profileC{
        color: #ffffff;
    }

    /* .hideform {
    display: none;
    } */

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(128,128,128,0.5); 
        display: none; 
    }

    .center {
    background-color: #69F845;
    margin: 200px;
    width: 60%;
    padding: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.submitpopup{
    background-color: #d9d9d9;
    width: 900px;
    height: 80px;
 }