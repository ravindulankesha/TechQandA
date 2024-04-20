<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
?>
<div class="modal">
    <p class="modal_head">SIGNUP</p>
    <?php echo validation_errors(); ?>
    <form action='<?php echo base_url(); ?>index.php/User/signup' method="post" class="box">
        <table class="table">
            <tr>
                <td class="labels"><label for="username">USERNAME</label></td>
                <td><input type="text" name="username" class="input_area"></td>
            </tr>
            <tr>
                <td class="labels"><label for="password">PASSWORD</label></td>
                <td><input type="password" name="password" class="input_area"></td>
            </tr>       
            <tr> 
                <td class="labels"><label for="confirm_password">CONFIRM PASSWORD</label></td>
                <td><input type="password" name="confirm_password" class="input_area"></td>
            </tr>   
        </table>
        <div class="btn_area">
            <button type="submit" class="btn">Sign Up</button>
        <div>
    </form>
    <p class="modal_head">already have an account?<a href='<?php echo base_url(); ?>index.php/Navigation/login'>login</a></p> 
</div>
</body>
</html>
<style>
    #signup{
        color: #ffffff;
    }
