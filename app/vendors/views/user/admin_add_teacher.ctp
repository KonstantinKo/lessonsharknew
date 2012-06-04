    <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>

<?php
  //if User has been saved only then refresh the User Listing view part of the page
  if ( $message == "User has been saved" ){
?>    
<script type="text/javascript">
<?php echo $ajax->remoteFunction( 
    array( 
        'url' => array( 'controller' => 'users', 'action' => 'searchTeacher'), 
        'update' => 'user_listing' 
    ) 
); ?>
</script>
<?php
 }//END: if
?>
