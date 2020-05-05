@extends( 'master.app' )
@section( 'title', 'TIMS | Status By Date' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Performance</li>
</ol>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table table-nowrap mb-0">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h2 class="table-avatar">
                                <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                        src="assets/img/profiles/avatar-09.jpg"></a>
                                <a href="profile.html">John Doe</a>
                            </h2>
                        </td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td>
                            <div class="half-day">
                                <span class="first-off"><a href="javascript:void(0);" data-toggle="modal"
                                        data-target="#attendance_info"><i
                                            class="fa fa-check text-success"></i></a></span>
                                <span class="first-off"><i class="fa fa-close text-danger"></i></span>
                            </div>
                        </td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><i class="fa fa-close text-danger"></i> </td>
                        <td><i class="fa fa-close text-danger"></i> </td>
                        <td><i class="fa fa-close text-danger"></i> </td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><i class="fa fa-close text-danger"></i> </td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                    class="fa fa-check text-success"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Attendance Modal -->
<div class="modal custom-modal fade" id="attendance_info" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attendance Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card punch-status">
                            <div class="card-body">
                                <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
                                <div class="punch-det">
                                    <h6>Punch In at</h6>
                                    <p>Wed, 11th Mar 2019 10.00 AM</p>
                                </div>
                                <div class="punch-info">
                                    <div class="punch-hours">
                                        <span>3.45 hrs</span>
                                    </div>
                                </div>
                                <div class="punch-det">
                                    <h6>Punch Out at</h6>
                                    <p>Wed, 20th Feb 2019 9.00 PM</p>
                                </div>
                                <div class="statistics">
                                    <div class="row">
                                        <div class="col-md-6 col-6 text-center">
                                            <div class="stats-box">
                                                <p>Break</p>
                                                <h6>1.21 hrs</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 text-center">
                                            <div class="stats-box">
                                                <p>Overtime</p>
                                                <h6>3 hrs</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card recent-activity">
                            <div class="card-body">
                                <h5 class="card-title">Activity</h5>
                                <ul class="res-activity-list">
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o"></i>
                                            10.00 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o"></i>
                                            11.00 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o"></i>
                                            11.15 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o"></i>
                                            1.30 PM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o"></i>
                                            2.00 PM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o"></i>
                                            7.30 PM.
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Attendance Modal -->


@endsection
@section('javascript')
@endsection
