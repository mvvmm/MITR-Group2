<div class="container">
  <table class="table text-center table-fluid">
    <thead class="thead-dark font-weight-bold">
      <tr>
        <?php
        $BronxColor        = "#80e5fc"; // blue
        $BrooklynColor     = "#ffe270"; // yellow
        $ManhattenColor    = "#f46666"; // red
        $QueensColor       = "#aaf26f"; // green
        $StatenIslandColor = "#e2aaff"; // purple

        $BronxTextColor        = "#2c5b66"; // dark blue
        $BrooklynTextColor     = "#7f6e2a"; // dark yellow
        $ManhattenTextColor    = "#681f1f"; // dark red
        $QueensTextColor       = "#3b5e1f"; // dark green
        $StatenTextIslandColor = "#4b3159"; // dark purple
          echo('
          <td style="width: 20%; background-color:'.$BronxColor.';">The Bronx</td>
          <td style="width: 20%; background-color:'.$BrooklynColor.';">Brooklyn</td>
          <td style="width: 20%; background-color:'.$ManhattenColor.';">Manhattan</td>
          <td style="width: 20%; background-color:'.$QueensColor.';">Queens</td>
          <td style="width: 20%; background-color:'.$StatenIslandColor.';">Staten Island</td>
          ');
        ?>
      </tr>
    </thead>
  </table>
</div>
