<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
?>
    <form class="ask_question" action='<?php echo base_url(); ?>index.php/QuestionsAndAnswers/askQuestion' method="post">
        <table class="table">
            <tr>
                <td class="askQ_labels"><label for="q_title">Question title: </label></td>
                <td class="askQ_inputs"><input type="text" name="q_title" class="inputs"></td>
            </tr>        
            <tr>
                <td class="askQ_labels"><label for="q_category">Category: </label></td>
                <input type="button" id="hidden_input" name="q_category" class="inputs" hidden>
                <td class="askQ_inputs" id='categoriesSet'>
                    <?php foreach ($categories as $category): ?>
                        <span>
                            <input type="radio" value="<?php echo $category['CategoryName'] ?>" name="category" class="categories" id="<?php echo $category['CategoryID'] ?>">
                            <label class="buttons_set" id="cat1" for="<?php echo $category['CategoryID'] ?>"><?php echo $category['CategoryName'] ?></label>
                        </span>    
                    <?php endforeach; ?>   
                    <!-- <span>
                        <input type="radio" value="php" name="category" class="categories" id="category1">
                        <label class="buttons_set" id="cat1" for="category1">php</label>
                    </span>
                    <span>
                        <input type="radio" value="cat2" name="category" class="categories" id="category2">
                        <label class="buttons_set" id="cat2" for="category2">cat2</label>
                    </span> -->
                    <span>
                        <input type="radio" value="newCat" name="category" class="categories" id="newCategory">
                        <label class="buttons_set" id="newCat" for="newCategory">New Category</label>
                    </span>
                </td>
            </tr>
            <tr id="new_cat_input" style="display:none;">
                <td class="askQ_labels"><label for="new_category_name">New Category: </label></td>
                <td class="askQ_inputs"><input type="text" name="new_category_name" class="inputs"></td>
            </tr>
            <tr>
                <td class="askQ_labels"><label for="q_desc">Description: </label></td>
                <td class="askQ_inputs"><textarea cols="40" rows="5" name="q_desc" class="description_input"></textarea>
            </tr>      
        </table>
        <div class="btn_area">
            <button type="submit" class="post_Q">POST QUESTION</button>
        <div>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){

            // var MyView = Backbone.View.extend({
            //     el: '#categoriesSet', 
                
            //     initialize: function() {
            //         this.render();
            //     },
                
            //     render: function() {
            //         var self = this;
            //         $.ajax({
            //             url: 'http://localhost/TechQandA/index.php/apis/QuestionsAPI/questionCategories', 
            //             type: 'GET',
            //             success: function(response) {
            //                 var html='';
            //                 $.each(response, function(index, item) {                   
            //                     html+='<span><input type="radio" value="'+item['CategoryName']+'" name="category" class="categories" id="'+item['CategoryID']+'">';
            //                     html+='<label class="buttons_set" id="'+ item['CategoryName']+ item['CategoryID']+ '" for="'+item['CategoryID']+'">'+ item['CategoryName'] +'</label>';
            //                     html+='</span>';      
            //                 });
            //                 self.$el.append(html);
            //             },
            //             error: function(xhr, status, error) {
            //                 console.error('Error:', status, error);
            //             }
            //         });
            //     }
            // });

            // var myView = new MyView();

            $("input[type='radio']").click(function(){
                console.log('sssss');
                var radioValue = $("input[name='category']:checked").val();
                if($("input[name='category']:checked").val()=='newCat'){
                    $("#new_cat_input").css('display','table-row');
                }
                else{
                    $("#new_cat_input").css('display','none');
                }
                $('#hidden_input').prop("value", $("input[name='category']:checked").val());
            });
        });
    </script>
</body>
</html>
<style>
    #askQ{
        color: #ffffff;
    }
