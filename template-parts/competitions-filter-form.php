<?php 
$days_order = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$tax_args = array(
  'taxonomy' => 'event_day',
  'hide_empty' => 1,
  'orderby' => 'date',
  'order'   => 'ASC'
);
$tax_days = get_categories($tax_args);
        
$dayList = array();
if($tax_days) {
  foreach($tax_days as $k=>$d) {
    $day = $d->name;
    foreach($days_order as $a=>$b) {
      if($day==$b) {
        $dayList[$a] = $d;
      }
    }
  }
  ksort($dayList);
}

if ($dayList) { ?>
<div class="filter-action">
  <form id="filter" action="<?php echo get_permalink() ?>" method="get">
    <span class="filter-label">Filter By</span>
    <span class="filter-field">
      <select name="day" id="day" class="filter-select jselect">
        <option value="">Day</option>
        <?php foreach ($dayList as $day) { 
          $dayName = $day->name;
          $daySelected = ($filter_day==$dayName) ? ' selected':'';
          ?>
         <option value="<?php echo $dayName ?>"<?php echo $daySelected ?>><?php echo $dayName ?></option> 
        <?php } ?>
      </select>
    </span>
  </form>
</div>
<?php } ?>