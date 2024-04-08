
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

    <title>SWMS | User Management</title>

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
                    <li class="active">
                        <a href=""><i class="fa fa-user-md"></i> <span class="nav-label">User Management</span></a>
                        
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
                    <h2>User Management</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">
                            <strong>User Management</strong>
                        </li>
                    </ol>
                </div>
                
            </div>

            <div class="wrapper wrapper-content">
                
                <div class="ibox-content m-b-sm border-bottom">
                    <div class="row">
                    <div class="col-lg-6">
    <div class="form-group">
        <label class="control-label" for="search">Search</label>
        <input type="text" id="search" name="search" placeholder="Search User" class="form-control">
    </div>
</div>
<div class="col-lg-6 text-right">
            <button class="btn btn-primary"  id="btnAddUser">Add New User</button>
        </div>



                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
    
                                <table id="userTable"class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                    <tr>
    
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                        
    
                                    </tr>
                                    </thead>
                                    <tbody id="userTableBody">
                                        <tr>
                                            <td colspan="6">Loading...</td>
                                        </tr>
                                        <tr id="noUsersFound" style="display: none;">
        <td colspan="6" class="text-center">No users found</td>
    </tr>
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
            <div class="footer">

                <div>
                    <strong>Copyright</strong> Smart Waste Management System &copy; 2024
                </div>
            </div>
     

            <!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select class="form-control" id="role" name="role" required>
                        <option value="">---</option>
                            <option value="Resident">Resident</option>
                            <option value="Waste Personnel">Waste Personnel</option>
                        </select>
                    </div>
                    <div id="wastePersonnelFields" style="display:none;">
                        <div class="form-group">
                            <label for="workId">Work ID:</label>
                            <input type="text" class="form-control" id="workId" name="workId">
                        </div>
                        <div class="form-group">
                            <label for="companyName">Company Name:</label>
                            <input type="text" class="form-control" id="companyName" name="companyName">
                        </div>
                    </div>
                    <div id="residentFields" style="display:none;">
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number:</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnSubmitUser">Add User</button>

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

      <!-- FooTable -->
      <script src="js/plugins/footable/footable.all.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
          <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>


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


        

        // Submit form when Add User button is clicked
    $('#btnSubmitUser').click(function() {
        $('#addUserForm').submit(); // This submits the form
    });

    // Prevent default form submission and handle it manually
    $('#addUserForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the form data
        var formData = $(this).serialize();

        // Send an AJAX request to the server to add the user
        $.ajax({
            url: 'add_user.php', // Replace 'add_user.php' with your server-side script
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the server response
                console.log(response);
                if (response.success) {
                    $('#addUserModal').modal('hide');
                  // Reload the page to refresh the user table

Swal.fire({
    icon: 'success',
    title: 'User Added',
    text: 'The user has been added successfully.',
    showConfirmButton: false,
    timer: 4000
                    
});
$('#addUserForm')[0].reset();
                } else {
                    // User was not added, show an error message
                    toastr.error('Error', 'Failed to add user.');
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                console.error('Failed to add user:', error);
                toastr.error('Error', 'An error occurred while adding the user.');
            }
        });
    });


        
    
        $('.footable').footable();


        // Fetch user data from the server using AJAX
    $.ajax({
        url: 'fetch_users.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response && response.length > 0) {
                var tableBody = $('#userTableBody');
                tableBody.empty(); // Clear existing rows

                $.each(response, function(index, user) {
                    // Determine the role based on the table
                    var role = user.id.startsWith('R') ? 'Resident' : 'Waste Personnel';

                    var row = '<tr>' +
                        '<td>' + user.id + '</td>' +
                        '<td>' + user.username + '</td>' +
                        '<td>' + user.email + '</td>' +
                        '<td>' + user.address + '</td>' +
                        '<td>' + role + '</td>' +
                        '<td>' +
                        '<button class="btn btn-sm btn-danger btn-delete" ><i class="fa fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>';
                    tableBody.append(row);
                });
            } else {
                $('#userTableBody').html('<tr><td colspan="6">No users found</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch user data:', error);
            $('#userTableBody').html('<tr><td colspan="6">Failed to fetch user data</td></tr>');
        }

        
    });

    // Function to fetch and update the user table
function updateUserTable() {
    // Fetch user data from the server using AJAX
    $.ajax({
        url: 'fetch_users.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response && response.length > 0) {
                var tableBody = $('#userTableBody');
                tableBody.empty(); // Clear existing rows

                $.each(response, function(index, user) {
                    // Determine the role based on the table
                    var role = user.id.startsWith('R') ? 'Resident' : 'Waste Personnel';

                    var row = '<tr>' +
                        '<td>' + user.id + '</td>' +
                        '<td>' + user.username + '</td>' +
                        '<td>' + user.email + '</td>' +
                        '<td>' + user.address + '</td>' +
                        '<td>' + role + '</td>' +
                        '<td>' +
                        '<button class="btn btn-sm btn-danger btn-delete" ><i class="fa fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>';
                    tableBody.append(row);
                });
            } else {
                $('#userTableBody').html('<tr><td colspan="6">No users found</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch user data:', error);
            $('#userTableBody').html('<tr><td colspan="6">Failed to fetch user data</td></tr>');
        }
    });
}

// Update the user table every 5 seconds
setInterval(updateUserTable, 5000);



    

// Search functionality
$('#search').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        var noUsersFound = true;
        $('#userTable tbody tr').each(function() {
            var username = $(this).find('td:nth-child(2)').text().toLowerCase();
            var email = $(this).find('td:nth-child(3)').text().toLowerCase();
            var address = $(this).find('td:nth-child(4)').text().toLowerCase();
            var role = $(this).find('td:nth-child(5)').text().toLowerCase();

            if (username.indexOf(searchText) === -1 && email.indexOf(searchText) === -1 && address.indexOf(searchText) === -1 && role.indexOf(searchText) === -1) {
                $(this).hide();
            } else {
                $(this).show();
                noUsersFound = false;
            }
        });

        if (noUsersFound) {
            $('#noUsersFound').show();
        } else {
            $('#noUsersFound').hide();
        }
    });

// Delete User button click event handler
$(document).on('click', '.btn-delete', function() {
    var id = $(this).closest('tr').find('td:nth-child(1)').text();

    // Display a confirmation dialog
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0080FF",
        confirmButtonText: "Yes",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed, send AJAX request to delete user
            $.ajax({
                url: 'delete_user.php',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    // Refresh the user table after successful deletion
                    if (response.success) {
                        Swal.fire("Deleted!", "User has been deleted.", "success").then(() => {
                            //location.reload();  function to fetch users and update the table
                        });
                    } else {
                        Swal.fire("Failed to delete user.", "An error occurred while deleting the user.", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to delete user:', error);
                    Swal.fire("Failed to delete user.", "An error occurred while deleting the user.", "error");
                }
            });
        } else {
            // User canceled
            Swal.fire("Canceled", "User deletion has been canceled.", "error");
        }
    });
});


   // Open add user modal on button click
   $('#btnAddUser').click(function() {
        $('#addUserModal').modal('show');
    });

    // Show/hide additional fields based on role selection
    $('#role').on('change', function() {
        if ($(this).val() === 'Waste Personnel') {
            $('#wastePersonnelFields').show();
            $('#residentFields').hide();
        } else if ($(this).val() === 'Resident') {
            $('#wastePersonnelFields').hide();
            $('#residentFields').show();
        }
    });

    


    });
</script>
   

    
</body>
</html>
