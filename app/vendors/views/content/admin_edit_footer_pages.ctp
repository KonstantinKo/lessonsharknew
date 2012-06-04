<?php echo $javascript->link('tinymce/jscripts/tiny_mce/tiny_mce'); ?> 
 <?php
 //echo "<pre>";
//print_r($this->data);die('this');  
 ?>
   <div class="single"><h2>Content Management System</h2> </div>

       <fieldset class="mid_tabl_bg"><legend>Edit Page</legend> 
      <?php //echo $form->create('Content', array('url' => '/admin/content/editFooterPages/'.$id));?>
      <?php echo $form->create('Content',array('id'=>'contentEditForm','url' => '/admin/content/editFooterPages',$id,'name'=>'frmCreate','enctype'=>'multipart/form-data')); ?>
      
      <?php echo $form->input('Content.id', array('label'=>'','div'=>'','type'=>'hidden','value'=>$id));?>
      
      <table width="80%" cellpadding="5" cellspacing="0" style="border: 1px solid #66666" align="center" border="0">
     
      <tr>
        <td align="left" style="padding-left:20px;">Title</td>
        <td align="left"><?php echo $form->input('Content.title', array('class'=>'textbox','label'=>'','div'=>''));?></td>    
      </tr> 
      <tr>
        <td align="left" style="padding-left:20px;">Slug</td>
        <td align="left"><?php echo $form->input('Content.slug', array('class'=>'textbox','label'=>'','div'=>''));?></td>    
      </tr> 
      
     
      
      <tr>
        <td align="left" style="padding-left:20px;">Body</td>
        <td colspan="2" align="left"><?php echo $form->input('Content.body', array('rows'=>'10','cols'=>'40','class'=>'mceEditor','id'=>'elm1','label'=>'','div'=>''));?></td>   
            
      </tr>
      
     
      <tr>
        <td align="left" style="padding-left:20px;">&nbsp;</td>
        <td align="left"><input type="submit" value="Update" /></td>    
      </tr>     
      </table>   
      <?php echo $form->end();?>
   
      
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		relative_urls : false,
		plugins : "phpimage,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "ibrowser,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,phpimage,cleanup,help,code",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons5 : "print,|,ltr,rtl,|,fullscreen,|,justifyleft,justifycenter,justifyright,justifyfull",
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

              
                              