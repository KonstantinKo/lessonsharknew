<?php echo $javascript->link('tinymce/jscripts/tiny_mce/tiny_mce'); ?>
<script type="text/javascript">
tinyMCE.init({
// General options
mode : "textareas",
theme : "advanced",
editor_selector : "mceEditor",
editor_deselector : "mceNoEditor",
plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

// Theme options
theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,

// Example content CSS (should be your site CSS)
content_css : "css/content.css",

// Drop lists for link/image/media/template dialogs
template_external_list_url : "lists/template_list.js",
external_link_list_url : "lists/link_list.js",
external_image_list_url : "lists/image_list.js",
media_external_list_url : "lists/media_list.js",

// Style formats
style_formats : [
{title : 'Bold text', inline : 'b'},
{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
{title : 'Example 1', inline : 'span', classes : 'example1'},
{title : 'Example 2', inline : 'span', classes : 'example2'},
{title : 'Table styles'},
{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
],

// Replace values for the template plugin
template_replace_values : {
username : "Some User",
staffid : "991234"
}
});
</script>

<?php echo $javascript->link('ckeditor'); ?> 
       <div class="single"><h2>Content Management System</h2> </div>
      
      <fieldset class="mid_tabl_bg"><legend>Add Pages</legend> 
      <?php echo $form->create('Content', array('url' => '/admin/content/add'));?>
      <table width="80%" cellpadding="5" cellspacing="0" style="border: 1px solid #66666" align="center" border="0">
      <tr>
        <td align="left" style="padding-left:20px;">Parent</td>
        <td align="left"><?php echo '  <select name="data[Content][parent_id]" id="ContentParentId" class="reg_combo_box">';  

if(!empty($parents)) {
    foreach($parents as $i) {
        echo '<option value="'.$i['Content']['id'].'" >'.$i['Content']['slug'].'</option>';
    }
}
echo '  </select>';?></td>    
      </tr> 
      <tr>
        <td align="left" style="padding-left:20px;">Title</td>
        <td align="left"><?php echo $form->input('Content.title', array('class'=>'textbox','label'=>'','div'=>''));?></td>    
      </tr> 
      <tr>
        <td align="left" style="padding-left:20px;">Slug</td>
        <td align="left"><?php echo $form->input('Content.slug', array('class'=>'textbox','label'=>'','div'=>'', 'after' => ' Note:- The Slug is the word used for the URL of this page.'));?></td>    
      </tr>
      
 
      <tr>
        <td align="left" style="padding-left:20px;">Body</td>
        <td align="left">  <?php echo $form->input('Content.body', array('rows'=>'6','cols'=>'40','class'=>'mceEditor','id'=>'elm1','label'=>'','div'=>''));?></td>    
      </tr>
      <tr><td colspan=2 style="font-weight:bold;">Meta Data</td></tr> 
      <tr>
        <td align="left" style="padding-left:20px;">Keywords</td>
        <td align="left"><?php echo $form->input('Content.keywords', array('class'=>'textbox','label'=>'','div'=>''));?></td>    
      </tr> 
      <tr>
        <td align="left" style="padding-left:20px;">Description</td>
        <td align="left"><?php echo $form->input('Content.description', array('class'=>'textArea','label'=>'','div'=>'','rows' => '3', 'cols' => '65'));?></td>    
      </tr> 
      <tr>
        <td align="left" style="padding-left:20px;">&nbsp;</td>
        <td align="left"><input type="submit" value="Save" /></td>    
      </tr>     
      </table>   
      <?php echo $form->end();?>      

