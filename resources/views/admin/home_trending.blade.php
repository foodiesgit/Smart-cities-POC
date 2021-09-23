@extends('layouts.admin')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator"><b style="color: #9102f7;">Homepage</b> Trending</h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
    <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ route('admin.home_trending_add_new') }}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus-circle"></i>
                                        <span>New Trending</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <!-- <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ route('admin.preview_home', [ 'url' => 'admin.home_trending', 'model' => 'HomeTrending' ]) }}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus-circle"></i>
                                        <span>Preview</span>
                                    </span>
                                </a>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
            <div class=" m-portlet__body table-responsive">
                <table class="table table-bordered table-stripped table-hover mt-2 dataTable no-footer" id="board_table">
                    <thead>
                        <tr>
                            <th align="center">Logo</th>
                            <th>Title</th>
                            <th align="center">Order</th>
                            <th>Created Date</th>
                            <th>Last Updated</th>
                            <th align="center" class="action-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boards as $board)                      
                            <tr>
                                <td align="center">
                                    @if(!empty($board->image) && file_exists(public_path("uploads/home/trending/thumb/".$board->image))) 
                                        {{ asset("uploads/home/trending/thumb/".$board->image) }}
                                    @elseif(!empty($board->image) && file_exists(public_path("uploads/home/trending/".$board->image))) 
                                        {{ asset("uploads/home/trending/".$board->image) }}
                                    @else 
                                        {{asset("uploads/default.png") }}
                                    @endif
                                </td>
                               
                                <td>{{ $board->title }}</td>
                                <td align="center">{{ $board->order }}</td>
                                <td><span class="dateSort">{{strtotime($board->created_at) > 0 ?  $board->created_at->format(SORTABLE_DATE_TIME) : '-'}}</span>{{strtotime($board->created_at) > 0 ?  $board->created_at->format(DATE_FORMAT) : '-'}}</td>
                                <td><span class="dateSort">{{strtotime($board->updated_at) > 0 ?  $board->updated_at->format(SORTABLE_DATE_TIME) : '-'}}</span>{{strtotime($board->updated_at) > 0 ?  $board->updated_at->format(DATE_FORMAT) : '-'}}</td>
                                <td align="center">
                                @if($board->active == 1) 
                                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill activeCl" onclick="publish_record('{{$board->id}}');" title="Click to Unpublish">
                                    <i class="la la-thumbs-up"></i></a>
                                    @else
                                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill inactiveCl" onclick="publish_record('{{$board->id}}');" title="Click to Publish">
                                        <i class="la la-thumbs-down"></i></a>
                                    @endif 
                                <a href="{{route('admin.home_trending_edit',$board->id)}}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Update">
                                <i class="la la-edit"></i>
                                </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('adminpanel/js/home_trending.js') }}"></script>            
@endsection

