      
<h2>Footer Pages</h2>

<hr />
<div id="user_listing">
<table width="100%"  >
    <tr style="bgcolor:#233000;" >
        
     
        <th width="130">Title</th>
       
        <th width="130">Slug</th>
        <th width="180">Last Updated</th>
        <th width="180">Created</th>
        <th width="150">Action</th>
    </tr>
<?php
if(!empty($pages)) {

    $count = 0;
    
      
      foreach ($pages as $key=>$content) {
        if($content['Content']['id']!=63)
        {
          $count++;
          echo '<tr>';
      
          echo '  <td>'.$content['Content']['title'].'</td>';
         
          echo '  <td>'.$content['Content']['slug'].'</td>';
          
          echo '  <td>'.date('M. jS, Y g:ia', strtotime($content['Content']['updated'])).'</td>';
          echo '  <td>'.date('M. jS, Y g:ia', strtotime($content['Content']['created'])).'</td>';
         
          echo '  <td class="actions">';
          
          echo $html->link('Edit', array('action' => 'editFooterPages', $content['Content']['id'],'admin'=>true));
         /* echo ' | '.$html->link('Delete', array('action' => 'delete', $content['Content']['id'],'admin'=>true), null, 'Are you sure you want to delete this page?').'  '; */
          echo '  </td>';
          echo '';
        }
       
        
      }
    
}

?>
</table>
</div>

<?php
if(!empty($page_count)) {
    echo '<p><i>'.$page_count.' Total Pages</i>';
}
?>