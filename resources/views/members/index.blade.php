@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="card p-3 mt-5">
            <section class="content-header">
                <h1 class="pull-left">Member's Portal</h1>
            </section>
            <div class="content">
                <div class="clearfix"></div>

                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Winning Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($members as $index=>$member)
                                        <tr>
                                            <td>{!! $member->name!!}</td>
                                            <td>{!! $member->winning_number!!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop