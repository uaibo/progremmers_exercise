<style>
*{
  font-family:arial;
  font-size:30px;
  color:#454545;
}
table{
  border-collapse: collapse;
}
table tr{
  background: #f1f3f5;
}
table td{
  border:1px solid #fff;
  padding:5px 10px;
}
</style>

<?php
$word = 'programmer';
$string = 'tuapfsorolwstojgiklnwcrpuamnfdkmwdekgsurgkfasylpsdtfdsfrsldifohdssdfglpqarhjnhdagshmsdfdgmksfuemkhzfrgdgpo';
$positionFrom = 0;
$positionsFound = [];

//split the word into an array of characters
$charsToSearch = str_split($word);

//add the first character of the word in our character search array
//so we will search for the characters of the word 'programmer' + 'p'
array_push( $charsToSearch, $charsToSearch[0] );

//find position of each character and
//start the search for the next character from the previous character's  position + 1.
foreach( $charsToSearch as $char ){
  $pos = strpos( $string, $char, $positionFrom );

  //add to positions array
  $positionsFound[] = $pos;

  //increase search position for the next interation
  $positionFrom = max( $pos+1, $positionFrom );
}

//get values of last two positions
//in our case this would be positions of last 'r' and 'p' from second 'programmer' word
$last_two_positions = array_values( array_slice($positionsFound, -2, 2, true) );

//make sure we have at least two items to compare.
if( sizeof($last_two_positions) < 2 ){
  die('We haven\'t found all the characters in that string. Check the long string.');
}


//then all we have to do is calculate the difference in absolute number
$chars_in_between = abs( $last_two_positions[0] - $last_two_positions[1] ) - 1;

$prev_string = substr($string, 0, $last_two_positions[0] + 1);
$between_string = substr($string, $last_two_positions[0] + 1, $chars_in_between);
$between_string = $between_string == '' ? '|' : $between_string;

$after_string = substr($string, $last_two_positions[0] + 1 + $chars_in_between);
ob_start();
?>

<p>There are <b><?php echo $chars_in_between;?></b> characters in between words <b><?php echo $word;?></b>!</p>

<table>
  <tr>
    <td>Original string:</td>
    <td><?php echo $string;?></td>
  </tr>
  <tr>
    <td>Result string:</td>
    <td><?php echo $prev_string . '<span style="color:red">' . $between_string . '</span>' . $after_string;?></td>
  </tr>
</table>
<?php
echo ob_get_clean();
