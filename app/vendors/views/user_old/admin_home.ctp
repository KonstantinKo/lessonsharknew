<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="cpanel">
	<tr>
	    <td align="center" valign="top">
           <?php             
              echo $html->link(
                  $html->image("admin/user-management.png", array("alt" => "User Management", "border"=>"0")). '<br> User Management',
                  "/admin/users",
                  array('escape'=>false)
              );
            ?>
          
        <br>
        Manage your users. Here you can view, add and edit users.
	    </td>
    <?php /*?>
	    <td align="center" valign="top">
           <?php             
              echo $html->link(
                  $html->image("admin/client-management.png", array("alt" => "Client Management", "border"=>"0")). '<br> Providers/Clients Management',
                  "/admin/clients",
                  array('escape'=>false)
              );
            ?>
        <br>
        Manage your providers. Here you can view, add and edit providers.
	    </td> <?php */?>
  </tr>
 <?php /*?> <tr>	    
	    <td align="center" valign="top"> 
           <?php             
              echo $html->link(
                  $html->image("admin/oasis-management.png", array("alt" => "Oasis Management", "border"=>"0")). '<br> Oasis Management',
                  "/admin/oasis",
                  array('escape'=>false)
              );
            ?>
        <br>
        Manage your oasis codes. Here you can view, add and edit oasis codes.
		  </td>


        <td align="center" valign="top">
       <?php             
          echo $html->link(
              $html->image("admin/types.png", array("alt" => "Types Management", "border"=>"0")). '<br> Types Management',
              "/admin/types",
              array('escape'=>false)
          );
        ?>
        <br>
        Manage types of patient assessments. Here you can view, add and edit assessments types.
        </td>
    </tr>
    
  <tr>	    
	    <td align="center" valign="top"> 
           <?php             
              echo $html->link(
                  $html->image("admin/patient-icon.png", array("alt" => "Patients Management", "border"=>"0")). '<br> Patients Management',
                  "/admin/patients",
                  array('escape'=>false)
              );
            ?>
        <br>
        Manage your Patients. Here you can view, add and edit Patients.
		  </td>


        <td align="center" valign="top"> &nbsp;

        </td>
    </tr>
<?php */?>
 </table>
