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
</body>
</html>
<script>
$(document).ready(function() {
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
                html+='<div>edit</div>';
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
                        html+='<div>edit</div>';
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
</script>
<style>
    #profile{
        color: #ffffff;
    }
    
    #profileC{
        color: #ffffff;
    }