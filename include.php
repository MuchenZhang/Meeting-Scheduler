<!doctype html>
<html>
<head>

<!--<link href="collapse/css/jquery-collapsible-fieldset.css" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
  $(function() {
    $("fieldset.collapsible").collapsible({
      /*collapsible: true,
      active : false*/
    });

  });
  </script>
</head>

<body>
<div id="jquery-script-menu">
<div class="jquery-script-center">

<div class="jquery-script-ads"><script type="text/javascript">
google_ad_client = "ca-pub-2783044520727903";

google_ad_slot = "2780937993";
google_ad_width = 0;
google_ad_height = 0;

</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
<div class="jquery-script-clear"></div>
</div>
</div>
<div class="container">
  <fieldset class="collapsible">
    <legend>Edit</legend>
    <div>
    <form class="form-container" method="POST" action="edit.php">
      Meeting Name:
      <input type="text" id="mName" name="view_mName" value="<?php echo $row['mName'];?>" readonly>
      <br><br>

      Meeting Date:
      <input type="date" name="view_meetingDate" id="meetingDate" value="<?php echo $row['meetingDate'];?>">
      <span class="error">* <?php echo $meetingDateErr;?></span>
      <br><br>

      Start Time:
      <input type="text" id="timePicker" name="view_startTime" value="<?php echo $row['startTime'];?>">
      <span class="error">* <?php echo $startTimeErr;?></span>
      <br><br>

      End Time:
      <input type="text" id="timePicker" name="view_endTime" value="<?php echo $row['endTime'];?>" >
      <span class="error">* <?php echo $endTimeErr;?></span>
      <br><br>

      Number of People:
      <input type="number" id="numPeople" name="view_numPeople" value="<?php echo $row['numPeople'];?>">
      <span class="error">* <?php echo $numPeopleErr;?></span>
      <br><br>

      Meeting Room:
      <span class="error">* <?php echo $mRoomErr;?></span><br>
      <input type="radio" name="view_mRoom" <?php echo ($row['mRoom'] =='1')? 'checked':'' ?> value="1"/>Meeting Room 1<br>
      <input type="radio" name="view_mRoom" <?php echo ($row['mRoom'] =='2')? 'checked':'' ?> value="2"/>Meeting Room 2<br><br>

      Priority:
      <span class="error">* <?php echo $priorityErr;?></span><br>
      <input type="radio" name="view_priority" <?php echo ($row['priority'] =='1')? 'checked':'' ?> value="1">
      <label for="1">Weekly meeting</label><br>
      <input type="radio" name="view_priority" <?php echo ($row['priority'] =='2')? 'checked':'' ?> value="2">
      <label for="2">Monthly meeting</label><br>
      <input type="radio" name="view_priority" <?php echo ($row['priority'] =='3')? 'checked':'' ?> value="3">
      <label for="3">International meeting</label><br><br>


      Additional Requirements: <br>
      <textarea name="view_message" rows="10" cols="30"><?php echo ($row['message']);?></textarea>
      <br><br>

      <button type="submit" class="btn" name="update">Update changes</button>
      <button type="submit" class="btn cancel" name="delete" onclick="return confirm('Are you sure you want to delete this meeting?');">Delete</button>
    </form>
    </div>
  </fieldset>
</form>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="collapse/js/jquery-collapsible-fieldset.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
