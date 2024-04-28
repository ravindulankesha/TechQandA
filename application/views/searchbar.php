<form class="search-container" id="searchBox" action='<?php echo base_url(); ?>index.php/Navigation/questionslist' method="post">
    <input type="text" name="searchInput" class="search" placeholder="Search for a question">
    <button class="search_btn" id="questionSearch" type="submit">SEARCH</button>
</form>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>    
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js" type="text/javascript"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js" type="text/javascript"></script>
<script type=text/javascript>
// var MyView = Backbone.View.extend({
//     events: {
//         'click #questionSearch': 'onButtonClick'
//     },

//     onButtonClick: function() {
//         $.ajax({
//             url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/questionSearch', 
//             type: 'POST',
//             data: {
//                 searchInput: $('#searchInput').val()
//             },
//             success: function(response) {
//                 // console.log('Response:', response);
//                 window.location.href = 'http://localhost/TechQandA/index.php/Navigation/questionslist?data=' + encodeURIComponent(JSON.stringify(response));
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error:', error);
//             }
//         });
//     }
// });

// var myView = new MyView({ el: '#searchBox' });

</script>