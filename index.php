<?php 
if (!empty($_POST["dtp_input1"])){
  $dtp_input1 = $_POST["dtp_input1"];
  $dtp_input1_show = substr($dtp_input1, 0, strlen($dtp_input1) - 3);
} else {
  $date = new DateTime();
    //echo $date->format('Y-m-d H:i:s') . "</br>";
  $date->sub(new DateInterval('PT6H'));
    //echo $date->format('Y-m-d H:i:s') . "</br>";
  $dtp_input1 = $date->format('Y-m-d H:i:s');
  $dtp_input1_show = $date->format('Y-m-d H:i');
}
if (!empty($_POST["dtp_input2"])){
  $dtp_input2 = $_POST["dtp_input2"];
  $dtp_input2_show = substr($dtp_input2, 0, strlen($dtp_input2) - 3);
} else {
  $dateNow = new DateTime();
  $dtp_input2 = $dateNow->format('Y-m-d H:i:s');
  $dtp_input2_show = $dateNow->format('Y-m-d H:i');
}
if (!empty($_POST["dropvalue"])){
  $dropvalue = $_POST["dropvalue"];
} else {
  $dropvalue = "6 timmar ";
}

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="./css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
  <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
  <script type="text/javascript" src="./js/locales/bootstrap-datetimepicker.sv.js" charset="UTF-8"></script>
  <script type="text/javascript">

  $(document).ready(function () {
    $(window).resize(function(){
        console.log("drawChart from resize");
        drawChart();
    });
  });

  $('.form_datetime').datetimepicker({
    language:  'sv',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
    showMeridian: 0
  });

  $("[id^=litid]").click(function() {
    $("#thebutton").text(this.innerText);
    $("#dropvalue").attr("value", this.innerText);
    if (this.id == "litid1"){
      var dateNow = new Date();
    //console.log(dateNow);
    var dateFrom = new Date().addHours(-1);
    //console.log(dateFrom);
  } else if (this.id == "litid6"){
    var dateNow = new Date();
    //console.log(dateNow);
    var dateFrom = new Date().addHours(-6);
    //console.log(dateFrom);
  } else if (this.id == "litid24"){
    var dateNow = new Date();
    //console.log(dateNow);
    var dateFrom = new Date().addHours(-24);
    //console.log(dateFrom);
  } else {
    var dateFrom = "";
    var dateNow = "";
  }
  //setDate("#dtp_input1", dateFrom);
  //setDate("#dtp_input2", dateNow);
  converDateAndSetDateField("#dtp_input1", dateFrom);
  converDateAndSetDateField("#dtp_input2", dateNow);
  $("#datepicker").submit();
});

  function changeDropDown(){
    $("#thebutton").text("Eget intervall");
    $("#dropvalue").attr("value", "Eget intervall");
  }

  function setDate(datafield, indate){
    if (indate == ""){
      $(datafield).attr("value", "");
    } else {
      var date = indate.toLocaleDateString();
      var time = indate.toLocaleTimeString();
      $(datafield).attr("value", date + " " + time);
    }
  }

function converDateAndSetDateField(datafield, indate) {
if (indate == ""){
      $(datafield).attr("value", "");
    } else {
    var value = indate.toISOString();
    $(datafield).attr("value", value.substring(0, 10) + " " + indate.getHours() + ":" + indate.getMinutes() + ":" + indate.getSeconds());
  }
}

  Date.prototype.addHours= function(h){
    this.setHours(this.getHours()+h);
    return this;
  }
</script>

<br/>

<body>
  <div class="container">
  
    <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading"><h3>Pool</h3></div>
            <div class="panel-body">
              Max temp idag: <br/>
              Max temp senaste 24 timmar: <br/>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading"><h3>DS1820_1</h3></div>
            <div class="panel-body">
              Max temp idag: <br/>
              Max temp senaste 24 timmar: <br/>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading"><h3>DS1820_2</h3></div>
            <div class="panel-body">
              Max temp idag: <br/>
              Max temp senaste 24 timmar: <br/>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="container">
    <div id="chart_div" style="width: 100%; height: 700px;"></div>
  </div>
  

  <div class="container">
    <form id="datepicker" action="" class="form-horizontal" role="form" method="post">
      <fieldset>
        <legend>Tidsintervall</legend>
        <div class="form-group">
          <label for="dtp_input1" class="col-md-2 control-label">Från</label>
          <div class="input-group date form_datetime col-md-5" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
            <input id="dtp_input1_show" class="form-control" size="10" type="text" value="<?php echo $dtp_input1_show; ?>" onChange="changeDropDown()">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
          </div>
          <input type="hidden" id="dtp_input1" name="dtp_input1" value="<?php echo $dtp_input1; ?>" /><br/><br/>

          <label for="dtp_input2" class="col-md-2 control-label">Till</label> 
          <div class="input-group date form_datetime col-md-5" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input2">
            <input class="form-control" size="10" type="text" value="<?php echo $dtp_input2_show; ?>" onChange="changeDropDown()">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
          </div>
          <input type="hidden" id="dtp_input2" name="dtp_input2" value="<?php echo $dtp_input2; ?>"/><br/>
        </div>

        <div class="row">
          <div class="col-lg-2 col-md-offset-2">
            <div class="input-group">
              <div class="input-group-btn">
                <button id="thebutton" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $dropvalue; ?><span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li id="litid1"><a href="#">1 timme</a></li>
                  <li id="litid6"><a href="#">6 timmar</a></li>
                  <li id="litid24"><a href="#">24  timmar</a></li>
                  <li role="separator" class="divider"></li>
                  <li id="litid99"><a href="#">Eget intervall</a></li>
                </ul>
              </div><!-- /btn-group -->
            </div><!-- /input-group -->
          </div><!-- /.col-lg-2 -->
          <div class="col-lg-4">
            <input type="submit" class="btn btn-default"></input>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        <input type="hidden" name="dropvalue" id="dropvalue" value="<?php echo $dropvalue; ?>">
      </fieldset>
    </form>
  </div>

  <?php
  class MyDB extends SQLite3
  {
    function __construct()
    {
     $this->open('templog.db');
   }
 }

 $db = new MyDB();
 if(!$db){
  echo $db->lastErrorMsg();
} else {
      //echo "Opened database successfully\n";
}
if (substr($dropvalue, 0, 1) == "6") {
  $sql = "select * from temps where timestamp > datetime('now', 'localtime', '-6 hours');";
} else if (substr($dropvalue, 0, 1) == "1"){
  $sql = "select * from temps where timestamp > datetime('now', 'localtime', '-1 hours'); ";
} else if (substr($dropvalue, 0, 2) == "24") {
  $sql = "select * from temps where timestamp > datetime('now', 'localtime', '-24 hours');";
} else{

 $sql = "select * from temps where timestamp > datetime('" . $dtp_input1 . "')";
 $sql = $sql . " and timestamp < datetime('" . $dtp_input2 . "')";
       //echo $sql . "</br>";
}

echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>' . "\n";
echo '<script type="text/javascript">' . "\n";
echo "\t" . 'google.load("visualization", "1", {packages:["corechart"]});' . "\n";
echo "\t" . 'google.setOnLoadCallback(drawChart);' . "\n";
echo "\t" . 'function drawChart() {' . "\n";
echo "\t\t" . 'var data = google.visualization.arrayToDataTable([' . "\n";
echo "\t\t" . "['timestamp', 'DS1820_1', 'DS1820_2', 'DS18B20'],\n";
$ret = $db->query($sql);
$array = array();
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
  $arr = [];
  array_push($arr, "'" . substr($row['timestamp'],0,-3) . "'");
  array_push($arr, "" . $row['DS1820_1'] . "");
  array_push($arr, "" . $row['DS1820_2'] . "");
  array_push($arr, "" . $row['DS18B20'] . "");
  array_push($array, implode($arr, ","));
}
echo "[" . implode($array, "],\n[") . "]\n";
echo "\t]);\n";
echo "\tvar options = {\n";
   //echo "\t\ttitle: 'Temperature and humidity',\n";
//echo "\t\twidth: 1200,\n";
//echo "\t\theight: 700,\n";
echo "\t\tcurveType: 'none',\n";
echo "\t\tlegend: { position: 'bottom' },\n";
echo "\t\tseries: {\n";
echo "\t\t0: {targetAxisIndex: 0}\n";
echo "\t\t},\n";
echo "\t\tvAxes: {\n";
echo "\t\t// Adds titles to each axis.\n";
echo "\t\t0: {title: 'Temperature (Celsius)'}\n";
echo "\t\t},\n";
echo "\t\t};\n";
echo "\t\tvar chart = new google.visualization.LineChart(document.getElementById('chart_div'));\n";
echo "\t\tchart.draw(data, options);\n";
echo "\t}\n";
echo "\t</script>\n";
   //echo "Operation done successfully\n";
$db->close();
?>

<div class="container">
  <h2>Raw data</h2>
  <table class="table table-striped">
    <thead>

      <?php
      $db = new MyDB();
      if(!$db){
        echo $db->lastErrorMsg();
      }

      if (substr($dropvalue, 0, 1) == "6") {
        $query = "select * from temps where timestamp > datetime('now', 'localtime', '-6 hours'); ";
      } else if (substr($dropvalue, 0, 1) == "1"){
        $query = "select * from temps where timestamp > datetime('now', 'localtime', '-1 hours'); ";
      } else if (substr($dropvalue, 0, 2) == "24") {
        $query = "select * from temps where timestamp > datetime('now', 'localtime', '-24 hours');";
      } else{
       $query = "select * from temps where timestamp > datetime('" . $dtp_input1 . "')";
       $query = $query . " and timestamp < datetime('" . $dtp_input2 . "')";
     }

      //echo $query . "</br>";

     $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
     $num_columns =  $result->numColumns(); 
     echo "<tr\n>";
     for ($i = 0; $i < $num_columns; $i++) {
      echo "<th>" . $result->columnName($i) . "</th>";
    }
    echo "</tr>\n";
    echo "<tbody>\n";
    while($row = $result->fetchArray(SQLITE3_ASSOC) ){
      echo "<tr\n>";
      echo "<td>" . $row['timestamp'] . "</td>";
      echo "<td>" . $row['DS1820_1'] . "</td>";
      echo "<td>" . $row['DS1820_2'] . "</td>";
      echo "<td>" . $row['DS18B20'] . "</td>";
      echo "</tr>\n";
    }
    $db->close();
    ?>

  </tbody>
</table>
</div>

<?php
// foreach($_POST as $key => $value) {
//   echo "POST parameter '$key' has '$value'</br>";
// }
?>


</body>
</html>
