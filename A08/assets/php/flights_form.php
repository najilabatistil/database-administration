  <div class="row d-flex flex-row justify-content-between align-items-center mt-3">

    <!-- SEARCH FORM -->
    <div class="col mb-2">
      <form method="get">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search Flight Number, Airport Code, or Pilot" name="searchTerm" value="<?php echo ($searchTerm) ? $searchTerm : "" ?>">
          <button class="btn btn-primary px-3 py-2" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
    </div>

    <!-- Filter and Sort Buttons -->
    <div class="col-12 col-sm-auto d-flex justify-content-center justify-content-sm-end mb-2">
      <button class="btn btn-primary px-3 py-2 mx-1" type="button" data-bs-toggle="collapse" data-bs-target="#filterForm">
        <i class="bi bi-funnel-fill"></i> Filter
      </button>
      <button class="btn btn-primary px-3 py-2 mx-1" type="button" data-bs-toggle="collapse" data-bs-target="#sortForm">
        <i class="bi bi-arrow-down-up"></i> Sort
      </button>
    </div>

    <!-- Clear Button -->
    <div class="row my-2">
      <div class="col-auto">
        <a href="./" class="btn btn-outline-primary px-3 py-2 mx-1" type="button">
          Clear Search and Filters
        </a>
      </div>
    </div>

    <!-- FILTER AND SORT FORMS -->
    <form method="get">

      <!-- FILTER FORM -->
      <div class="row">
        <div class="col collapse <?php echo $filterCollapse ?>" id="filterForm">
          <div class="card card-body mt-2">
            <div class="row"> 
              <h5>Filter</h5>

              <!-- Filter by Airline -->
              <div class="col-12 col-md-4 my-2">
                <label class="mb-2">Filter by Airline</label>
                <select class="form-select" name="airline">
                  <option value="" <?php echo ($airline == "" ? "selected" : ""); ?>>All Airlines</option>
                  <?php while ($airlineRow = mysqli_fetch_assoc($airlinesResult)) { 
                    $selected = ($airline !== "" && $airline == $airlineRow['airlineName']) ? "selected" : ""; ?>

                    <option value="<?php echo $airlineRow['airlineName']; ?>" <?php echo $selected; ?>>
                      <?php echo $airlineRow['airlineName']; ?>
                    </option>

                  <?php } ?>
                </select>
              </div>

              <!-- Filter by Aircraft -->
              <div class="col-12 col-md-4 my-2">
                <label class="mb-2">Filter by Aircraft</label>
                <select class="form-select" name="aircraft">
                  <option value="" <?php echo ($aircraft == "" ? "selected" : ""); ?>>All Aircraft</option>
                  <?php while ($aircraftRow = mysqli_fetch_assoc($aircraftResult)) { 
                    $selected = ($aircraft == $aircraftRow['aircraftType']) ? "selected" : ""; ?>

                    <option value="<?php echo $aircraftRow['aircraftType']; ?>" <?php echo $selected; ?>>
                      <?php echo $aircraftRow['aircraftType']; ?>
                    </option>

                  <?php } ?>
                </select>
              </div>

              <!-- Filter by Credit Card Type -->
              <div class="col-12 col-md-4 my-2">
                <label class="mb-2">Filter by Credit Card Type</label>
                <select class="form-select" name="cardType">
                  <option value="" <?php echo ($creditCardType == "" ? "selected" : ""); ?>>All Credit Card Types</option>
                  <?php 
                  while ($cardTypeRow = mysqli_fetch_assoc($cardTypesResult)) { 
                    $cleanCardType = str_replace("-", " ", $cardTypeRow['creditCardType']);
                    $cardTypeDisplay = ucwords($cleanCardType); 

                    $selected = ($creditCardType == $cardTypeRow['creditCardType']) ? "selected" : ""; ?>

                    <option value="<?php echo $cardTypeRow['creditCardType']; ?>" <?php echo $selected; ?>>
                      <?php echo $cardTypeDisplay; ?>
                    </option>

                  <?php }  ?>
                </select>
              </div>

            </div>
            
            <!-- Apply Filter -->
            <div class="text-center">
              <button type="submit" name="filterBtn" class="btn btn-primary px-2">Apply</button>
            </div>

          </div>
        </div>
      </div>

      <!-- SORT FORM -->
      <div class="row">
        <div class="col collapse <?php echo $sortCollapse ?>" id="sortForm">
          <div class="card card-body mt-2">
            <div class="row"> 
              <h5>Sort</h5>

              <!-- Columns -->
              <div class="col-12 col-md-6 my-2">
                <label class="mb-2">Sort By</label>
                <select class="form-select" name="sort">
                  <option value="" <?php echo ($sort == "" ? "selected" : ""); ?>>Default</option>
                  <option value="flightNumber" <?php if($sort == "flightNumber") {echo "selected";} ?>>Flight Number</option>
                  <option value="departureDatetime" <?php if($sort == "departureDatetime") {echo "selected";} ?>>Departure Date</option>
                  <option value="arrivalDatetime" <?php if($sort == "arrivalDatetime") {echo "selected";} ?>>Arrival Date</option>
                  <option value="flightDurationMinutes" <?php if($sort == "flightDurationMinutes") {echo "selected";} ?>>Duration</option>
                  <option value="passengerCount" <?php if($sort == "passengerCount") {echo "selected";} ?>>Passengers</option>
                  <option value="ticketPrice" <?php if($sort == "ticketPrice") {echo "selected";} ?>>Price</option>
                </select>
              </div>

              <!-- Order -->
              <div class="col-12 col-md-6 my-2">
                <label class="mb-2">Order</label>
                <select class="form-select" name="order">
                  <option value="ASC" <?php if($order == "ASC") {echo "selected";} ?>>Ascending</option>
                  <option value="DESC" <?php if($order == "DESC") {echo "selected";} ?>>Descending</option>
                </select>
              </div>
              
              <!-- Apply Sort -->
              <div class="text-center">
                <button type="submit" class="btn btn-primary px-2">Apply</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    
    </form>

  </div>