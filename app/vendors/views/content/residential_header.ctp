
  <?php echo $javascript->link('jquery.bxSlider/jquery.bxSlider.min'); ?>
  <?php echo $javascript->link('vtip'); ?>
  <?php echo $html->css('vtip'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#resiHeader').bxSlider({
            auto: true,
            autoControls: false,
            autoHover: true,
            pager: false,
            controls: false,
            pause:10000
           
            
            
        });
    });
</script>

<div style="float:left;margin-top:16px;">
  <div id="resiHeader">
   
    <?php echo $html->image('resiheader/Residential_1_dots.png',array('height'=>'330','width'=>'960','USEMAP'=>'#firstImage'));  ?>
    <?php echo $html->image('resiheader/Residential_2_dots.png',array('height'=>'330','width'=>'960','USEMAP'=>'#secondImage'));  ?>
    <?php    echo $html->image('resiheader/Residential_4_dots.png',array('height'=>'330','width'=>'960','USEMAP'=>'#thirdImage'));  ?>
    <?php echo $html->image('resiheader/Residential_5.5.png',array('height'=>'330','width'=>'960','USEMAP'=>'#forthImage'));  ?>
  </div>
</div>

 
<map name="firstImage">
      <area shape="circle" coords="60,205,15,100" href="" class="vtip" alt="Sun1" title="Compared to electric dryers, gas-powered dryers can dry almost twice as many loads for the same cost."/>
      
      <area shape="circle"  coords="434,270,15,100" href="" class="vtip" alt="Sun1" title="Replacing a conventional water heater with a high efficiency propane water heater can save you hundreds of dollars each year."/>
</map> 

<map name="secondImage">
      <area shape="circle" coords="470,75,15,100" href="" class="vtip" alt="Sun1" title="Propane gas fireplaces produce twice as much heat as wood-burning fireplaces at about one-third of the cost"/>
      
      <area shape="circle" coords="870,75,15,100" href="" class="vtip" alt="Sun1" title="Propane gas fireplaces produce twice as much heat as wood-burning fireplaces at about one-third of the cost"/>
     
</map> 
<map name="thirdImage">
      <area shape="circle" coords="454,35,15,100" href="" class="vtip" alt="Sun1" title="Gas lights produce a true flame that provides a soft, warm glow. Gas-powered lights create no electrical dangers when used near water and can also provide reliable lighting even during power outages."/>
      <area shape="circle" coords="615,143,15,100" href="" class="vtip" alt="Sun1" title="Gas grills reduce cook time and are easier to maintain than charcoal grills."/>
     
     
</map> 
<map name="forthImage">
      <area shape="circle" coords="270,85,15,100" href="" class="vtip" alt="Sun1" title="Blossman provides a quality selection of refrigerators and other appliances."/>
      <area shape="circle" coords="380,60,15,100" href="" class="vtip" alt="Sun1" title="Blossman Gas provides the best in propane and electric appliances, such as microwaves."/>
      
      <area shape="circle" coords="438,230,15,100" href="" class="vtip" alt="Sun1" title="In gas ovens, flavors don't mix because of the unique ventilation system, and broiling with gas is smokeless because the gas flame consumes the smoke."/>
       
      <area shape="circle" coords="528,170,15,100" href="" class="vtip" alt="Sun1" title="Cooking with gas costs one-third as much as cooking with electricity, and gas ranges give you immediate and accurate control of the burner flame and temperature."/>
        
      <area shape="circle" coords="922,170,15,100" href="" class="vtip" alt="Sun1" title="Replacing a conventional water heater with a high efficiency propane water heater can save you hundreds of dollars each year."/>
     
</map>


  
