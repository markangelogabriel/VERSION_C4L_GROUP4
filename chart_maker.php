<?php
 include("class/pData.class.php"); 
 include("class/pDraw.class.php"); 
 include("class/pPie.class.php"); 
 include("class/pImage.class.php"); 
 
// include all other classes needed

//assumption :
//	this file has access to the user inputs in the Statistics input page

// example 1: input is Rape(crime type), order by location
// example 2: input is 2012(year), order by crime type

// Adding the points :

/* 1) for( location in SELECT location IN crimes) no duplicates
 *	$myData->addPoints(SELECT COUNT(crime_id) FROM crimes WHERE crime_type = "Rape" AND crime_location=location, location.string)
 */
 
/* 2) for( type in SELECT crime_type IN crimes) no duplicates
 *	$myData->addPoints(SELECT COUNT(crime_id) FROM crimes WHERE yearOfCrime = 2012 AND type=crime_type, type.string)
 */
 

session_start();

$chart_point = $_SESSION['chart_point'];
$data_label = $_SESSION['data_label'];
$chart_data = $_SESSION['chart_data'];
$chart_order = $_SESSION['chart_order'];

$title = "Distribution of '{$chart_data}' under '{$chart_order}'";

/* Create and populate the pData object */ 
 $MyData = new pData();    
 $MyData->addPoints($chart_point,"Data");   
 //$MyData->setSerieDescription("ScoreA","Application A"); 

 /* Define the absissa serie */ 
 $MyData->addPoints($data_label,"Labels"); 
 $MyData->setAbscissa("Labels"); 

 /* Create the pChart object */ 
 $myPicture = new pImage(300,260,$MyData); 

 /* Draw a solid background */ 
 $Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107); 
 $myPicture->drawFilledRectangle(0,0,300,300,$Settings); 

 /* Overlay with a gradient */ 
 $Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50); 
 $myPicture->drawGradientArea(0,0,300,260,DIRECTION_VERTICAL,$Settings); 
 $myPicture->drawGradientArea(0,0,300,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100)); 

 /* Add a border to the picture */ 
 $myPicture->drawRectangle(0,0,299,259,array("R"=>0,"G"=>0,"B"=>0)); 
 
 /* Write the picture title */  
 $myPicture->setFontProperties(array("FontName"=>"fonts/Silkscreen.ttf","FontSize"=>6)); 
 $myPicture->drawText(16,16,$title,array("R"=>255,"G"=>255,"B"=>255)); 

 /* Set the default font properties */  
 $myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80)); 

 /* Enable shadow computing */  
 $myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>50)); 

 /* Create the pPie object */  
 $PieChart = new pPie($myPicture,$MyData); 

 /* Draw an AA pie chart */  
 $PieChart->draw2DPie(160,140,array("WriteValues"=>PIE_VALUE_PERCENTAGE,"DataGapAngle"=>10,"DataGapRadius"=>6,"Border"=>TRUE,"BorderR"=>255,"BorderG"=>255,"BorderB"=>255)); 
 
 /* Write the legend box */  
 $myPicture->setShadow(FALSE); 
 $PieChart->drawPieLegend(15,40,array("Alpha"=>20)); 

 /* Render the picture (choose the best way) */ 
 $myPicture->stroke();
?>