<?php
  include_once('connection.php');
  include_once('functions.php');
  include_once('session.php');

  // vote.php - Endpoint for voting on a report or event
  /*  Method:
        POST
      Active user session required:
        Yes
      Required parameters:
        rid (for reports), eid (for events)
      Description:
        A standalone script that will process a simple 'vote'
        form submission for an active user session. On success,
        the script will return a JSON-formatted string with the
        variables 'success' set to true and the variable 'reportid',
        which contains the ID of the report or event (integer). On
        failure, the script will return a JSON-formatted string with
        the variable 'success' set to false.
      Example:
        {
          'success': true,
          'reportid': 8
        }
  */

  header('Content-Type: application/json');

  $json_result = array();

  if ((isset($_POST['rid']) || isset($_POST['eid'])) && isset($_SESSION['login_user'])) {
    if (isset($_POST['rid'])) {
      $reportID = sanitizeString($_POST['rid']);
      
      $result = $db->query("UPDATE reports SET votes=votes+1 WHERE rid = $reportID");
      
      if ($db->rows_affected > 0) {
        $json_result['success'] = true;
        $json_result['reportid'] = $reportID;
      } else { 
        $json_result['success'] = false;
      }
    } else if (isset($_POST['eid'])) {
      $eventID = sanitizeString($_POST['eid']);
      
      $result = $db->query("UPDATE reports SET votes=votes+1 WHERE eid = $eventID");
      
      if ($db->rows_affected > 0) {
        $json_result['success'] = true;
        $json_result['reportid'] = $eventID;
      } else { 
        $json_result['success'] = false;
      }
    }
    
    echo json_encode($json_result);
  } else {
    $json_result['success'] = false;
    echo json_encode($json_result);
  }
?>