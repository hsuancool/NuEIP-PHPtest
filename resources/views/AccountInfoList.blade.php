<!--
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>NuEIP-PHPtest</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const currentPage = (urlParams.get('page') ? parseInt(urlParams.get('page')) : 1);
            $.getJSON('http://localhost/api/nueip/accounts?page=' + currentPage, function (json) {
                const tr = [];
                for (let i = 0; i < json.data.accounts.length; i++) {
                    const message = ((json.data.accounts[i].message !== null) ? json.data.accounts[i].message : '');
                    tr.push('<tr>');
                    tr.push('<td><div class="form-check">' +
                        '<label class="form-check-label">' +
                        '<input class="form-check-input" type="checkbox" value="' + json.data.accounts[i].accountId + '">' +
                        '<span class="form-check-sign"></span>' +
                        '</label>' +
                        '</div></td>');
                    tr.push('<td>' + json.data.accounts[i].accountId + '</td>');
                    tr.push('<td>' + json.data.accounts[i].account + '</td>');
                    tr.push('<td>' + json.data.accounts[i].name + '</td>');
                    tr.push('<td>' + json.data.accounts[i].gender + '</td>');
                    tr.push('<td>' + json.data.accounts[i].birth + '</td>');
                    tr.push('<td>' + json.data.accounts[i].email + '</td>');
                    tr.push('<td>' + message + '</td>');
                    tr.push('<td class="td-actions text-right">' +
                        '<button type="button" title="" class="btn btn-info btn-simple btn-link edit-account" data-toggle="modal" data-target="#updateAccount" data-original-title="Edit Task">' +
                        '<i class="fa fa-edit" data-id="' + json.data.accounts[i].accountId + '"></i>' +
                        '</button>' +
                        '<button type="button" class="btn btn-danger btn-simple btn-link delete-account" data-original-title="Remove">' +
                        '<i class="fa fa-times" data-id="' + json.data.accounts[i].accountId + '"></i>' +
                        '</button>' +
                        '</td>');
                    tr.push('</tr>');
                }
                $('tbody').append($(tr.join('')));
                $('#account-info-card-title').after('<p class="card-category">共 ' + json.data.paginate.total + ' 筆資料</p>');

                const page = [];
                for (let p = 1; p <= json.data.paginate.lastPage; p++) {
                    page.push('<li class="page-item ' + ((currentPage === p) ? 'active' : '') + '"><a class="page-link" href="/?page=' + p + '">' + p + '</a></li>')
                }
                $('#page-item-previous').after($(page.join('')));
                if ((currentPage - 1) > 0) {
                    $('#page-item-previous').append('<a class="page-link" href="http://localhost/?page=' + (currentPage - 1) + '" aria-label="Previous">' +
                        '<span aria-hidden="true">&laquo;</span>' +
                        '<span class="sr-only">Previous</span>' +
                        '</a>');
                }
                console.log(json.data.paginate.lastPage);
                if ((currentPage + 1) <= json.data.paginate.lastPage) {
                    $('#page-item-next').append('<a class="page-link" href="http://localhost/?page=' + (currentPage + 1) + '" aria-label="Next">' +
                        '<span aria-hidden="true">&raquo;</span>' +
                        '<span class="sr-only">Next</span>' +
                        '</a>');
                }
            });
        });

        $(document).delegate('.delete-account i', 'click', function() {
            const accountId = $(this).data('id');

            $.ajax({
                type: "DELETE",
                contentType: "application/json; charset=utf-8",
                url: "http://localhost/api/nueip/accounts/" + accountId,
                cache: false,
                beforeSend:function(){
                    return confirm("Are you sure?");
                },
                success: function() {
                    location.reload();
                },
                error: function() {
                    alert('Error updating record');
                }
            });
        });

        $(document).delegate('.edit-account i', 'click', function() {
            const accountId = $(this).data('id');

            $.getJSON('http://localhost/api/nueip/accounts/' + accountId, function (json) {
                const message = json.data.message !== null ? json.data.message : '';
                $('.modal-body .card-body').html('<form id="edit-account-form" data-id="' + accountId + '">' +
                    '<div class="row">' +
                    '<div class="col-md-5 pr-1">' +
                    '<div class="form-group">' +
                    '<label id="account-field">Account (disabled)</label>' +
                    '<input id="account-input" type="text" class="form-control" disabled="" placeholder="account" value="' + json.data.account + '">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-4 px-1">' +
                    '<div class="form-group">' +
                    '<label id="name-field">Name</label>' +
                    '<input type="text" class="form-control" placeholder="name" value="' + json.data.name + '">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-3 pl-1">' +
                    '<div class="form-group">' +
                    '<label id="gender-field">Gender</label>' +
                    '<select>' +
                    '<option value="1" ' + ((json.data.genderId === 1) ? 'selected' : '') + '>Male</option>' +
                    '<option value="0" ' + ((json.data.genderId === 0) ? 'selected' : '') + '>Female</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12 pr-1">' +
                    '<div class="form-group">' +
                    '<label id="birth-field">Birth</label>' +
                    '<Input type="date" value="' + json.data.birthDateTime + '">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<div class="form-group">' +
                    '<label id="email-field">Email Address</label>' +
                    '<input type="text" class="form-control" placeholder="email" value="' + json.data.email + '">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<div class="form-group">' +
                    '<label id="message-field">Message</label>' +
                    '<textarea rows="4" cols="80" class="form-control" placeholder="message">' + message + '</textarea>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<button class="btn btn-info btn-fill pull-right">Update Profile</button>' +
                    '</form>');
            });
        });

    </script>
</head>

<body>
<div class="wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title" id="account-info-card-title">Account Info List</h4>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th></th>
                                <th>ID</th>
                                <th>Account</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Birth</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Actions</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item" id="page-item-previous">
            </li>
            <li class="page-item" id="page-item-next">
            </li>
        </ul>
    </nav>

    <div class="modal fade" id="updateAccount" tabindex="-1" role="dialog" aria-labelledby="updateAccount" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="card-title">Update Account Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>

</html>
