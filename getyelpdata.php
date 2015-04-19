<?php
/*$arr = array(array('restaurantname' => 'McDonald', 'address' => 'Washington Square', 'menu' => 'Hamburger', 'dish' => 'Cheeseburger', 'nreview' => 200 ,'nnegreview' => 67, 'nposreview' => 133, 'date' => '2015/04/01'),array('restaurantname' => 'McDonald', 'address' => 'Washington Square', 'menu' => 'Hamburger', 'dish' => 'McMuffin', 'nreview' => 190 ,'nnegreview' => 111, 'nposreview' => 67, 'date' => '2015/04/01'));
*/
$search = $_GET['searchinput'];
$link = mysql_connect('websys3.stern.nyu.edu','websysS15GB6','websysS15GB6!!');
mysql_select_db('websysS15GB6',$link) or die('Cannot select the DB');

if ($search == '') {
	$query = "SELECT r.RESTAURANT_NAME, r.ADDRESS, d.DISH_NAME, d.NUM_REVIEW, d.NUM_POS, d.NUM_NEG FROM RESTAURANT as r inner join DISH as d on r.RESTAURANT_ID = d.RESTAURANT_ID";
}
else
	$query = "SELECT r.RESTAURANT_NAME, r.ADDRESS, d.DISH_NAME, d.NUM_REVIEW, d.NUM_POS, d.NUM_NEG FROM RESTAURANT as r inner join DISH as d on r.RESTAURANT_ID = d.RESTAURANT_ID where (r.RESTAURANT_NAME LIKE '%$search%')";

$result = mysql_query($query,$link) or die('Errant query: '.$query);
while($arr = mysql_fetch_assoc($result)) {
	$list[] = $arr;
}
header('Content-type: application/json');
echo json_encode($list);
?>