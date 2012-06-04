                          <h2>Pages</h2>
<div>
    <?php echo $html->link('Add New Page', array('action' => 'add')); ?>
</div>
<hr />
<table width="100%">
    <tr style="bgcolor:#233000;">
        <th width="60" >&nbsp;</th>
        <th>Parent</th>
        <th>Title</th>
        <th width="130">&nbsp;</th>
        <th width="130">Slug</th>
        <th width="180">Last Updated</th>
        <th width="180">Created</th>
        <th width="150"></th>
    </tr>
<?php
if(!empty($pages)) {
    $count = 0;
    foreach ($pages as $val=>$i) {
    //pr($pages);
      foreach ($i['children'] as $key=>$content) {
        $count++;
        echo '<tr>';
        echo '  <td>'.'</td>';
        echo '  <td style="font-weight:bold;">'.$i['Content']['slug'].'</td>';
        echo '  <td>'.$content['Content']['title'].'</td>';
        echo '  <td>'.'</td>';
        echo '  <td>'.$content['Content']['slug'].'</td>';
        
        echo '  <td>'.date('M. jS, Y g:ia', strtotime($content['Content']['updated'])).'</td>';
        echo '  <td>'.date('M. jS, Y g:ia', strtotime($content['Content']['created'])).'</td>';
       
        echo '  <td class="actions">';
        
        echo $html->link('Edit', array('action' => 'edit', $content['Content']['id'],'admin'=>true)).' | ';
        echo $html->link('Delete', array('action' => 'delete', $content['Content']['id'],'admin'=>true), null, 'Are you sure you want to delete this page?').'  ';
        echo '  </td>';
        echo '';
      }
    }
}
?>
</table>
<hr />
<?php
if(!empty($page_count)) {
    echo '<p><i>'.$page_count.' Total Pages</i>';
}
?>