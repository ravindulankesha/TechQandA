<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
?>
    <div class="first_block">
        <div class="intro">
            <div>
            Explore the ease of clarifying your technical doubts using this Questions and Answers Forum. 
            </div>
            <div>
            TECHQ&A provides answers to any of your programming related questions with many users posting questions and receiving answers within the forum.
            </div>
        </div> 
        <?php if($this->session->userdata('userID')==null): ?>
        <div id="getStarted" class="buttons">
            <div>GET STARTED NOW</div>
            <div class="login" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/Navigation/login'">LOGIN</div>
            <div class="signup" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/Navigation/signup'">SIGNUP</div>
        </div>  
        <?php endif; ?>
    </div>
    <?php include("searchbar.php") ?>   
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
        
    });
</script>
</html>
<style>
    #homepage{
        color: #ffffff;
    }
</style>
