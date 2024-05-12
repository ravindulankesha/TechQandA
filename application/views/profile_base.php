<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("nav_bar.php");
?>

    <div class="container">
        
        <script type="text/template" id="profile-template">
            <div><%= Username %></div>
            <div>joined: <%= created %></div>
            <a class="delete" href="<?php echo base_url(); ?>index.php/ProfileNavigation/deleteProfile">Delete Profile</div>
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
            Username: '',
            created: ''
        },
        url: '<?php echo base_url();?>index.php/apis/UserAPI/userData'
    });

var ProfileView = Backbone.View.extend({
    tagName: 'div',
    className: 'profile_info',
    template: _.template($('#profile-template').html()),

    initialize: function() {
        this.listenTo(this.model, 'change', this.render);
    },

    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});

$(document).ready(function() {
    var profile = new ProfileModel();

    profile.fetch({
        success: function() {
            var profileView = new ProfileView({ model: profile });
            $('.container').prepend(profileView.render().el);
        }
    });
});

</script>