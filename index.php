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

<br/>

<body>
  <div class="container">
    <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading"><h4>Pool : <?php echo getPoolTempNow(); ?> &deg;C</h4></div>
            <div class="panel-body">
              Max temp idag : <?php echo getMaxPoolToday(); ?> &deg;C<br/>
              Min temp idag : <?php echo getMinPoolToday(); ?> &deg;C<br/>
              <h5>Senaste 30 minuterna:</h5>
              <div id="chart_pool"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading"><h4>DS1820_1 : <?php echo getDS1820_1TempNow(); ?> &deg;C</h4></div>
            <div class="panel-body">
              Max temp idag : <?php echo getMaxDS1820_1Today(); ?> &deg;C<br/>
              Min temp idag : <?php echo getMinDS1820_1Today(); ?> &deg;C<br/>
              <h5>Senaste 30 minuterna:</h5>
              <div id="DS1820_1"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading"><h4>DS1820_2 : <?php echo getDS1820_2TempNow(); ?> &deg;C</h4></div>
            <div class="panel-body">
              Max temp idag : <?php echo getMaxDS1820_2Today(); ?> &deg;C<br/>
              Min temp idag : <?php echo getMinDS1820_2Today(); ?> &deg;C<br/>
              <h5>Senaste 30 minuterna:</h5>
              <div id="DS1820_2"></div>
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

  <script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
  <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
  <script type="text/javascript" src="./js/locales/bootstrap-datetimepicker.sv.js" charset="UTF-8"></script>
  <script type="text/javascript">

  $(document).ready(function () {
    $(window).resize(function(){
        //console.log("drawChart from resize");
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
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
<script type="text/javascript">
//google.load('current', {packages: ['corechart', 'line']});
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawPoolChart);
google.setOnLoadCallback(drawDS1820_1Chart);
google.setOnLoadCallback(drawDS1820_2Chart);

  function drawPoolChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('datetime', '');
      data.addColumn('number', '');
      data.addRows([
        <?php echo getPoolTemp30Min(); ?>
        /*
[new Date(2016,07,11,09,25),26.375],
[new Date(2016,07,11,09,30),26.375],
[new Date(2016,07,11,09,35),26.375],
[new Date(2016,07,11,09,40),26.437],
[new Date(2016,07,11,09,45),26.437],
[new Date(2016,07,11,09,50),26.437]*/
      ]);

      var options = {
        colors: ['orange'],
        height: 150,
      hAxis:{
         textPosition: 'in'
       },
       
      vAxis:{
         textPosition: 'in',
       },
       legend: {position : 'none'},
       chartArea:{left:0,top:0,width:'100%',height:'100%'}
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_pool'));
      chart.draw(data, options);
      }

  function drawDS1820_1Chart() {
      var data = new google.visualization.DataTable();
      data.addColumn('datetime', '');
      data.addColumn('number', '');
      data.addRows([
        <?php echo getDS1820_1Temp30Min(); ?>
        /*
['2016-07-11 09:25',26.375],
['2016-07-11 09:30',26.375],
['2016-07-11 09:35',26.375],
['2016-07-11 09:40',26.437],
['2016-07-11 09:45',26.437],
['2016-07-11 09:50',26.437]*/
      ]);

      var options = {
        height: 150,
      hAxis:{
         textPosition: 'in'
       },
       
      vAxis:{
         textPosition: 'in',
       },
       legend: {position : 'none'},
       chartArea:{left:0,top:0,width:'100%',height:'100%'}
      };

      var chart = new google.visualization.LineChart(document.getElementById('DS1820_1'));
      chart.draw(data, options);
      }

  function drawDS1820_2Chart() {
      var data = new google.visualization.DataTable();
      data.addColumn('datetime', '');
      data.addColumn('number', '');
      data.addRows([
        <?php echo getDS1820_2Temp30Min(); ?>
        /*
['2016-07-11 09:25',26.375],
['2016-07-11 09:30',26.375],
['2016-07-11 09:35',26.375],
['2016-07-11 09:40',26.437],
['2016-07-11 09:45',26.437],
['2016-07-11 09:50',26.437]*/
      ]);

      var options = {
        colors: ['red'],
        height: 150,
      hAxis:{
         textPosition: 'in'
       },
       
      vAxis:{
         textPosition: 'in',
       },
       legend: {position : 'none'},
       chartArea:{left:0,top:0,width:'100%',height:'100%'}
      };

      var chart = new google.visualization.LineChart(document.getElementById('DS1820_2'));
      chart.draw(data, options);
      }

</script>

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

//echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>' . "\n";
echo '<script type="text/javascript">' . "\n";
echo "\t" . 'google.load("visualization", "1", {packages:["corechart"]});' . "\n";
echo "\t" . 'google.setOnLoadCallback(drawChart);' . "\n";
echo "\t" . 'function drawChart() {' . "\n";
//echo "\t\t" . 'var data = google.visualization.arrayToDataTable([' . "\n";
//echo "\t\t" . "['timestamp', 'DS1820_1', 'DS1820_2', 'DS18B20'],\n";
echo "\t\tvar data = new google.visualization.DataTable();\n";
echo "\t\tdata.addColumn('datetime','timestamp');\n";
echo "\t\tdata.addColumn('number','DS1820_1');\n";
echo "\t\tdata.addColumn('number','DS1820_2');\n";
echo "\t\tdata.addColumn('number','DS18B20');\n";
echo "\t\tdata.addRows([\n";
$ret = $db->query($sql);
$array = array();
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
  $arr = [];
  array_push($arr, "new Date(" . convertToDateFormat($row['timestamp']) . ")");
  array_push($arr, "" . $row['DS1820_1'] . "");
  array_push($arr, "" . $row['DS1820_2'] . "");
  array_push($arr, "" . $row['DS18B20'] . "");
  array_push($array, implode($arr, ","));
  
}
echo "[" . implode($array, "],\n[") . "]\n";
echo "\t]);\n";
echo "\tvar options = {\n";
//echo "\t\tchartArea:{left:10,top:10,width:'80%',height:'80%'},\n";
echo "\t\tchartArea:{";
//echo "left:10,";
echo "top:10,";
echo "width:'100%',";
echo "height:'70%'},\n";
echo "\t\tcurveType: 'none',\n";
echo "\t\tlegend: { position: 'bottom' },\n";
//echo "\t\tseries: {\n";
//echo "\t\t0: {targetAxisIndex: 0}\n";
//echo "\t\t},\n";
echo "\t\thAxis: {\n";
echo "\t\t\tformat: 'yyyy-mm-dd\\nhh:MM'\n";
echo "\t\t},\n";
echo "\t\tvAxis: {\n";
echo "\t\t\ttextPosition: 'in'\n";
echo "\t\t},\n";
//echo "\t\tvAxes: {\n";
//echo "\t\t// Adds titles to each axis.\n";
//echo "\t\t0: {title: 'Temperature (Celsius)'}\n";
//echo "\t\t},\n";
echo "\t\t};\n";
echo "\t\tvar chart = new google.visualization.LineChart(document.getElementById('chart_div'));\n";
echo "\t\tchart.draw(data, options);\n";
echo "\t}\n";
echo "\t</script>\n";
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

<?php 
function convertToDateFormat($date){
  //2016-07-11 22:00:04
  $date = DateTime::createFromFormat('Y-m-d G:i:s', $date);
  return 
      $date->format('Y') . "," . 
      $date->format('m') . "," . 
      $date->format('d') . "," . 
      $date->format('G') . "," . 
      $date->format('i') . "," . 
      $date->format('s');
}

function getMaxPoolToday(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select max(DS18B20) from temps where timestamp > datetime('now', 'localtime', 'start of day');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getMaxDS1820_1Today(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select max(DS1820_1) from temps where timestamp > datetime('now', 'localtime', 'start of day');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getMaxDS1820_2Today(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select max(DS1820_2) from temps where timestamp > datetime('now', 'localtime', 'start of day');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getMinPoolToday(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select min(DS18B20) from temps where timestamp > datetime('now', 'localtime', 'start of day');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getMinDS1820_1Today(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select min(DS1820_1) from temps where timestamp > datetime('now', 'localtime', 'start of day');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getMinDS1820_2Today(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select min(DS1820_2) from temps where timestamp > datetime('now', 'localtime', 'start of day');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getPoolTempNow(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select DS18B20 from temps order by timestamp desc limit 1;";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getDS1820_1TempNow(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select DS1820_1 from temps order by timestamp desc limit 1;";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getDS1820_2TempNow(){
  $returnVal = -1;
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select DS1820_2 from temps order by timestamp desc limit 1;";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
      while($row = $result->fetchArray(SQLITE3_NUM) ){
       $returnVal = $row[0];
    }
    $db->close();
  return $returnVal;
}

function getPoolTemp30Min(){
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select timestamp, DS18B20 from temps where timestamp > datetime('now', 'localtime', '-30 minutes');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
  $array = array();
    while($row = $result->fetchArray(SQLITE3_NUM) ){
      $arr = [];
      array_push($arr, "new Date(" . convertToDateFormat($row[0]) . ")");
      array_push($arr, "" . $row[1] . "");
      array_push($array, implode($arr, ","));
      }
    $db->close();
    return "[" . implode($array, "],\n[") . "]\n";
}

function getDS1820_1Temp30Min(){
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select timestamp, DS1820_1 from temps where timestamp > datetime('now', 'localtime', '-30 minutes');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
  $array = array();
    while($row = $result->fetchArray(SQLITE3_NUM) ){
      $arr = [];
      array_push($arr, "new Date(" . convertToDateFormat($row[0]) . ")");
      array_push($arr, "" . $row[1] . "");
      array_push($array, implode($arr, ","));
      }
    $db->close();
    return "[" . implode($array, "],\n[") . "]\n";
}

function getDS1820_2Temp30Min(){
  $db = new MyDB();
      if(!$db){
        return "Error";
      }
  $query = "select timestamp, DS1820_2 from temps where timestamp > datetime('now', 'localtime', '-30 minutes');";
  $result = $db->query($query) or die("Error in query: <span style='color:red;'>$query</span>"); 
  $array = array();
    while($row = $result->fetchArray(SQLITE3_NUM) ){
      $arr = [];
      array_push($arr, "new Date(" . convertToDateFormat($row[0]) . ")");
      array_push($arr, "" . $row[1] . "");
      array_push($array, implode($arr, ","));
      }
    $db->close();
    return "[" . implode($array, "],\n[") . "]\n";
}

?>

</body>
</html>
