<?php
  $searchTerm = "";

  $airline = "";
  $aircraft = "";
  $creditCardType = "";
  $sort = "";
  $order = "";

  $flightsQuery = "SELECT * FROM flightlogs";

  // SEARCH
  if(isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    $flightsQuery .= " WHERE (flightNumber LIKE '%$searchTerm%') OR (departureAirportCode LIKE '%$searchTerm%') OR (arrivalAirportCode LIKE '%$searchTerm%') OR (pilotName LIKE '%$searchTerm%')";
  } 

  // FILTER
  if (isset($_GET['filterBtn']) || (isset($_GET['airline']) || isset($_GET['aircraft']) || isset($_GET['cardType']))) {
    // Set variables
    $airline = $_GET['airline'];
    $aircraft = $_GET['aircraft'];
    $creditCardType = $_GET['cardType'];

    $filterAdded = false;

    // Add filter to query
    if ($airline != "" || $aircraft != "" || $creditCardType != "") { 
      $flightsQuery .= " WHERE";

      if($airline != "") {
        $flightsQuery .= " airlineName = '$airline'";
        $filterAdded = true;
      }

      if($aircraft != "") {
        if ($filterAdded) {
          $flightsQuery .= " AND";
        }
        $flightsQuery .= " aircraftType = '$aircraft'";
        $filterAdded = true;
      }

      if($creditCardType != "") {
        if ($filterAdded) {
          $flightsQuery .= " AND";
        }
        $flightsQuery .= " creditCardType = '$creditCardType'";
      }
    }
  } 

  // SORT
  if (isset($_GET['sort'])) {
    // Set variables
    $sort = $_GET['sort'];
    $order = $_GET['order'];
    
    // Add sort to query
    if ($sort != "") {
      $flightsQuery .= " ORDER BY $sort";

      if ($order != "") {
        $flightsQuery .= " $order";
      }
    }
  } 

  $flightsResult = executeQuery($flightsQuery);

  // Show/hide collapsable element based on filter and sort values
  $filterCollapse = ($airline !== "" || $aircraft !== "" || $creditCardType !== "") ? "show" : "";
  $sortCollapse = ($sort !== "") ? "show" : "";

  // Query for filter values
  $airlinesQuery = "SELECT DISTINCT airlineName FROM flightLogs ORDER BY airlineName";
  $airlinesResult = executeQuery($airlinesQuery);

  $aircraftQuery = "SELECT DISTINCT aircraftType FROM flightLogs ORDER BY aircraftType";
  $aircraftResult = executeQuery($aircraftQuery);

  $cardTypesQuery = "SELECT DISTINCT creditCardType FROM flightLogs ORDER BY creditCardType";
  $cardTypesResult = executeQuery($cardTypesQuery);
?>