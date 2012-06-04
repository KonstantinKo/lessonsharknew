<div class="profile_border">

	<!-- render sidebar -->
	<?php echo $this->element('teachers/leftbar', array("teacher" => $teacher)); ?>

	<!-- <div class="teach_pro_right_part"> -->
	<div class="content_area">
		<h1>Background Checks to Submit</h1>
		<ul>
			<?php
			foreach ($teacherbackgrounds as $bg) {
				#debug($bg);

				$link = "https://trudiligence.secure-screening.net/escreening/loginauto.asp?username=TRUDEMO&password=TruDiligence1234&VFname={$bg['User']['firstname']}&VLname={$bg['User']['lastname']}&VSSN1={$bg['Profile']['SSN1']}&VSSN2={$bg['Profile']['SSN2']}&VSSN3={$bg['Profile']['SSN3']}&Vaddress={$bg['Profile']['address']}&Vcity={$bg['Profile']['city']}&Vstate={$bg['Profile']['State']['abbreviation']}&Vzip={$bg['Profile']['zip']}&Vref={$bg['User']['id']}";
				$anchor = $bg['User']['firstname'];

				if (isset($bg['User']['middlename'])) {
					$link .= "&VMname={$bg['User']['middlename']}";
					$anchor .= " ".$bg['User']['middlename'];
				}

				$link .= "&VDOB=".date("m/d/Y", strtotime($bg['Profile']['DOB'])).
					"&submit_it=LOGIN";
				#If we get a package, add it here.
				$anchor .= " ".$bg['User']['lastname'].", ".$bg['Profile']['State']['abbreviation'];
				
				echo "<li>";
				echo $this->Html->link($anchor, $link);

				echo " [".
					$this->Html->link("Approve Background", array(
						"controller" => "teachers", "action" => "approveBackground", $bg['User']['id'], "background")).
					" | ".
					$this->Html->link("Approve Degree", array(
						"controller" => "teachers", "action" => "approveBackground", $bg['User']['id'], "degree")).
					"]";
				echo "</li>";
			} unset($bg);
			if (empty($teacherbackgrounds))
				echo "<li>No new background checks to deal with.</li>"
			?>
		</ul>
	</div>

</div>