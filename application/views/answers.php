<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("profile_base.php");
?>
    <div class="resultsMenu">
    <div id="profile_ans_results">RESULTS: 3</div>
    <div>SORT BY:
        <select class="selectMenu_profile" id="profile_answers_sort">
            <option value="oldest">Oldest</option>
            <option value="newest">Newest</option>
            <option value="highest">highest Votes</option>
            <option value="lowest">Lowest Votes</option>
        </select>
    </div>
</div>
<div class="question_content" id="profile_ans_content">
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
</body>
</html>
<script>
$(document).ready(function() {
    $.ajax({
        url: 'http://localhost/TechQandA/index.php/apis/UserAPI/userAnswers', 
        type: 'GET',
        // data: {
        //     filter: $('#profile_select_Qs').val(),
        //     sort: $('#profile_select_sort').val()
        // },
        success: function(response) {
            $('#profile_ans_results').html('RESULTS: '+ response.length);
            var html='';
            $.each(response, function(index, item) {                   
                html+='<hr class="line"><div class="question">'+ item['Answer']+'</div><div class="question_details">';
                html+='<div>Votes: '+item['Votes']+'</div>';
                html+='<div>Submitted On: '+item['CreationDate'].substring(0,11)+'</div>';
                // html+='<div>edit</div>';
                html+='<div class="delete" onclick="deleteA('+item['AnswerID']+')">delete</div>';
                html+='<div><a href="<?php echo base_url();?>index.php/Navigation/questionPage?qID='+item['QuestionID']+'"> Go to Question Page</a></div></div>';
            });
            $('#profile_ans_content').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });

        // Backbone View
        var AnswerView = Backbone.View.extend({
        el: '#profile_answers_sort',
        events: {
            'change': 'render'
        },
        render: function() {
            $.ajax({
                url: 'http://localhost/TechQandA/index.php/apis/UserAPI/userAnswers', 
                type: 'GET',
                data: {
                    sort: $('#profile_answers_sort').val()
                },
                success: function(response) {
                    $('#profile_ans_results').html('RESULTS: '+ response.length);
                var html='';
                $.each(response, function(index, item) {                   
                    html+='<hr class="line"><div class="question">'+ item['Answer']+'</div><div class="question_details">';
                    html+='<div>Votes: '+item['Votes']+'</div>';
                    html+='<div>Submitted On: '+item['CreationDate'].substring(0,11)+'</div>';
                    html+='<div class="delete" onclick="deleteA('+item['AnswerID']+')">delete</div>';
                    html+='<div><a href="<?php echo base_url();?>index.php/Navigation/questionPage?qID='+item['QuestionID']+'"> Go to Question Page</a></div></div>';
                });
                $('#profile_ans_content').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
    var questionView = new AnswerView({el: '#profile_answers_sort' });
});

function deleteA(aID){
    $.ajax({
            url: '<?php echo base_url();?>index.php/apis/UserAPI/deleteAnswer', 
            type: 'POST',
            data: { 
                aID: aID
            }, 
            success: function(response) {
                window.location.href = '<?php echo base_url();?>index.php/ProfileNavigation/profileAnswers';
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
}

</script>
<style>
    #profile{
        color: #ffffff;
    }

    #profileA{
        color: #ffffff;
    }