<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
include("searchbar.php");
?>
<div class="resultsMenu">
    <div id="results">RESULTS: <?php echo sizeof($questions) ?></div>
    <div>FILTERED CATEGORY:
        <select id='category' class="selectMenu">
            <option value="">None</option>
        </select>
    </div>
    <div>SORT BY:
        <select id='sort' class="selectMenu">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
            <option value="highest">highest Votes</option>
            <option value="lowest">Lowest Votes</option>
        </select>
    </div>
</div>
<div class="question_content" id="questionArea">
    <?php foreach ($questions as $question): ?>
        <hr class="line">   
        <div class="question"><?php echo $question['Title'] ?></div>
        <div class="question_details">
            <div>Votes: <?php echo $question['Votes'] ?></div>
            <div>Answers: <?php echo $question['answer_count'] ?></div>
            <div>Category: <?php echo $question['CategoryName'] ?></div>
            <div>Asked By: <?php echo $question['Username'] ?></div>
            <div>Go to Question Page</div>
        </div>
    <?php endforeach; ?>    
    <!-- <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>   
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div>
    <hr class="line">   
    <div class="question">PHP memory size exhausted</div>
    <div class="question_details">
        <div>votes:22</div>
        <div>answers:29</div>
        <div>category:php</div>
        <div>askedBy:ralph99</div>
    </div> -->
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
            var dynamicSelect = $('#category');
            $.each(response, function(index, item) {
                dynamicSelect.append('<option value="' + item.CategoryID + '">' + item.CategoryName + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data from the API:', error);
        }
    });

    // Backbone View
    var QuestionView = Backbone.View.extend({
        el: '#category',
        events: {
            'change': 'render'
        },
        render: function() {
            $.ajax({
                url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/questions', 
                type: 'GET',
                data: {
                    filter: $('#category').val(),
                    sort: $('#sort').val()
                },
                success: function(response) {
                    $('#results').html('RESULTS: '+ response.length);
                    var html='';
                    $.each(response, function(index, item) {                   
                        html+='<hr class="line"><div class="question">'+ item['Title']+'</div><div class="question_details">';
                        html+='<div>Votes: '+item['Votes']+'</div>';
                        html+='<div>Answers: ' +item['answer_count']+'</div>';
                        html+='<div>Category: '+item['CategoryName']+'</div>';
                        html+='<div>Asked By: '+item['Username']+'</div>';
                        html+='<div>Go to Question Page</div></div>';
                    });
                    $('#questionArea').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
    var questionView = new QuestionView();

        var QuestionView = Backbone.View.extend({
        el: '#category',
        events: {
            'change': 'render'
        },
        render: function() {
            $.ajax({
                url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/questions', 
                type: 'GET',
                data: {
                    filter: $('#category').val(),
                    sort: $('#sort').val()
                },
                success: function(response) {
                    $('#results').html('RESULTS: '+ response.length);
                    var html='';
                    $.each(response, function(index, item) {                   
                        html+='<hr class="line"><div class="question">'+ item['Title']+'</div><div class="question_details">';
                        html+='<div>Votes: '+item['Votes']+'</div>';
                        html+='<div>Answers: ' +item['answer_count']+'</div>';
                        html+='<div>Category: '+item['CategoryName']+'</div>';
                        html+='<div>Asked By: '+item['Username']+'</div>';
                        html+='<div>Go to Question Page</div></div>';
                    });
                    $('#questionArea').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
    var questionView = new QuestionView({el: '#category' });
    var questionView2 = new QuestionView({el: '#sort'});
});
</script>
<style>
    #questionsList{
        color: #ffffff;
    }
