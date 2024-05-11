<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
?>

    <div class="container">
        <!-- <div class="profile_info">
            <div>Ravindu</div>
            <div>joined: 2022/09/11</div>
            <div class="delete">Delete Profile</div>
        </div> -->
        <script type="text/template" id="profile-template">
            <div><%= name %></div>
            <div>joined: <%= joined %></div>
            <div class="delete">Delete Profile</div>
        </script>
        <div class="profile_nav">
            <div id="profileQ" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/ProfileNavigation/profileQuestions'">Questions asked</div>
            <div id="profileA" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/ProfileNavigation/profileAnswers'">Your answers</div>
            <div id="profileC" style="cursor: pointer;" onclick="window.location='<?php echo base_url(); ?>index.php/ProfileNavigation/profileComments'">Your Comments</div>
        </div>

        <div class="profile_content">

<script>
var ProfileModel = Backbone.Model.extend({
        defaults: {
            name: '',
            joined: ''
        }
    });

var ProfileView = Backbone.View.extend({
    tagName: 'div',
    className: 'profile_info',
    template: _.template($('#profile-template').html()),

    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});

$(document).ready(function() {
    var profile = new ProfileModel({
        name: 'Ravindu',
        joined: '2022/09/11'
    });

    // Instantiate Profile View
    var profileView = new ProfileView({ model: profile });
    $('.container').prepend(profileView.render().el);

})

</script>