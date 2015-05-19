<?php
		header("Content-type: text/css; charset: UTF-8");
?>

.machineContainer{
	background-color: #000;
	padding: 5px 1px 5px 1px;
	overflow: hidden;
	height: 300px;
	width: 500px;
}
.slotMachine{
	width: 32.333333%;
	border: 5px solid #000;
	height: 100px;
	padding: 0px;
	overflow: hidden;
	display: inline-block;
	text-align: center;
	/*margin: 0px 5px;*/
	/*border: 5px solid #000;*/
	background-color: #ffffff;
}
.machineResult{
	color:#fff;
	text-align:center;
	font-weight: 900;
}
.noBorder{
	border:none !important;
	background: transparent !important;
}
.slotMachine .slot{
	height:100px;
	background-position-x: 55%;
	background-repeat: no-repeat;
}
.slot1{
	background-image: url("../images/slot1.png");
}
.slot2{
	background-image: url("<?php
								$rand_fruit;
							?>");
}
.slot3{
	background-image: url("../images/slot3.png");
}
.slot4{
	background-image: url("../images/slot4.png");
}
.slot5{
	background-image: url("../images/slot5.png");
}
.slot6{
	background-image: url("../images/slot6.png");
}


