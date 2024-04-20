<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
?>
<div class="modal">
    <p class="modal_head">LOGIN</p>
    <form class="box" method="post" action='<?php echo base_url(); ?>index.php/User/login'>
        <table class="table">
            <tr>
                <td class="labels"><label for="username">USERNAME</label></td>
                <td><input type="text" name="username" class="input_area"></td>
            </tr>
            <tr>
                <td class="labels"><label for="password">PASSWORD</label></td>
                <td><input type="password" name="password" class="input_area"></td>
            </tr>       
        </table>
        <div class="btn_area">
            <button type="submit" class="btn">LOGIN</button>
        <div>
    </form>
    <p class="modal_head">don't have an account?<a href='<?php echo base_url(); ?>index.php/Navigation/signup'>signup</a></p> 
</div>
</body>
</html>
<style>
    #login{
        color: #ffffff;
    }
