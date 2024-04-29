<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("profile_base.php");
?>
    <div class="resultsMenu">
    <div id='resultsProfileQs'>RESULTS: 13</div>
    <div>FILTERED CATEGORY:
        <select class="selectMenu_profile" id="profile_select_Qs">
            <option value="">None</option>
        </select>
    </div>
    <div>SORT BY:
        <select class="selectMenu_profile" id="profile_select_sort">
            <option value="oldest">Oldest</option>
            <option value="newest">Newest</option>
            <option value="highest">highest Votes</option>
            <option value="lowest">Lowest Votes</option>
        </select>
    </div>
</div>
<div class="question_content" id="questions_asked">
    <!-- <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">Delete</div>
    </div>   
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">Delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">delete</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div class="delete">delete</div>
    </div> -->
</div>
    </div>
</div>
</body>
</html>
<script>
$(document).ready(function() {
    $.ajax({
        url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/questionCategories',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Populate the dynamic select tag with options
            var dynamicSelect = $('#profile_select_Qs');
            $.each(response, function(index, item) {
                dynamicSelect.append('<option value="' + item.CategoryID + '">' + item.CategoryName + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data from the API:', error);
        }
    });

    $.ajax({
        url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/userQuestions', 
        type: 'GET',
        // data: {
        //     filter: $('#profile_select_Qs').val(),
        //     sort: $('#profile_select_sort').val()
        // },
        success: function(response) {
            $('#resultsProfileQs').html('RESULTS: '+ response.length);
            var html='';
            $.each(response, function(index, item) {                   
                html+='<hr class="line"><div class="question">'+ item['Title']+'</div><div class="question_details">';
                html+='<div>Votes: '+item['Votes']+'</div>';
                html+='<div>Answers: ' +item['answer_count']+'</div>';
                html+='<div>Category: '+item['CategoryName']+'</div>';
                html+='<div>Asked On: '+item['CreationDate'].substring(0,11)+'</div>';
                html+='<div class="delete">delete</div>';
                html+='<div><a href="<?php echo base_url();?>index.php/Navigation/questionPage?qID='+item['QuestionID']+'"> Go to Question Page</a></div></div>';
            });
            $('#questions_asked').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
    // Backbone View
    var QuestionView = Backbone.View.extend({
        el: '#profile_select_Qs',
        events: {
            'change': 'render'
        },
        render: function() {
            $.ajax({
                url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/userQuestions', 
                type: 'GET',
                data: {
                    filter: $('#profile_select_Qs').val(),
                    sort: $('#profile_select_sort').val()
                },
                success: function(response) {
                    $('#resultsProfileQs').html('RESULTS: '+ response.length);
                    var html='';
                    $.each(response, function(index, item) {                   
                        html+='<hr class="line"><div class="question">'+ item['Title']+'</div><div class="question_details">';
                        html+='<div>Votes: '+item['Votes']+'</div>';
                        html+='<div>Answers: ' +item['answer_count']+'</div>';
                        html+='<div>Category: '+item['CategoryName']+'</div>';
                        html+='<div>Asked On: '+item['CreationDate'].substring(0,11)+'</div>';
                        html+='<div class="delete">delete</div>';
                        html+='<div><a href="<?php echo base_url();?>index.php/Navigation/questionPage?qID='+item['QuestionID']+'"> Go to Question Page</a></div></div>';
                    });
                    $('#questions_asked').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
    var questionView = new QuestionView({el: '#profile_select_Qs' });
    var questionView2 = new QuestionView({el: '#profile_select_sort'});
});
</script>
<style>

    #profile{
        color: #ffffff;
    }
    
    #profileQ{
        color: #ffffff;
    }