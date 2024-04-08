
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['work_id'])) {
    // Redirect to the login page
    header("Location: ../../waste_personnel/login.php");
    exit();
}

// If the user is logged in, continue displaying the  content

// Include the database connection file
include_once "../connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $area = mysqli_real_escape_string($conn, $_POST['area']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $complaint = mysqli_real_escape_string($conn, $_POST['complaint']);

    // Attempt to insert the data into the database
    $sql = "INSERT INTO missed_pickups (area, address, date, complaint) VALUES ('$area', '$address', '$date', '$complaint')";
    if (mysqli_query($conn, $sql)) {
        // Insert successful, show success message
        header("Location: missed_pickups.php?status=success");
        exit();
    } else {
        // Insert failed, show error message
        header("Location: missed_pickups.php?status=fail");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SWMS | Missed Pickups</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16">

    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
    

</head>

<body>

    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                    <div class="dropdown profile-element">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
    <span>
        <img id="profile-img" alt="image" class="img-circle profile-img" src="data:image;base64," style="max-width: 50px; max-height: 50px;" />


        </span>
    </a>
    <ul class="dropdown-menu animated fadeInRight m-t-xs">
        <li><a href="#" id="profile-link">Profile</a></li>
        <li class="divider"></li>
        <li><a href="../../waste_personnel/logout.php">Logout</a></li>
    </ul>
</div>


 

                        <div class="logo-element">
                        SMWS
                        </div>
                    </li>
                    <li>
                        <a href="../../waste_personnel/index.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                 
                    </li>
                    <li>
                        <a href="../user_management/user.php"><i class="fa fa-user-md"></i> <span class="nav-label">User Management</span></a>
                        
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Collection Schedule</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="../collection_schedule/personnel_collection_schedule.php">View Pickup Schedule</a></li>
                            <li><a href="../collection_schedule/personnel_collection_schedule_edit.php">Schedule Pickup</a></li>
                        </ul>
                    </li>   
                    <li  class="active">
                        <a href=""><i class="fa fa-trash"></i> <span class="nav-label">Missed Pickups</span></a>
                        
                    </li>  
                    <li>
                        <a href="../reports/reports.php"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Reports</span></a>
                 
                    </li>  
                    <li>
                        <a href="../feedback&issues/issues.php"><i class="fa fa-files-o"></i> <span class="nav-label">Feedback & Issues</span></a>
                 
                    </li>   
                    <li>
                        <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Settings</span></a>
                        
                    </li> 
                    <li>
                        <a href="../../waste_personnel/logout.php"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
                 
                    </li>              

                </ul>

            </div>
        </nav>       
      

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
           
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to SWMS.</span>
                </li>
               
                <li class="dropdown">
    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
        <i class="fa fa-bell"></i> <span class="label label-primary" id="pickupCount">0</span>
    </a>
    <ul class="dropdown-menu dropdown-alerts" id="pickupList">
        <li class="divider"></li>
        <li>
            <div class="text-center link-block">
                <a href="../collection_schedule/personnel_collection_schedule.php">
                    <strong>See Schedule</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>
    </ul>
</li>

                <li>
                    <a href="../../waste_personnel/logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>MISSED PICKUPS</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">
                        <strong>Missed Pickups</strong>
                    </li>
                </ol>
            </div>
           
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">

                    <div class="ibox-content m-b-sm border-bottom">
                        <div class="text-center p-lg">
                            <h2>If a scheduled collection is missed</h2>
                            
                            <button title="Create new cluster" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reportModal"><i class="fa fa-plus"></i> <span class="bold">Report</span></button>
                        </div>
                    </div>

                    <div class="faq-item">
                    <div class="col-lg-6">
                        <div class="form-group">
        <label class="control-label" for="search">Search</label>
        <input type="text" id="search" name="search" placeholder="Search by Area or Address" class="form-control">
    </div>
                            
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                        <table id="scheduleTable"class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                    <tr>
    
                                        <th data-toggle="true">Area</th>
                                        <th data-hide="phone">Address</th>
                                        <th data-hide="phone">Date of Submission</th>
                                        <th data-hide="phone">Complaint</th>
                                      
                                        
    
                                    </tr>
                                    </thead>
                                    <tbody id="scheduleTableBody">
    <!-- Table rows will be dynamically added here by JavaScript -->
</tbody>

                                    <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <ul class="pagination pull-right"></ul>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                        </div>
                        </div>
                    </div>
                    
                 
                   
                </div>
            </div>
        </div>
            
            <div class="footer">

                <div>
                    <strong>Copyright</strong> Smart Waste Management System &copy; 2024
                </div>
            </div>
            <!-- Modal for reporting missed pickup -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="reportModalLabel">Report Missed Pickup</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
            <form id="reportForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
        <label for="address">Area:</label>
        <input type="text" class="form-control" id="area" name="area">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div class="form-group">
        <label for="reason">Complaint:</label>
        <textarea class="form-control" id="reason" name="complaint"></textarea>
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-primary" id="submitReportBtn">Submit</button>

    </div>
</form>

            </div>
        </div>
    </div>
</div>

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>


    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
<!-- SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<script>
   

  
// Function to fetch user details and update profile picture
function fetchAndUpdateProfilePic() {
    $.ajax({
        url: '../../waste_personnel/fetch_personnel_details.php', // endpoint for fetching user details
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the profile picture
            document.getElementById('profile-img').src = 'data:image;base64,' + response.profile_pic;
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch user details:', error);
            // Display an error message or handle the error as needed
        }
    });
}

// Call the function initially
fetchAndUpdateProfilePic();

// Update the profile picture every 2 seconds
setInterval(fetchAndUpdateProfilePic, 2000);




// Add an event listener to the profile link
document.getElementById('profile-link').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent the default link behavior

    // Fetch user details from the database using AJAX
    $.ajax({
        url: '../../waste_personnel/fetch_personnel_details.php', // endpoint for fetching user details
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Display user details in the modal
            Swal.fire({
                title: 'Account Details',
                html: '<div style="display: flex; flex-direction: column; align-items: center;">' +
                    '<img src="data:image;base64,' + response.profile_pic + '" alt="User Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; margin-bottom: 20px; cursor: pointer;" id="profile-pic"></div>' +
                    '<div>Work-ID: ' + response.work_id + '</div>' +
                    '<div>Email: ' + response.email + '</div>' +
                    '<div>Company: ' + response.company_name + '</div>' +
                    '<input type="file" id="profile-pic-input" style="display: none;">' + // Add file input here
                    '</div>',
                showCloseButton: true,
                showConfirmButton: false,
                showCancelButton: false,
                customClass: {
                    container: 'user-details-modal'
                },
                onClose: () => {
                    console.log('Modal closed');
                }
            });

           // Handle the file upload when profile image is clicked
    document.getElementById('profile-pic').addEventListener('click', function() {
        document.getElementById('profile-pic-input').click();
    });

    // Handle the file upload
    document.getElementById('profile-pic-input').addEventListener('change', function() {
        var formData = new FormData();
        formData.append('profile-pic', this.files[0]);

        fetch('../../waste_personnel/fetch_personnel_pic_details.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update the profile picture source
                    document.getElementById('profile-pic').src = data.profile_pic;
                    // Display success Toastr alert
                    toastr.success(data.message);
                } else {
                    // Display error Toastr alert
                    toastr.error(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Display error Toastr alert
                toastr.error('An error occurred. Please try again later.');
            });
    });
},
        error: function(xhr, status, error) {
            console.error('Failed to fetch user details:', error);
            // Display an error message or handle the error as needed
        }
    });
});



    $(document).ready(function() {


  // Fetch pickups for the day
  $.ajax({
        url: '../../waste_personnel/fetch_pickups_for_day.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var pickupList = $('#pickupList');
            pickupList.empty(); // Clear existing list

            if (response.length > 0) {
                $('#pickupCount').text(response.length);

                $.each(response, function(index, pickup) {
                    var listItem = '<li>' +
                        '<a href="#">' +
                        '<div>' +
                        '<i class="fa fa-truck fa-fw"></i> ' + pickup.address +
                        '<span class="pull-right text-muted small">' + pickup.time + '</span>' +
                        '</div>' +
                        '</a>' +
                        '</li>';
                    pickupList.append(listItem);
                });
            } else {
                $('#pickupCount').text('0');
                pickupList.append('<li>No pickups for today</li>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch pickups for the day:', error);
            $('#pickupCount').text('0');
            $('#pickupList').append('<li>Failed to fetch pickups for the day</li>');
        }
    });


        $('.footable').footable();
        $('#search').on('input', function() {
            var searchQuery = $(this).val().trim();
            if (searchQuery.length > 0) {
                $.ajax({
                    url: 'search.php', // The PHP file that handles the search logic
                    method: 'POST',
                    data: { search: searchQuery },
                    dataType: 'html',
                    success: function(response) {
                        $('#scheduleTable tbody').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                // Reset table content if search query is empty
                $('#scheduleTable tbody').html('');
            }
        });
        
          // Check for  success or failure
          <?php if (isset($_GET['status'])) {
                if ($_GET['status'] == 'success') { ?>
                $('#reportModal').modal('hide'); // Hide the modal
                    Swal.fire({
                        
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your missed pickup has been recorded',
                    showConfirmButton: false,
                    timer: 4000
                    
                
                    });
                    // Clear the form
                    $('#reportForm')[0].reset();
                <?php } else { ?>
                    Swal.fire({
                        icon: 'error',
                    title: 'Error!',
                    text: 'Failed to record missed pickup',
                    });
                <?php }
            } ?>
    });
</script>

</body>
</html>
