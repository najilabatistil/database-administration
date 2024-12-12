<div class="row my-3">
  <div class="col">
    <div class="card rounded-3 shadow-sm">
      <div class="table-responsive-lg">
        <table class="table table-bordered table-striped m-0">

          <!-- Column Names -->
          <thead class="text-center align-middle">
            <tr>
              <th rowspan="2">Flight Number</th>
              <th colspan="6">Flight Information</th>
              <th colspan="3">Airline Information</th>
              <th colspan="3">Billing Information</th>
            </tr>

            <tr>
              <th>Departure Airport Code</th>
              <th>Arrival Airport Code</th>
              <th>Departure Date</th>
              <th>Arrival Date</th>
              <th>Duration (Minutes)</th>
              <th>Passenger Count</th>

              <th>Airline</th>
              <th>Aircraft</th>
              <th>Pilot</th>

              <th>Credit Card Number</th>
              <th>Credit Card Type</th>
              <th>Ticket Price</th>
            </tr>
          </thead>

          <!-- Data -->
          <tbody>
            <?php
            if(mysqli_num_rows($flightsResult) > 0) {
              while ($flightsRow = mysqli_fetch_array($flightsResult)) {
                // Format credit card type for display
                $cleanCardType = str_replace("-", " ", $flightsRow["creditCardType"]);
                $creditCardType = ucwords($cleanCardType);
                ?>
                <tr>
                  <!-- Flight Information -->
                  <td><?php echo $flightsRow['flightNumber'] ?></td>
                  <td><?php echo $flightsRow['departureAirportCode'] ?></td>
                  <td><?php echo $flightsRow['arrivalAirportCode'] ?></td>
                  <td><?php echo $flightsRow['departureDatetime'] ?></td>
                  <td><?php echo $flightsRow['arrivalDatetime'] ?></td>
                  <td><?php echo $flightsRow['flightDurationMinutes'] ?></td>
                  <td><?php echo $flightsRow['passengerCount'] ?></td>

                  <!-- Airline Information -->
                  <td><?php echo $flightsRow['airlineName'] ?></td>
                  <td><?php echo $flightsRow['aircraftType'] ?></td>
                  <td><?php echo $flightsRow['pilotName'] ?></td>
                  
                  <!-- Billing Information -->
                  <td><?php echo $flightsRow['creditCardNumber'] ?></td>
                  <td><?php echo $creditCardType ?></td>
                  <td><?php echo $flightsRow['ticketPrice'] ?></td>
                </tr>
              <?php
              }
            } else { ?>
                <tr>
                  <td colspan="100%" class="text-center py-3">No information available.</td>
                </tr>
            <?php } ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>