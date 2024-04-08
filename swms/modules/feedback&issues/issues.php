
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['work_id'])) {
    // Redirect to the login page
    header("Location: ../../waste_personnel/login.php");
    exit();
}

// If the user is logged in, continue displaying the  content

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SWMS | Feedback & Issues</title>

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
                    <li >
                        <a href="../user_management/user.php"><i class="fa fa-user-md"></i> <span class="nav-label">User Management</span></a>
                        
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Collection Schedule</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="../collection_schedule/personnel_collection_schedule.php">View Pickup Schedule</a></li>
                            <li><a href="../collection_schedule/personnel_collection_schedule_edit.php">Schedule Pickup</a></li>
                        </ul>
                    </li>   
                    <li>
                        <a href="../missed_pickups/missed_pickups.php"><i class="fa fa-trash"></i> <span class="nav-label">Missed Pickups</span></a>
                        
                    </li>  
                    <li>
                        <a href="../reports/reports.php"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Reports</span></a>
                 
                    </li>  
                    <li class="active">
                        <a href=""><i class="fa fa-files-o"></i> <span class="nav-label">Feedback & Issues</span></a>
                 
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
                <div class="col-lg-10">
                    <h2>Feedback & Issues</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">
                            <strong>Feedback & Issues</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content  animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Issue list</h5>
                                <div class="ibox-tools">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#feedbackModal">Add new feedback</button>
</div>
                            </div>
                            <div class="ibox-content">
    
                                <div class="m-b-lg">
    
                                    <div class="input-group">
                                    <input type="text" id="searchInput" placeholder="Search for issue..." class=" form-control">

                                       
                                    </div>
                                    <div class="m-t-md">
    
                                    <div class="pull-right">
    <button type="button" class="btn btn-sm btn-white" id="printPdfButton">
        <i class="fa fa-print"></i> Print PDF
    </button>
</div>
    
                                        <strong id="feedbackCount">Found 0 feedbacks.</strong>

    
    
    
                                    </div>
    
                                </div>
    
                                <div class="table-responsive">
                                <table class="footable table table-stripped toggle-arrow-tiny">
            <thead>
                <tr>
                    <th>Feedback ID</th>
                    <th>Resident Address</th>
                    <th>Date of Submission</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody id="feedbackTableBody">
                <!-- Feedback data will be dynamically added here -->
            </tbody>
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

            <!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Submit Feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Feedback form -->
                <form id="feedbackForm">
                <div class="form-group">
                        <label for="feedback">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
                    <div class="form-group">
                        <label for="feedback">Feedback:</label>
                        <textarea class="form-control" id="feedback" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitFeedback()">Submit</button>
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

       <!-- Peity -->
       <script src="js/plugins/peity/jquery.peity.min.js"></script>

       <!-- SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>


<!-- Include pdfmake library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

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



 


$('#printPdfButton').on('click', function() {
        // Define the table content
        var tableContent = [];
        $('#feedbackTableBody tr').each(function(index, row) {
            var rowData = [];
            $(row).find('td').each(function() {
                rowData.push($(this).text());
            });
            tableContent.push(rowData);
        });

        // Define the document definition
        var docDefinition = {
            content: [
                { text: 'Feedback Report', style: 'header' },
                {
                    table: {
                        body: [
                            ['Feedback ID', 'Resident Address', 'Date of Submission', 'Feedback'],
                            ...tableContent
                        ]
                    }
                }
            ],
            styles: {
                header: {
                    fontSize: 18,
                    bold: true,
                    margin: [0, 0, 0, 10]
                }
            }
        };

        // Generate and download the PDF
        pdfMake.createPdf(docDefinition).download('feedback_report.pdf');
    });
  
  function submitFeedback() {
    // Get form data
    var address = $('#address').val();
    var date = $('#date').val();
    var feedback = $('#feedback').val();

    // Check if address and feedback are filled
    if (!address || !feedback) {
        toastr.error('Please fill in the Address and Feedback fields');
        
        return;
    }

    // Create data object
    var data = {
        address: address,
        date: date,
        feedback: feedback
    };

    // Send data to server using AJAX
    $.ajax({
        url: 'submit_feedback.php', 
        type: 'POST',
        data: data,
        success: function(response) {
            // Handle the response from the server
            console.log(response);
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Feedback submitted successfully',
                showConfirmButton: false,
                timer: 1500
            });
            // Reset the form
            $('#feedbackForm')[0].reset();
          // Reload the page
        location.reload();
        },
        error: function() {
            // Handle any errors that occur during the AJAX request
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to submit feedback. Please try again later',
            });
        }
    });

    // Hide the modal after submitting feedback
    $('#feedbackModal').modal('hide');
}



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


        

// Fetch and display all feedback data
function loadFeedback() {
    $.ajax({
        url: 'fetch_feedback.php',
        type: 'GET',
        success: function(response) {
            var feedbackData = JSON.parse(response);
            var feedbackTableBody = $('#feedbackTableBody');

            if (feedbackData.length === 0) {
                feedbackTableBody.html('<tr><td colspan="4" class="text-center">No data found</td></tr>');
            } else {
                // Populate table body with feedback data
                feedbackData.forEach(function(feedback) {
                    var row = '<tr>' +
                        '<td>' + feedback.id + '</td>' +
                        '<td>' + feedback.address + '</td>' +
                        '<td>' + feedback.date + '</td>' +
                        '<td>' + feedback.feedback + '</td>' +
                        '</tr>';
                    feedbackTableBody.append(row);
                });
            }
        },
        error: function() {
            toastr.error('Failed to load feedback.');
        }
    });
}

$('#searchInput').on('keyup', function() {
    var searchText = $(this).val().toLowerCase();

    // Send the search term to the server using AJAX
    $.ajax({
        url: 'search.php',
        type: 'GET',
        data: { searchTerm: searchText },
        success: function(response) {
            var feedbackData = JSON.parse(response);
            var $feedbackTableBody = $('#feedbackTableBody');
            $feedbackTableBody.empty(); // Clear existing table rows

            if (feedbackData.length === 0) {
                $feedbackTableBody.append('<tr><td colspan="4" class="text-center">No feedback found</td></tr>');
            } else {
                // Populate table body with filtered feedback data
                feedbackData.forEach(function(feedback) {
                    var row = '<tr>' +
                        '<td>' + feedback.id + '</td>' +
                        '<td>' + feedback.address + '</td>' +
                        '<td>' + feedback.date + '</td>' +
                        '<td>' + feedback.feedback + '</td>' +
                        '</tr>';
                    $feedbackTableBody.append(row);
                });
            }
        },
        error: function() {
            toastr.error('Failed to fetch feedback.');
        }
    });
});


loadFeedback(); // Initial load of feedback data
    // Fetch the number of feedbacks from the server
    $.ajax({
        url: 'fetch_feedback_count.php', // Update the URL to your server-side script
        type: 'GET',
        success: function(response) {
            // Update the content of the feedbackCount element
            $('#feedbackCount').text('Found ' + response + ' feedbacks.');
        },
        error: function() {
            // Handle any errors that occur during the AJAX request
            toastr.error('Failed to fetch feedback count.');
        }
    });
});

</script>




</body>
</html>
