<style type="text/css">
.users {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

.users td{
    border: 1px solid #333;
    padding: 2px 2px;
    color: #eaeaea;
}
.users th {
    border: 1px solid #333;
    padding: 2px 2px;
    background-color: #eaeaea;
    color: black;
}
</style>
<table class="users">
  <tr>
    <th style="max-width: 15px;width: 15px;">User Id</th>
    <th style="max-width: 25px;width: 25px;">Reqested By</th>
    <th style="max-width: 40px;width: 40px;">Title</th>
    <th style="max-width: 20px;width: 20px;">Time</th>
    <th style="max-width: 25px;width: 25px;">Remove Account</th>
  </tr>
</table>
<?php
session_start();
include('connection.php');

if(!empty($_POST["users"]))
{
  $val = $_POST["users"];
} else {
  echo "no users";
}

$query = "SELECT * FROM `reqs` ORDER BY time DESC";
$row=  mysqli_query($dbc, $query) or die($query."<br/><br/>".mysql_error());
$num_row = mysqli_num_rows($row);


$output = '';
$out = '';
while($num_row!=0) {
  $rw = mysqli_fetch_array($row, MYSQLI_BOTH);
  $n=$rw['parent_id'];
  $output .= '
  <table class="users">
    <tr>
      <td style="max-width: 15px;width: 15px;">'.$rw['parent_id'].'</td>
      <td style="max-width: 25px;width: 25px;">'.$rw['username'].'</td>
      <td style="max-width: 40px;width: 40px;">'.$rw['title'].'</td>
      <td style="max-width: 20px;width: 20px;">'.$rw['time'].'</td>
      <td style="max-width: 25px;width: 25px;"><a href="#" id="act-'.$rw['id'].'" onclick="deluser('.$rw['parent_id'].', event)">Delete</a></td>
    </tr>
  </table>
 ';
  $num_row--;
}

echo $output;

?>
<script>
function deluser(x, e) {
    e.preventDefault();
    if (confirm('Delete User Permanently?')==true) {
      e.preventDefault();
      $.ajax ({
        type:'post',
        url:'delete.php',
        data:{
            un: x
        },
        success:function(response) {
            if(response=="success") {
                alert("User Records Deleted!");
                $("#act-"+x).html("<a style='font-size:12px;color:red;'>[Deleted]</a>");
            }
        }
      });
    } else {
      e.preventDefault();
    }
}
</script>