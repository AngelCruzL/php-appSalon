<?php
foreach ($alerts as $type => $messages) {
  foreach ($messages as $message) {
    echo "<div class='alert $type'>$message</div>";
  }
}
